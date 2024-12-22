<?php
namespace Nekolympus\Project\controllers\Web;

use Nekolympus\Project\core\Controller;
use Nekolympus\Project\helpers\Redirect;
use Nekolympus\Project\core\DB;
use Nekolympus\Project\core\Request;
use Nekolympus\Project\models\Prestasi;

class PrestasiController extends Controller {

public function index()
    {
        $data = DB::table('prestasi')
        ->select(['prestasi.id', 'prestasi.judul', 'prestasi.konten', 'prestasi.tanggal', 'prestasi.img','prestasi.img_sertifikat']) 
        ->get();
        return $this->view('admin.prestasi.index', ['data' => $data]);
    }


    public function createIndex()
    {
        return $this->view('admin.prestasi.create');
    }

    public function updateIndex($id)
{
    $prestasi = Prestasi::where('id', '=', $id)->first();

    if (!$prestasi) {
        die("Error: Acara dengan ID $id tidak ditemukan.");
    }

    return $this->view('admin.prestasi.update', ['data' => $prestasi]);
}

public function create(Request $request)
{
    $judul = $request->input('judul');
    $konten = $request->input('konten');
    $tanggal = $request->input('tanggal');
    $uploadedFile = $_FILES['img'] ?? null;
    $uploadedFileSertifikat = $_FILES['img_sertifikat'] ?? null;

    if (empty($judul) || empty($konten) || empty($tanggal)) {
        die("Error: Semua kolom wajib diisi.");
    }

    if (!$uploadedFile || $uploadedFile['error'] !== UPLOAD_ERR_OK) {
        die("Error: File img wajib diunggah.");
    }

    if (!$uploadedFileSertifikat || $uploadedFileSertifikat['error'] !== UPLOAD_ERR_OK) {
        die("Error: File img_sertifikat wajib diunggah.");
    }

    $uploadDir = __DIR__ . '/../../../public/img_gallery_Prestasi/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Proses upload img
    $fileName = time() . '_' . basename($uploadedFile['name']);
    $filePath = '/img_gallery_Prestasi/' . $fileName;
    $fullPath = $uploadDir . $fileName;

    if (!move_uploaded_file($uploadedFile['tmp_name'], $fullPath)) {
        die("Error: Gagal mengunggah file img.");
    }

    // Proses upload img_sertifikat
    $fileNameSertifikat = time() . '_sertifikat_' . basename($uploadedFileSertifikat['name']);
    $filePathSertifikat = '/img_gallery_Prestasi/' . $fileNameSertifikat;
    $fullPathSertifikat = $uploadDir . $fileNameSertifikat;

    if (!move_uploaded_file($uploadedFileSertifikat['tmp_name'], $fullPathSertifikat)) {
        die("Error: Gagal mengunggah file img_sertifikat.");
    }

    // Tambahkan '/kelas_b/team_1' untuk disimpan ke database
    $filePath = '/kelas_b/team_1' . $filePath;
    $filePathSertifikat = '/kelas_b/team_1' . $filePathSertifikat;

    Prestasi::create([
        'judul' => $judul,
        'konten' => $konten,
        'tanggal' => $tanggal,
        'img' => $filePath,
        'img_sertifikat' => $filePathSertifikat
    ]);

    return $this->redirect('/kelas_b/team_1/Prestasi')->with('success', 'Konten berhasil dibuat.');
}



public function update(Request $request)
{
    $id = $request->input('id');
    $judul = $request->input('judul');
    $konten = $request->input('konten');
    $tanggal = $request->input('tanggal');
    $uploadedFile = $_FILES['img'] ?? null;
    $uploadedFileSertifikat = $_FILES['img_sertifikat'] ?? null;

    if (empty($judul) || empty($konten) || empty($tanggal)) {
        die("Error: Semua kolom wajib diisi.");
    }

    // Ambil data lama dari database
    $prestasi = DB::table('prestasi')
        ->select(['id', 'img', 'img_sertifikat'])
        ->where('id', '=', $id)
        ->first();

    if (!$prestasi) {
        die("Error: Data dengan ID $id tidak ditemukan.");
    }

    $uploadDir = __DIR__ . '/../../../public/img_gallery_Prestasi/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);
    }

    // Tangani file img
    $filePath = $prestasi->img; // Default ke data lama
    if ($uploadedFile && $uploadedFile['error'] === UPLOAD_ERR_OK) {
        $fileName = time() . '_' . basename($uploadedFile['name']);
        $newFilePath = '/img_gallery_Prestasi/' . $fileName;
        $newFullPath = $uploadDir . $fileName;

        // Pindahkan file baru ke server
        if (move_uploaded_file($uploadedFile['tmp_name'], $newFullPath)) {
            // Hapus file lama jika file baru berhasil diunggah
            if (!empty($prestasi->img)) {
                $oldFilePath = str_replace('/kelas_b/team_1', '', $prestasi->img);
                $oldFullPath = __DIR__ . '/../../../public' . $oldFilePath;

                if (file_exists($oldFullPath)) {
                    unlink($oldFullPath);
                }
            }
            $filePath = '/kelas_b/team_1' . $newFilePath; // Path baru
        } else {
            die("Error: Gagal mengunggah file img.");
        }
    }

    // Tangani file img_sertifikat
    $filePathSertifikat = $prestasi->img_sertifikat; // Default ke data lama
    if ($uploadedFileSertifikat && $uploadedFileSertifikat['error'] === UPLOAD_ERR_OK) {
        $fileNameSertifikat = time() . '_sertifikat_' . basename($uploadedFileSertifikat['name']);
        $newFilePathSertifikat = '/img_gallery_Prestasi/' . $fileNameSertifikat;
        $newFullPathSertifikat = $uploadDir . $fileNameSertifikat;

        // Pindahkan file baru ke server
        if (move_uploaded_file($uploadedFileSertifikat['tmp_name'], $newFullPathSertifikat)) {
            // Hapus file lama jika file baru berhasil diunggah
            if (!empty($prestasi->img_sertifikat)) {
                $oldFilePathSertifikat = str_replace('/kelas_b/team_1', '', $prestasi->img_sertifikat);
                $oldFullPathSertifikat = __DIR__ . '/../../../public' . $oldFilePathSertifikat;

                if (file_exists($oldFullPathSertifikat)) {
                    unlink($oldFullPathSertifikat);
                }
            }
            $filePathSertifikat = '/kelas_b/team_1' . $newFilePathSertifikat; // Path baru
        } else {
            die("Error: Gagal mengunggah file img_sertifikat.");
        }
    }

    // Update data di database
    Prestasi::update($id, [
        'judul' => $judul,
        'konten' => $konten,
        'tanggal' => $tanggal,
        'img' => $filePath, // Tetap gunakan path lama jika tidak ada file baru
        'img_sertifikat' => $filePathSertifikat // Tetap gunakan path lama jika tidak ada file baru
    ]);

    return $this->redirect('/kelas_b/team_1/Prestasi')->with('success', 'Data berhasil diperbarui.');
}





public function delete($id)
    {  
        $Prestasi = Prestasi::where('id', '=', $id)->first();

        if ($Prestasi) {
            
            $filePath = __DIR__ . '/../../../public' . $Prestasi->img;
            $filePathSertifikat = __DIR__ . '/../../../public' . $Prestasi->img_sertifikat;
    
            if (!empty($Prestasi->img) && file_exists($filePath)) {
                unlink($filePath);
            }
            if (!empty($Prestasi->img_sertifikat) && file_exists($$filePathSertifikat)) {
                unlink($$filePathSertifikat);
            }
 
            Prestasi::delete($id);
        } else {
            die("Error: Prestasi dengan ID $id tidak ditemukan.");
        }  
        return $this->redirect('/kelas_b/team_1/Prestasi');
    }


}
<?php
namespace Nekolympus\Project\controllers\Web;

use Nekolympus\Project\core\Controller;
use Nekolympus\Project\helpers\Redirect;
use Nekolympus\Project\core\DB;
use Nekolympus\Project\core\Request;
use Nekolympus\Project\models\AcaraSekolah;

class AcaraSekolahController extends Controller {

public function index()
    {
        $data = DB::table('acara_sekolah')
        ->select(['acara_sekolah.id', 'acara_sekolah.judul', 'acara_sekolah.konten', 'acara_sekolah.tanggal', 'acara_sekolah.img']) 
        ->get();
        return $this->view('admin.acara_sekolah.index', ['data' => $data]);
    }


    public function createIndex()
    {
        return $this->view('admin.acara_sekolah.create');
    }

    public function updateIndex($id)
{
    $Acara = AcaraSekolah::where('id', '=', $id)->first();

    if (!$Acara) {
        die("Error: Acara dengan ID $id tidak ditemukan.");
    }

    return $this->view('admin.acara_sekolah.update', ['data' => $Acara]);
}

public function create(Request $request)
{
    $judul = $request->input('judul');
    $konten = $request->input('konten');
    $tanggal = $request->input('tanggal');
    $uploadedFile = $_FILES['img'] ?? null;

    if (empty($judul) || empty($konten) || empty($tanggal)) {
        die("Error: Semua kolom wajib diisi.");
    }
    if (trim(strip_tags($konten)) === '') {
        die("Error: Kolom konten tidak boleh kosong.");
    }

    $filePath = null; 
    if ($uploadedFile && $uploadedFile['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '/img_gallery_acara_sekolah/';
        $fileName = time() . '_' . basename($uploadedFile['name']); 
        $filePath = $uploadDir . $fileName; 
        $fullPath = __DIR__ . '/../../../public' . $filePath; 

        // Membuat folder jika belum ada
        if (!is_dir(dirname($fullPath))) {
            mkdir(dirname($fullPath), 0777, true);
        }

        // Memindahkan file ke server
        if (!move_uploaded_file($uploadedFile['tmp_name'], $fullPath)) {
            die("Error: Gagal mengunggah file.");
        }

        // Jika file berhasil dipindahkan, tambahkan '/kelas_b/team_1' pada path
        $filePath = '/kelas_b/team_1' . $filePath; 
    }

    // Menyimpan data acara ke dalam database
    AcaraSekolah::create([
        'judul' => $judul,
        'konten' => $konten,
        'tanggal' => $tanggal,
        'img' => $filePath 
    ]);

    return $this->redirect('/kelas_b/team_1/Acara_sekolah')->with('success', 'Konten berhasil dibuat.');
}


public function update(Request $request)
{
    $id = $request->input('id');
    $judul = $request->input('judul');
    $konten = $request->input('konten');
    $tanggal = $request->input('tanggal');
    $uploadedFile = $_FILES['img'] ?? null;

    if (empty($judul) || empty($konten) || empty($tanggal)) {
        die("Error: Semua kolom wajib diisi.");
    }

    $Acara = DB::table('acara_sekolah')
                ->select(['id', 'img'])
                ->where('id', '=', $id)
                ->first();

    if (!$Acara) {
        die("Error: Berita dengan ID $id tidak ditemukan.");
    }

    // Proses file upload jika ada file baru
    $filePath = $Acara->img;

    if ($uploadedFile && $uploadedFile['error'] === UPLOAD_ERR_OK) {
        $uploadDir = __DIR__ . '/../../../public/img_gallery_acara_sekolah/';
        $fileName = time() . '_' . basename($uploadedFile['name']);
        $newFilePath = '/img_gallery_acara_sekolah/' . $fileName; 
        $newFullPath = $uploadDir . $fileName;

        // Hapus file lama sebelum memindahkan file baru
        if (!empty($Acara->img)) {
            // Hapus path tambahan "/kelas_b/team_1" sebelum menghapus file lama
            $oldFilePath = str_replace('/kelas_b/team_1', '', $Acara->img); 
            $oldFullPath = __DIR__ . '/../../../public' . $oldFilePath;

            if (file_exists($oldFullPath)) {
                if (!unlink($oldFullPath)) {
                    error_log("Error: Gagal menghapus file lama: $oldFullPath");
                } else {
                    error_log("File lama berhasil dihapus: $oldFullPath");
                }
            } else {
                error_log("File lama tidak ditemukan: $oldFullPath");
            }
        }

        // Membuat direktori jika belum ada
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Pindahkan file baru ke lokasi yang benar
        if (move_uploaded_file($uploadedFile['tmp_name'], $newFullPath)) {
            // Tambahkan '/kelas_b/team_1' pada path setelah file berhasil disimpan
            $filePath = '/kelas_b/team_1' . $newFilePath; 
        } else {
            die("Error: Gagal mengunggah file.");
        }
    }

    // Update data di database
    AcaraSekolah::update($id, [
        'judul' => $judul,
        'konten' => $konten,
        'tanggal' => $tanggal,
        'img' => $filePath,  // Menyimpan path gambar yang baru
    ]);

    return $this->redirect('/kelas_b/team_1/Acara_sekolah')->with('success', 'Konten berhasil diperbarui');
}


public function delete($id)
    {
        AcaraSekolah::delete($id);
        
        return $this->redirect('/kelas_b/team_1/Acara_sekolah')->with('success', 'Data berhasil dihapus');
    }
}
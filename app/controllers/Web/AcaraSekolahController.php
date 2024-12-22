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

    // Validasi input wajib
    if (empty($judul) || empty($konten) || empty($tanggal)) {
        die("Error: Semua kolom wajib diisi.");
    }

    // Ambil data acara dari database
    $acara = DB::table('acara_sekolah')
        ->select(['id', 'img'])
        ->where('id', '=', $id)
        ->first();

    if (!$acara) {
        die("Error: Acara dengan ID $id tidak ditemukan.");
    }

    // Path gambar default menggunakan data lama
    $filePath = $acara->img;

    // Jika ada file baru, proses pengunggahan
    if ($uploadedFile && $uploadedFile['error'] === UPLOAD_ERR_OK) {
        $uploadDir = __DIR__ . '/../../../public/img_gallery_acara_sekolah/';
        $fileName = time() . '_' . basename($uploadedFile['name']);
        $tempFilePath = '/img_gallery_acara_sekolah/' . $fileName; // Path sementara
        $finalFilePath = '/kelas_b/team_1' . $tempFilePath; // Path akhir dengan prefix
        $fullPath = $uploadDir . $fileName;

        // Membuat direktori jika belum ada
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }

        // Pindahkan file baru ke lokasi tujuan
        if (move_uploaded_file($uploadedFile['tmp_name'], $fullPath)) {
            // Hapus file lama jika ada
            if (!empty($acara->img)) {
                $oldFilePath = str_replace('/kelas_b/team_1', '', $acara->img);
                $oldFullPath = __DIR__ . '/../../../public' . $oldFilePath;
                if (file_exists($oldFullPath)) {
                    unlink($oldFullPath);
                }
            }

            // Perbarui path gambar dengan path baru
            $filePath = $finalFilePath;
        } else {
            die("Error: Gagal mengunggah file.");
        }
    }

    // Update data di database
 if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_NO_FILE) {
    AcaraSekolah::update($id, [
        'judul' => $judul,
        'konten' => $konten,
        'tanggal' => $tanggal
    ]);
} else {
    AcaraSekolah::update($id, [
        'judul' => $judul,
        'konten' => $konten,
        'tanggal' => $tanggal,
        'img' => $filePath,
    ]);
}
    return $this->redirect('/kelas_b/team_1/Acara_sekolah')->with('success', 'Acara sekolah berhasil diperbarui');
}


//  // Update data di database
//  if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_NO_FILE) {
//     AcaraSekolah::update($id, [
//         'judul' => $judul,
//         'konten' => $konten,
//         'tanggal' => $tanggal
//     ]);
// } else {
//     AcaraSekolah::update($id, [
//         'judul' => $judul,
//         'konten' => $konten,
//         'tanggal' => $tanggal,
//         'img' => $filePath,
//     ]);
// }

public function delete($id)
    {
        AcaraSekolah::delete($id);
        
        return $this->redirect('/kelas_b/team_1/Acara_sekolah')->with('success', 'Data berhasil dihapus');
    }
}
<?php

namespace Nekolympus\Project\controllers\Web;

use Nekolympus\Project\core\Controller;
use Nekolympus\Project\helpers\Redirect;
use Nekolympus\Project\core\DB;
use Nekolympus\Project\core\Request;
use Nekolympus\Project\models\Berita;

class BeritaController extends Controller
{

    public function index()
    {
        $data = DB::table('berita')
        ->join('admin', 'berita.admin_id', '=', 'admin.id')
        ->select(['berita.id', 'berita.judul', 'berita.konten', 'berita.tanggal', 'berita.img', 'admin.username']) 
        ->get();
        return $this->view('admin.berita.index', ['data' => $data]);
    }


    public function createIndex()
    {
        return $this->view('admin.berita.create');
    }

    public function updateIndex($id)
{
    $berita = Berita::where('id', '=', $id)->first();

    if (!$berita) {
        die("Error: Berita dengan ID $id tidak ditemukan.");
    }

    return $this->view('admin.berita.update', ['data' => $berita]);
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

    // Ambil data berita dari database
    $berita = DB::table('berita')
                ->select(['id', 'img'])
                ->where('id', '=', $id)
                ->first();

    if (!$berita) {
        die("Error: Berita dengan ID $id tidak ditemukan.");
    }

    // Path gambar default menggunakan data lama
    $filePath = $berita->img;

    // Jika ada file baru, proses pengunggahan
    if ($uploadedFile && $uploadedFile['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '/uploads/';
        $fileName = time() . '_' . basename($uploadedFile['name']);
        $tempFilePath = $uploadDir . $fileName; // Path sementara
        $finalFilePath = '/kelas_b/team_1' . $tempFilePath; // Path dengan prefix
        $fullPath = __DIR__ . '/../../../public' . $tempFilePath;

        // Membuat direktori jika belum ada
        if (!is_dir(dirname($fullPath))) {
            mkdir(dirname($fullPath), 0777, true);
        }

        // Pindahkan file baru ke lokasi tujuan
        if (move_uploaded_file($uploadedFile['tmp_name'], $fullPath)) {
            // Hapus file lama jika ada
            if (!empty($berita->img)) {
                $oldFilePath = str_replace('/kelas_b/team_1', '', $berita->img); // Path tanpa prefix
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

    if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_NO_FILE) {
    Berita::update($id, [
        'judul' => $judul,
        'konten' => $konten,
        'tanggal' => $tanggal
    ]);
} else {
    Berita::update($id, [
        'judul' => $judul,
        'konten' => $konten,
        'tanggal' => $tanggal,
        'img' => $filePath,
    ]);
}

    return $this->redirect('/kelas_b/team_1/Berita')->with('success', 'Berita berhasil diperbarui.');
}

// if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_NO_FILE) {
//     Berita::update($id, [
//         'judul' => $judul,
//         'konten' => $konten,
//         'tanggal' => $tanggal
//     ]);
// } else {
//     Berita::update($id, [
//         'judul' => $judul,
//         'konten' => $konten,
//         'tanggal' => $tanggal,
//         'img' => $filePath,
//     ]);
// }

public function create(Request $request)
{
    if (!isset($_SESSION['user'])) {
        die("Error: Anda harus login untuk membuat berita.");
    }

    $admin_id = $_SESSION['auth'];

    $judul = $request->input('judul');
    $konten = $request->input('konten');
    $tanggal = $request->input('tanggal');
    $uploadedFile = $_FILES['img'] ?? null;

    // Validasi input wajib
    if (empty($judul) || empty($konten) || empty($tanggal)) {
        die("Error: Semua kolom wajib diisi.");
    }
    if (trim(strip_tags($konten)) === '') {
        die("Error: Kolom konten tidak boleh kosong.");
    }

    // Periksa apakah judul berita sudah ada
    $existingBerita = DB::table('berita')
                        ->where('judul', '=', $judul)
                        ->first();

    if ($existingBerita) {
        return $this->redirect('/kelas_b/team_1/Berita/create')->with('error', 'Berita dengan judul yang sama sudah ada.');
    }

    // Proses unggah file gambar
    $filePath = null; 
    if ($uploadedFile && $uploadedFile['error'] === UPLOAD_ERR_OK) {
        $uploadDir = '/uploads/';
        $fileName = time() . '_' . basename($uploadedFile['name']);
        $tempFilePath = $uploadDir . $fileName; // Path sementara
        $finalFilePath = '/kelas_b/team_1' . $tempFilePath; // Path dengan prefix
        $fullPath = __DIR__ . '/../../../public' . $tempFilePath; // Path lengkap untuk penyimpanan

        // Membuat direktori jika belum ada
        if (!is_dir(dirname($fullPath))) {
            mkdir(dirname($fullPath), 0777, true);
        }

        // Memindahkan file ke lokasi tujuan
        if (!move_uploaded_file($uploadedFile['tmp_name'], $fullPath)) {
            die("Error: Gagal mengunggah file.");
        }

        // Simpan path akhir ke variabel
        $filePath = $finalFilePath;
    }

    // Simpan data berita ke dalam database
    Berita::create([
        'judul' => $judul,
        'konten' => $konten,
        'tanggal' => $tanggal,
        'admin_id' => $admin_id,
        'img' => $filePath,
    ]);

    return $this->redirect('/kelas_b/team_1/Berita')->with('success', 'Berita berhasil dibuat.');
}


public function delete($id)
    {  
        $berita = Berita::where('id', '=', $id)->first();

        if ($berita) {
            
            $filePath = __DIR__ . '/../../../public' . $berita->img;
    
            if (!empty($berita->img) && file_exists($filePath)) {
                unlink($filePath);
            }
            
            Berita::delete($id);
        } else {
            die("Error: Berita dengan ID $id tidak ditemukan.");
        }  
        return $this->redirect('/kelas_b/team_1/Berita');
    }

 
    
}

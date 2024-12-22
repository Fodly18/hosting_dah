<?php
namespace Nekolympus\Project\controllers\Web;

use Nekolympus\Project\core\Controller;
use Nekolympus\Project\core\DB;
use Nekolympus\Project\core\Request;
use Nekolympus\Project\models\PPDB;

class PpdbController extends Controller
{
    public function index()
{
    $data = DB::table('ppdb')
        ->select(['ppdb.id', 'ppdb.tanggal_mulai', 'ppdb.tanggal_selesai', 'ppdb.img', 'ppdb.status']) 
        ->get();

    // Update status berdasarkan waktu saat ini
    foreach ($data as &$item) {
        $now = date('Y-m-d H:i:s'); // Mendapatkan waktu sekarang
        
        // Memeriksa status berdasarkan rentang tanggal
        if ($now >= $item['tanggal_mulai'] && $now <= $item['tanggal_selesai']) {
            $item['status'] = 'aktif'; // Status aktif jika dalam rentang tanggal mulai dan selesai
        } elseif ($now > $item['tanggal_selesai']) {
            $item['status'] = 'non-aktif'; // Status non-aktif jika sudah lewat tanggal selesai
        } elseif ($now < $item['tanggal_mulai']) {
            $item['status'] = 'belum dimulai'; // Status belum dimulai jika tanggal mulai lebih besar dari sekarang
        }
    }

    return $this->view('admin.Ppdb.index', ['data' => $data]);
}

    public function createIndex()
    {
        return $this->view('admin.Ppdb.create');
    }

    public function updateIndex($id)
    {
        $ppdb = PPDB::where('id', '=', $id)->first();

        if (!$ppdb) {
            die("Error: Data dengan ID $id tidak ditemukan.");
        }
        return $this->view('admin.Ppdb.update', ['data' => $ppdb]);
    }

    public function create(Request $request)
{
    // Validasi dan format tanggal
    $tgl_mulai = date('Y-m-d', strtotime($request->input('tanggal_mulai')));
    $tgl_selesai = date('Y-m-d', strtotime($request->input('tanggal_selesai')));
    $uploadedFile = $_FILES['img'] ?? null;
    $today = date('Y-m-d');
    $errors = [];

    // Validasi tanggal
    if ($tgl_mulai < $today) {
        $errors[] = "Tanggal mulai tidak boleh sebelum hari ini.";
    }
    if ($tgl_selesai < $tgl_mulai) {
        $errors[] = "Tanggal selesai tidak boleh sebelum tanggal mulai.";
    }

    // Menentukan status berdasarkan tanggal
    $status = 'belum dimulai';
    if ($today >= $tgl_mulai && $today <= $tgl_selesai) {
        $status = 'aktif';
    } elseif ($today > $tgl_selesai) {
        $status = 'non-aktif';
    }

    // Query untuk memastikan hanya ada satu poster aktif
    $activePosterCount = DB::table('ppdb')->where('status', '=', 'aktif')->count();
    if ($activePosterCount >= 1) {
        $errors[] = "Tidak boleh ada lebih dari 1 poster aktif.";
    }

    // Validasi file img
    if (!$uploadedFile || $uploadedFile['error'] !== UPLOAD_ERR_OK) {
        $errors[] = "File img wajib diunggah.";
    } elseif (!in_array($uploadedFile['type'], ['image/jpeg', 'image/png', 'image/jpg'])) {
        $errors[] = "Jenis file tidak didukung. Hanya JPEG/PNG yang diperbolehkan.";
    } elseif ($uploadedFile['size'] > 2 * 1024 * 1024) { // 2MB
        $errors[] = "Ukuran file melebihi 2MB.";
    }

    if (!empty($errors)) {
        return $this->view('admin.Ppdb.create', ['errors' => $errors]);
    }

    // Proses unggah file gambar
    $uploadDir = '/gambar_ppdb/';
    $fileName = time() . '_' . basename($uploadedFile['name']);
    $filePath = $uploadDir . $fileName; // Path asli
    $finalFilePath = '/kelas_b/team_1' . $filePath; // Path dengan prefix untuk database
    $fullPath = __DIR__ . '/../../../public' . $filePath; // Path lengkap untuk penyimpanan

    // Membuat direktori jika belum ada
    if (!is_dir(dirname($fullPath))) {
        mkdir(dirname($fullPath), 0777, true);
    }

    // Memindahkan file ke lokasi tujuan
    if (!move_uploaded_file($uploadedFile['tmp_name'], $fullPath)) {
        return $this->view('admin.Ppdb.create', ['errors' => ["Gagal mengunggah file."]]);
    }

    // Simpan data PPDB ke dalam database
    PPDB::create([
        'tanggal_mulai' => $tgl_mulai,
        'tanggal_selesai' => $tgl_selesai,
        'img' => $finalFilePath, // Gunakan path dengan prefix untuk database
        'status' => $status,
    ]);

    return $this->redirect('/kelas_b/team_1/Ppdb')->with('success', 'PPDB berhasil dibuat.');
}

    

   

public function update(Request $request)
{
    $id = $request->input('id');
    $tgl_mulai = $request->input('tanggal_mulai');
    $tgl_selesai = $request->input('tanggal_selesai');
    $uploadedposter = $_FILES['img'] ?? null;

    if (empty($tgl_mulai) || empty($tgl_selesai)) {
        die("Error: Tanggal mulai dan tanggal selesai wajib diisi.");
    }

    $tgl_mulai = date('Y-m-d', strtotime($tgl_mulai));
    $tgl_selesai = date('Y-m-d', strtotime($tgl_selesai));
    $today = date('Y-m-d');

    if ($tgl_mulai < $today) {
        die("Error: Tanggal mulai tidak boleh sebelum hari ini.");
    }
    if ($tgl_selesai < $tgl_mulai) {
        die("Error: Tanggal selesai tidak boleh sebelum tanggal mulai.");
    }

    // Ambil data lama
    $ppdb = DB::table('ppdb')->where('id', '=', $id)->first();
    if (!$ppdb) {
        die("Error: Data dengan ID $id tidak ditemukan.");
    }

    // Konversi ke object jika perlu
    if (is_array($ppdb)) {
        $ppdb = (object)$ppdb;
    }

    $filePath = $ppdb->img; // Path gambar lama

    // Proses upload gambar baru jika ada
    if ($uploadedposter && $uploadedposter['error'] === UPLOAD_ERR_OK) {
        $allowedExtensions = ['jpg', 'jpeg', 'png'];
        $fileExtension = pathinfo($uploadedposter['name'], PATHINFO_EXTENSION);

        if (!in_array(strtolower($fileExtension), $allowedExtensions)) {
            die("Error: Hanya file dengan ekstensi .jpg, .jpeg, atau .png yang diperbolehkan.");
        }

        $uploadDir = '/gambar_ppdb/';
        $fileName = time() . '_' . basename($uploadedposter['name']);
        $tempFilePath = $uploadDir . $fileName; // Path sementara
        $finalFilePath = '/kelas_b/team_1' . $tempFilePath; // Path dengan prefix untuk database
        $fullPath = __DIR__ . '/../../../public' . $tempFilePath; // Path lengkap untuk penyimpanan

        if (!is_dir(dirname($fullPath))) {
            mkdir(dirname($fullPath), 0777, true);
        }

        if (move_uploaded_file($uploadedposter['tmp_name'], $fullPath)) {
            // Hapus file lama jika ada
            $oldFilePath = __DIR__ . '/../../../public' . $ppdb->img;
            if (!empty($ppdb->img) && file_exists($oldFilePath)) {
                unlink($oldFilePath);
            }

            // Simpan path baru ke filePath
            $filePath = $finalFilePath;
        } else {
            die("Error: Gagal mengunggah file img.");
        }
    }

    // Tentukan status baru
    $status = 'belum dimulai';
    if ($tgl_mulai <= $today && $tgl_selesai >= $today) {
        $status = 'aktif';
    } elseif ($tgl_selesai < $today) {
        $status = 'non-aktif';
    }
    
if (isset($_FILES['img']) && $_FILES['img']['error'] === UPLOAD_ERR_NO_FILE) {
    PPDB::update($id, [
        'tanggal_mulai' => $tgl_mulai,
        'tanggal_selesai' => $tgl_selesai,
    ]);
} else {
    PPDB::update($id, [
        'tanggal_mulai' => $tgl_mulai,
        'tanggal_selesai' => $tgl_selesai,
        'img' => $filePath ?? '/path/to/default.jpg',
        'status' => $status,
    ]);
}

    return $this->redirect('/kelas_b/team_1/Ppdb')->with('success', 'Data berhasil diperbarui.');
}


    public function delete($id)
    {  
        $ppdb = PPDB::where('id', '=', $id)->first();

        if ($ppdb) {
            
            $filePath = __DIR__ . '/../../../public' . $ppdb->img;
    
            if (!empty($ppdb->img) && file_exists($filePath)) {
                unlink($filePath);
            }
            
            PPDB::delete($id);
        } else {
            die("Error: Berita dengan ID $id tidak ditemukan.");
        }  
        return $this->redirect('/kelas_b/team_1/Ppdb');
    }

}
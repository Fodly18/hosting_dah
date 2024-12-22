<?php

namespace Nekolympus\Project\controllers\Web;

use Nekolympus\Project\core\Controller;
use Nekolympus\Project\helpers\Redirect;
use Nekolympus\Project\core\DB;
use Nekolympus\Project\core\Request;
use Nekolympus\Project\models\Jadwal;
use Nekolympus\Project\models\MapelKelas;

class JadwalController extends Controller
{
    public function index()
    {
        $jadwal = DB::table('jadwal')
        ->join('mapel_kelas', 'jadwal.id_mapel_kelas', '=', 'mapel_kelas.id')
        ->join('kelas', 'mapel_kelas.id_kelas', 'kelas.id')
        ->join('mapel', 'mapel_kelas.id_mapel', 'mapel.id')
        ->select(['jadwal.id', 'mapel.nama as mapel', 'kelas.kelas', 'jadwal.hari', 'jadwal.jam_mulai', 'jadwal.jam_selesai'])
        ->get();

        return $this->view('admin.jadwal.index', ['data' => $jadwal]);
    }

    public function createIndex()
    {
        $mapelkelas = DB::table('mapel_kelas')
        ->join('mapel', 'mapel_kelas.id_mapel', '=', 'mapel.id')
        ->join('kelas', 'mapel_kelas.id_kelas', '=', 'kelas.id')
        ->select([
            'mapel_kelas.id',
            'mapel.nama as nama',
            'kelas.kelas as kelas',
        ])
        ->get();
    
        return $this->view('admin.jadwal.create', [
            'mapelkelas' => $mapelkelas
        ]);
    }

    public function create(Request $request)
    {
        $Jadwal = Jadwal::create([
            'id_mapel_kelas' => $request->input('mapel_kelas'),
            'hari' => $request->input('hari'),
            'jam_mulai' => $request->input('jam_mulai'),
            'jam_selesai' => $request->input('jam_selesai'),
        ]);
        
        return $this->redirect('/kelas_b/team_1/jadwal');
    }

    public function updateIndex($id)
    {
        $mapelkelas = DB::table('mapel_kelas')
        ->join('mapel', 'mapel_kelas.id_mapel', '=', 'mapel.id')
        ->join('kelas', 'mapel_kelas.id_kelas', '=', 'kelas.id')
        ->select([
            'mapel_kelas.id',
            'mapel.nama as nama',
            'kelas.kelas as kelas',
        ])
        ->get();

        $jadwal = DB::table('jadwal')
        ->join('mapel_kelas', 'jadwal.id_mapel_kelas', '=', 'mapel_kelas.id')
        ->join('kelas', 'mapel_kelas.id_kelas', 'kelas.id')
        ->join('mapel', 'mapel_kelas.id_mapel', 'mapel.id')
        ->select(['jadwal.id', 'mapel_kelas.id as id_mapel_kelas', 'mapel.nama as mapel', 'kelas.kelas', 'jadwal.hari', 'jadwal.jam_mulai', 'jadwal.jam_selesai'])
        ->where('jadwal.id', '=', $id)
        ->first();

        return $this->view('admin.jadwal.update', ['data' => $jadwal, 'mapelkelas' => $mapelkelas]);
    }

    public function update(Request $request)
    {
        $jadwal = Jadwal::update($request->input('id'), [
            'id_mapel_kelas' => $request->input('mapel_kelas'),
            'hari' => $request->input('hari'),
            'jam_mulai' => $request->input('jam_mulai'),
            'jam_selesai' => $request->input('jam_selesai'),
        ]);

        return $this->redirect('/kelas_b/team_1/jadwal');
    }

    public function delete($id)
    {
        Jadwal::delete($id);

        return $this->redirect('/kelas_b/team_1/jadwal');
    }
}

<?php

namespace Nekolympus\Project\controllers\Web;

use Nekolympus\Project\core\Controller;
use Nekolympus\Project\helpers\Redirect;
use Nekolympus\Project\core\DB;
use Nekolympus\Project\core\Request;
use Nekolympus\Project\models\Guru;
use Nekolympus\Project\models\Kelas;
use Nekolympus\Project\models\Mapel;
use Nekolympus\Project\models\MapelKelas;

class MapelKelasController extends Controller
{
    public function index()
    {
        $data = DB::table('mapel_kelas')
            ->join('mapel', 'mapel_kelas.id_mapel', '=', 'mapel.id')
            ->join('kelas', 'mapel_kelas.id_kelas', '=', 'kelas.id')
            ->join('guru', 'mapel_kelas.id_guru', '=', 'guru.id')
            ->select([
                'mapel_kelas.id',
                'mapel.nama as nama',
                'kelas.kelas as kelas',
                'guru.nama as guru',
            ])
            ->get();
        return $this->view('admin.mapelkelas.index', ['data' => $data]);
    }

    public function createIndex()
    {

        $kelas = Kelas::all();
        $guru = Guru::all();
        $mapel = Mapel::all();

        return $this->view('admin.mapelkelas.create', ['kelas' => $kelas, 'guru' => $guru, 'mapel' => $mapel]);
    }

    public function create(Request $request)
    {
        $Mapelkelas = MapelKelas::create([
            'id_mapel' => $request->input('mapel'),
            'id_kelas' => $request->input('kelas'),
            'id_guru' => $request->input('guru'),
        ]);
        

        return $this->redirect('/kelas_b/team_1/mapelkelas')->with('success', 'Data berhasil ditambahkan.');
    }

    public function updateIndex($id)
    {
        $kelas = Kelas::all();
        $guru = Guru::all();
        $mapel = Mapel::all();
        
        $data = DB::table('mapel_kelas')
                ->join('mapel', 'mapel_kelas.id_mapel', '=', 'mapel.id')
                ->join('kelas', 'mapel_kelas.id_kelas', '=', 'kelas.id')
                ->join('guru', 'mapel_kelas.id_guru', '=', 'guru.id')
                ->select(['mapel_kelas.id', 'mapel.id as id_mapel', 'kelas.id as id_kelas', 'guru.id as id_guru'])
                ->where('mapel_kelas.id', '=', $id)
                ->first();
        var_dump($data);
        return $this->view('admin.mapelkelas.update', ['data' => $data, 'kelas' => $kelas, 'guru' => $guru, 'mapel' => $mapel]);
    }

    public function update(Request $request)
    {
        $Mapelkelas = MapelKelas::update($request->input('id'), [
            'id_mapel' => $request->input('mapel'),
            'id_kelas' => $request->input('kelas'),
            'id_guru' => $request->input('guru'),
        ]);

        return $this->redirect('/kelas_b/team_1/mapelkelas')->with('success', 'Data berhasil diperbarui.');
    }

    public function delete($id)
    {
        MapelKelas::delete($id);

        return $this->redirect('/kelas_b/team_1/mapelkelas')->with('success', 'Data berhasil dihapus.');
    }
}

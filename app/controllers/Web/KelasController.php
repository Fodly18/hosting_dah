<?php

namespace Nekolympus\Project\controllers\Web;

use Nekolympus\Project\core\Controller;
use Nekolympus\Project\core\DB;
use Nekolympus\Project\core\Request;
use Nekolympus\Project\models\Guru;
use Nekolympus\Project\models\Kelas;

class KelasController extends Controller
{
    public function index()
    {
        $data = DB::table('kelas')
        ->join('guru', 'kelas.id_guru', '=', 'guru.id')
        ->select([
            'kelas.id',
            'kelas.kelas',
            'guru.nama as guru'
        ])
        ->get();

        return $this->view('admin.kelas.index', ['data' => $data]);
    }

    public function createIndex()
    {
        $guru = Guru::all();
        return $this->view('admin.kelas.create', ['data' => $guru]);
    }

    public function create(Request $request)
    {
        $Kelas = Kelas::create([
            'kelas' => $request->input('kelas'),
            'id_guru' => $request->input('guru')
        ]);

        return $this->redirect('/kelas_b/team_1/kelas');
    }

    public function updateIndex($id)
    {
        $guru = Guru::all();
        $data = DB::table('kelas')
        ->join('guru', 'kelas.id_guru', '=', 'guru.id')
        ->select([
            'guru.id as id_guru',
            'kelas.id',
            'kelas.kelas',
            'guru.nama as guru'
        ])->where('kelas.id', '=', $id)
        ->first();

        return $this->view('admin.kelas.update', ['data' => $data, 'dataGuru' => $guru]);
    }

    public function update(Request $request)
    {
        $kelas = Kelas::update($request->input('id'), [
            'kelas' => $request->input('kelas'),
            'id_guru' => $request->input('guru')
        ]);

        return $this->redirect('/kelas_b/team_1/kelas');
    }

    public function delete($id)
    {
        Kelas::delete($id);
        return $this->redirect('/kelas_b/team_1/kelas');
    }
}

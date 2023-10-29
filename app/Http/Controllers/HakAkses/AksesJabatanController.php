<?php

namespace App\Http\Controllers\HakAkses;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\users;
use App\Models\roles;
use App\Models\permissions;
use App\Models\model_has_roles;
use App\Models\role_has_permissions;
use Redirect;
use Carbon\Carbon;

class AksesJabatanController extends Controller
{
    function index()
    {
        $role = roles::where('name', '<>','administrator')->orderBy('updated_at','desc')->get();
        $permission = permissions::orderBy('name','asc')->get();
        $show = role_has_permissions::select('role_id','roles.name')
                ->join('roles','roles.id','=','role_has_permissions.role_id')
                ->groupBy('role_id','roles.name')
                ->orderBy('roles.name')
                ->get();
        $selection = role_has_permissions::join('permissions','permissions.id','=','role_has_permissions.permission_id')
                ->join('roles','roles.id','=','role_has_permissions.role_id')
                ->select('roles.id as id_role','permissions.id as id_permission','permissions.name as name_permission','role_has_permissions.*')
                ->get();

        // print_r($show);
        // die();

        $data = [
            'role' => $role,
            'permission' => $permission,
            'selection' => $selection,
            'show' => $show
        ];

        return view('pages.hakakses.aksesjabatan.index')->with('list', $data);
    }

    function store(Request $request)
    {

    }

    function storeAkses(Request $request){
        print_r($request->all());
        die();
        $data = new role_has_permissions;
        $data->name = $request->role;
        $data->guard_name = 'web';

        // $data->save();

        return Redirect::back()->with('message','Tambah Jabatan Baru Berhasil');
    }

    function storeJabatan(Request $request){
        $data = new roles;
        $data->name = $request->name;
        $data->guard_name = 'web';

        $data->save();

        return Redirect::back()->with('message','Tambah Jabatan Baru Berhasil');
    }

    // API
    function tableAkses()
    {
        $show = permissions::get();

        $data = [
            'show' => $show,
        ];

        return response()->json($data, 200);
    }

    function tableJabatan()
    {
        $show = roles::get();

        $data = [
            'show' => $show,
        ];

        return response()->json($data, 200);
    }

    function hapusAkses($id){
        $tgl = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm a');

        $data = role_has_permissions::where('role_id', $id)->delete();

        return response()->json($tgl, 200);
    }

    function hapusJabatan($id){
        $tgl = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm a');

        $data = roles::where('id', $id)->first();
        $data->delete();

        return response()->json($tgl, 200);
    }

    function destroy($id){
        $tgl = Carbon::now()->isoFormat('dddd, D MMMM Y, HH:mm a');

        $data = role_has_permissions::where('id', $id)->first();
        $data->delete();

        return response()->json($tgl, 200);
    }

}

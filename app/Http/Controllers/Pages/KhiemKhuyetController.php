<?php

namespace App\Http\Controllers\Pages;

use DB;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Log;

class KhiemKhuyetController extends Controller
{
    public function index()
    {
        $per_page = 5;
        $roles = auth()->user()->permission()->first()->slug;
        $khiemkhuyet = DB::table('khiem_khuyet')
                    ->leftJoin('users', 'users.id', '=', 'khiem_khuyet.id_nv')
                    ->leftJoin('users as users2', 'users2.id', '=', 'khiem_khuyet.id_nvw')
                    ->leftJoin('status_nv', 'status_nv.id', '=', 'khiem_khuyet.id_status_nv')
                    ->leftJoin('note_nv', 'note_nv.id', '=', 'khiem_khuyet.id_note_nv')
                    ->leftJoin('status_ql', 'status_ql.id', '=', 'khiem_khuyet.id_status_ql')
                    ->leftJoin('note_ql', 'note_ql.id', '=', 'khiem_khuyet.id_note_ql')
                    // ->where('note_nv.type', '=', 'kk')
                    // ->where('note_ql.type', '=', 'kk')
                    ->orderBy('khiem_khuyet.update_time_nv', 'desc')
                    ->orderBy('khiem_khuyet.update_time_ql', 'desc')
                    ->select(
                        'khiem_khuyet.id as id',
                        'khiem_khuyet.id_nvw as id_nvw',
                        'users2.msnv as msnv_nvw',
                        DB::raw("CONCAT(users2.msnv, '_', users2.name) as name_nvw"),
                        DB::raw("CONCAT(users.msnv, '-', users.name) as msnv"),
                        DB::raw("DATE_FORMAT(khiem_khuyet.update_time_nv,'%d-%m-%Y %H:%i:%s') as update_time_nv"),
                        DB::raw("DATE_FORMAT(khiem_khuyet.update_time_ql,'%d-%m-%Y %H:%i:%s') as update_time_ql"),
                        DB::raw("(select 'khiem_khuyet') as type"),
                        'status_nv.id as status_nv_id',
                        'content_note_nv as note_nv',
                        'status_ql.id as status_ql_id',
                        'content_note_ql as note_ql',
                        'users.permission_id',
                    );
                    // if auth is user, can not see all tasks
                    if ( $roles == 'user' ){
                        $khiemkhuyet = $khiemkhuyet->where('khiem_khuyet.id_nv', '=', auth()->user()->id)
                                                   ->orWhere('khiem_khuyet.id_nvw', '=', auth()->user()->id)
                                                   ->where('khiem_khuyet.id_status_nv', '!=', '3');
                    }
                    $khiemkhuyet = $khiemkhuyet->paginate($per_page);
                    // dd($khiemkhuyet);
            $status_nv = DB::select('select * from status_nv');
            $status_ql = DB::select('select * from status_ql');

        return view('pages.khiem_khuyet.khiem_khuyet', [
            'khiemkhuyet' => $khiemkhuyet,
            'status_nv'=> $status_nv,
            'status_ql'=> $status_ql,
            'roles'    => $roles
        ]);
    }

    public function detail(Request $request) {
        if ( isset($request->task_id) ) {
            if (isset($request->type)){
                if( $request->type == 'khiem_khuyet' ) {
                    $task = DB::table('khiem_khuyet')
                    ->leftJoin('users', 'users.id', '=', 'khiem_khuyet.id_nv')
                    ->leftJoin('users as users2', 'users2.id', '=', 'khiem_khuyet.id_nvw')
                    ->leftJoin('status_nv', 'status_nv.id', '=', 'khiem_khuyet.id_status_nv')
                    ->leftJoin('note_nv', 'note_nv.id', '=', 'khiem_khuyet.id_note_nv')
                    ->leftJoin('status_ql', 'status_ql.id', '=', 'khiem_khuyet.id_status_ql')
                    ->leftJoin('note_ql', 'note_ql.id', '=', 'khiem_khuyet.id_note_ql')
                    ->select(
                        'khiem_khuyet.id as id',
                        DB::raw("DATE_FORMAT(khiem_khuyet.create_time,'%d-%m-%Y %H:%i:%s') as create_time"),
                        DB::raw("DATE_FORMAT(khiem_khuyet.update_time_nv,'%d-%m-%Y %H:%i:%s') as update_time_nv"),
                        DB::raw("DATE_FORMAT(khiem_khuyet.update_time_ql,'%d-%m-%Y %H:%i:%s') as update_time_ql"),
                        'status_nv.status',
                        'khiem_khuyet.xuat_tuyen',
                        'khiem_khuyet.tu_tru_den_tru',
                        'khiem_khuyet.loai_khiem_khuyet',
                        'khiem_khuyet.noi_dung_khiem_khuyet',
                        'khiem_khuyet.vat_tu',
                        'khiem_khuyet.bien_phap_at',
                        'khiem_khuyet.de_xuat',
                        'khiem_khuyet.muc_do',
                        'khiem_khuyet.images',
                        'khiem_khuyet.images_nvw',
                        // creator
                        'users.msnv as msnv',
                        'users.name',
                        // nvw
                        'users2.msnv as msnv_nvw',
                        'users2.name as name_nvw',
                    );
                    $task = $task->where('khiem_khuyet.id', '=', $request->task_id)
                         ->get();
                return view('pages.khiem_khuyet.khiem_khuyet_detail', [
                    'task'  => $task[0]
                ]);
                }
            }
        }
    }

}

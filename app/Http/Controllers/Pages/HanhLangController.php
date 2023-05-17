<?php

namespace App\Http\Controllers\Pages;

use DB;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Log;
use PhpOffice\PhpSpreadsheet\IOFactory;

const PER_PAGE = 5;

class HanhLangController extends Controller
{
    public function index()
    {
        $roles = auth()->user()->permission()->first()->slug;
        $hanhlang = DB::table('hanh_lang')
                    ->leftJoin('users', 'users.id', '=', 'hanh_lang.id_nv')
                    ->leftJoin('users as users2', 'users2.id', '=', 'hanh_lang.id_nvw')
                    ->leftJoin('status_nv', 'status_nv.id', '=', 'hanh_lang.id_status_nv')
                    ->leftJoin('note_nv', 'note_nv.id', '=', 'hanh_lang.id_note_nv')
                    ->leftJoin('status_ql', 'status_ql.id', '=', 'hanh_lang.id_status_ql')
                    ->leftJoin('note_ql', 'note_ql.id', '=', 'hanh_lang.id_note_ql')
                    // ->where('note_nv.type', '=', 'hl')
                    // ->where('note_ql.type', '=', 'hl')
                    ->orderBy('hanh_lang.update_time_nv', 'desc')
                    ->orderBy('hanh_lang.update_time_ql', 'desc')
                    ->select(
                        'hanh_lang.id as id',
                        'hanh_lang.id_nvw as id_nvw',
                        'users2.msnv as msnv_nvw',
                        DB::raw("CONCAT(users2.msnv, '_', users2.name) as name_nvw"),
                        DB::raw("CONCAT(users.msnv, '-', users.name) as msnv"),
                        DB::raw("DATE_FORMAT(hanh_lang.update_time_nv,'%d-%m-%Y %H:%i:%s') as update_time_nv"),
                        DB::raw("DATE_FORMAT(hanh_lang.update_time_ql,'%d-%m-%Y %H:%i:%s') as update_time_ql"),
                        DB::raw("(select 'hanh_lang') as type"),
                        'status_nv.id as status_nv_id',
                        'note_nv.content_note_nv as note_nv',
                        'status_ql.id as status_ql_id',
                        'note_ql.content_note_ql as note_ql',
                        'users.permission_id'
                    );
                    // if auth is user, can not see all tasks
                    if ( $roles != 'admin' ){
                        $hanhlang = $hanhlang->where('hanh_lang.id_nv', '=', auth()->user()->id)
                                             ->orWhere('hanh_lang.id_nvw', '=', auth()->user()->id)
                                             ->where('hanh_lang.id_status_nv', '!=', '3');
                    }
                    $hanhlang = $hanhlang->paginate(PER_PAGE);
            $status_nv = DB::select('select * from status_nv');
            $status_ql = DB::select('select * from status_ql');
        // dd($hanhlang->toArray());
        return view('pages.hanh_lang.hanh_lang', [
            'hanhlang' => $hanhlang,
            'status_nv'=> $status_nv,
            'status_ql'=> $status_ql,
            'roles'    => $roles
        ]);
    }
    public function detail(Request $request) {

        if ( isset($request->task_id) ) {
            if (isset($request->type)){
                if( $request->type == 'hanh_lang' ) {
                    $task = DB::table('hanh_lang')
                    ->leftJoin('users', 'users.id', '=', 'hanh_lang.id_nv')
                    ->leftJoin('users as users2', 'users2.id', '=', 'hanh_lang.id_nvw')
                    ->leftJoin('status_nv', 'status_nv.id', '=', 'hanh_lang.id_status_nv')
                    ->leftJoin('note_nv', 'note_nv.id', '=', 'hanh_lang.id_note_nv')
                    ->leftJoin('status_ql', 'status_ql.id', '=', 'hanh_lang.id_status_ql')
                    ->leftJoin('note_ql', 'note_ql.id', '=', 'hanh_lang.id_note_ql')
                    ->select(
                        'hanh_lang.id as id',
                        DB::raw("DATE_FORMAT(hanh_lang.create_time,'%d-%m-%Y %H:%i:%s') as create_time"),
                        DB::raw("DATE_FORMAT(hanh_lang.update_time_nv,'%d-%m-%Y %H:%i:%s') as update_time_nv"),
                        DB::raw("DATE_FORMAT(hanh_lang.update_time_ql,'%d-%m-%Y %H:%i:%s') as update_time_ql"),
                        'status_nv.status',
                        'hanh_lang.xuat_tuyen',
                        'hanh_lang.tu_tru_den_tru',
                        'hanh_lang.so_cay',
                        'hanh_lang.khoang_cach',
                        'hanh_lang.pa_phat_quang',
                        'hanh_lang.de_xuat',
                        'hanh_lang.muc_do',
                        'hanh_lang.images',
                        'hanh_lang.images_nvw',
                        // creator
                        'users.msnv as msnv',
                        'users.name',
                        // nvw
                        'users2.msnv as msnv_nvw',
                        'users2.name as name_nvw',
                    );
                    $task = $task->where('hanh_lang.id', '=', $request->task_id)
                         ->get();
                return view('pages.hanh_lang.hanh_lang_detail', [
                    'task'  => $task[0]
                ]);
                }
            }
        }
    }
}

<?php

namespace App\Http\Controllers\APIs;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Database\QueryException;
use Symfony\Component\HttpFoundation\Response;
use DB;
use App\Models\HanhLangModel;
use App\Models\KhiemKhuyetModel;
use App\Models\NoteNV;
use App\Models\NoteQL;

class ApiController extends Controller
{

    private $response = [
        'message'   => null,
        'data'      => null
    ];

    public function test(Request $request)
    {
        // $row = new User;
        // $row->msnv = '001';
        // $row->password = 'abc';
        // $row->save();
        return $request->user()->id;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        $msnv = Auth::user()->msnv;
        $id_nv = Auth::user()->id;
        $roles = auth()->user()->permission()->first()->slug;
        $hanhlang = DB::table('hanh_lang')
                    ->leftJoin('users', 'users.id', '=', 'hanh_lang.id_nv')
                    ->leftJoin('users as users2', 'users2.id', '=', 'hanh_lang.id_nvw')
                    ->leftJoin('status_nv', 'status_nv.id', '=', 'hanh_lang.id_status_nv')
                    ->leftJoin('note_nv', 'note_nv.id', '=', 'hanh_lang.id_note_nv')
                    ->leftJoin('status_ql', 'status_ql.id', '=', 'hanh_lang.id_status_ql')
                    ->leftJoin('note_ql', 'note_ql.id', '=', 'hanh_lang.id_note_ql')
                    ->orderBy('hanh_lang.update_time_nv', 'desc')
                    ->orderBy('hanh_lang.update_time_ql', 'desc')
                    ->select(
                        'hanh_lang.id as id',
                        'hanh_lang.id_nvw as id_nvw',
                        'users2.msnv as msnv_nvw',
                        DB::raw("CONCAT(users2.msnv, '_', users2.name) as name_nvw"),
                        'users.msnv as msnv_create',
                        'users.name as name_create',
                        DB::raw("CONCAT(users.msnv, '-', users.name) as msnv_name_create"),
                        DB::raw("DATE_FORMAT(hanh_lang.update_time_nv,'%d-%m-%Y %H:%i:%s') as update_time_nv"),
                        DB::raw("DATE_FORMAT(hanh_lang.update_time_ql,'%d-%m-%Y %H:%i:%s') as update_time_ql"),
                        DB::raw("(select 'hanh_lang') as type"),
                        'status_nv.id as status_nv_id',
                        'content_note_nv as note_nv',
                        'status_ql.id as status_ql_id',
                        'content_note_ql as note_ql',
                        // data task
                        'hanh_lang.xuat_tuyen',
                        'hanh_lang.tu_tru_den_tru',
                        'hanh_lang.so_cay',
                        'hanh_lang.khoang_cach',
                        'hanh_lang.pa_phat_quang',
                        'hanh_lang.de_xuat',
                        'hanh_lang.muc_do',
                        'hanh_lang.images',
                        DB::raw("(select '') as loai_khiem_khuyet"),
                        DB::raw("(select '') as noi_dung_khiem_khuyet"),
                        DB::raw("(select '') as vat_tu"),
                        DB::raw("(select '') as bien_phap_at"),
                    );
                    // if auth is user, can not see all tasks
        if ( $roles != 'admin' ){
            // $hanhlang = $hanhlang->where('hanh_lang.id_nv', '=', $id_nv)
            //         ->orWhere('hanh_lang.id_nvw', '=', $id_nv);
            $hanhlang = $hanhlang->where('hanh_lang.id_nvw', '=', $id_nv);
        }
        $hanhlang = $hanhlang->get();
        // khiem khuyet
        $khiemkhuyet = DB::table('khiem_khuyet')
                    ->leftJoin('users', 'users.id', '=', 'khiem_khuyet.id_nv')
                    ->leftJoin('users as users2', 'users2.id', '=', 'khiem_khuyet.id_nvw')
                    ->leftJoin('status_nv', 'status_nv.id', '=', 'khiem_khuyet.id_status_nv')
                    ->leftJoin('note_nv', 'note_nv.id', '=', 'khiem_khuyet.id_note_nv')
                    ->leftJoin('status_ql', 'status_ql.id', '=', 'khiem_khuyet.id_status_ql')
                    ->leftJoin('note_ql', 'note_ql.id', '=', 'khiem_khuyet.id_note_ql')
                    ->orderBy('khiem_khuyet.update_time_nv', 'desc')
                    ->orderBy('khiem_khuyet.update_time_ql', 'desc')
                    ->select(
                        'khiem_khuyet.id as id',
                        'khiem_khuyet.id_nvw as id_nvw',
                        'users2.msnv as msnv_nvw',
                        DB::raw("CONCAT(users2.msnv, '_', users2.name) as name_nvw"),
                        'users.msnv as msnv_create',
                        'users.name as name_create',
                        DB::raw("CONCAT(users.msnv, '-', users.name) as msnv_name_create"),
                        DB::raw("DATE_FORMAT(khiem_khuyet.update_time_nv,'%d-%m-%Y %H:%i:%s') as update_time_nv"),
                        DB::raw("DATE_FORMAT(khiem_khuyet.update_time_ql,'%d-%m-%Y %H:%i:%s') as update_time_ql"),
                        DB::raw("(select 'khiem_khuyet') as type"),
                        'status_nv.id as status_nv_id',
                        'content_note_nv as note_nv',
                        'status_ql.id as status_ql_id',
                        'content_note_ql as note_ql',
                        // data task
                        'khiem_khuyet.xuat_tuyen',
                        'khiem_khuyet.tu_tru_den_tru',
                        'khiem_khuyet.de_xuat',
                        'khiem_khuyet.muc_do',
                        'khiem_khuyet.loai_khiem_khuyet',
                        'khiem_khuyet.noi_dung_khiem_khuyet',
                        'khiem_khuyet.vat_tu',
                        'khiem_khuyet.bien_phap_at',
                        'khiem_khuyet.images',
                        DB::raw("(select '') as so_cay"),
                        DB::raw("(select '') as khoang_cach"),
                        DB::raw("(select '') as pa_phat_quang"),
                    );
                    // if auth is user, can not see all tasks
        if ( $roles != 'admin' ){
            // $khiemkhuyet = $khiemkhuyet->where('khiem_khuyet.id_nv', '=', $id_nv)
            //         ->orWhere('khiem_khuyet.id_nvw', '=', $id_nv);
            $khiemkhuyet = $khiemkhuyet->where('khiem_khuyet.id_nvw', '=', $id_nv);

        }
        $khiemkhuyet = $khiemkhuyet->get();
        $data = $hanhlang->merge($khiemkhuyet);

        $this->response['message']    = 'succees';
        $this->response['data']       = $data;
        return response()->json($this->response, 200);
    }

    public function updateTask(Request $request)
    {
        $request->validate([
            'id'           => 'required',
            'id_status_nv' => 'required',
            'toa_do_nvw'   => 'required',
            'type'         => 'required',
            'image'        => 'required'
        ]);
        $data = [
            'id_nvw'         => $request->user()->id,
            'id_status_nv'   => $request->id_status_nv,
            'toa_do_nvw'     => $request->toa_do_nvw,
            'update_time_nv' => now(),
            'images'         => $request->image,
        ];
        try {
            DB::table($request->type)
                ->where($request->type.'.id', '=', $request->id)
                ->update($data);
            $this->response['message']    = 'success';
            $this->response['data']       = 'Update task success!';
            return response()->json($this->response, 200);
        } catch (QueryException $e) {
            print_r($e);
        }
    }

    public function createTask(Request $request)
    {
        $request->validate([
            'type'  => 'required',
            'msnv'  => 'required',
            'toa_do_nv' => 'required',
            'device_info' => 'required'
        ]);

        //create note nv
        $notenv = new NoteNV;
        $notenv->type = $request->type;
        $notenv->id_nv = $request->user()->id;
        $notenv->content_note_nv = $request->note_nv;
        $notenv->save();
        $id_note_nv = $notenv->id;
        // create note ql
        $noteql = new NoteQL;
        $noteql->type = $request->type;
        $noteql->save();
        $id_note_ql = $noteql->id;

        if($request->type == 'hanh_lang') {
            $row = new HanhLangModel;
            $row->id_nv = $request->user()->id;
            $row->create_time = now();
            $row->update_time_nv = now();
            $row->id_note_nv = $id_note_nv;
            $row->id_note_ql = $id_note_ql;
            $row->toa_do_nv = $request->toa_do_nv;
            $row->xuat_tuyen = $request->xuat_tuyen;
            $row->tu_tru_den_tru = $request->tu_tru_den_tru;
            $row->de_xuat = $request->de_xuat;
            $row->muc_do = $request->muc_do;
            $row->device_info = $request->device_info;
            $row->images = $request->image;
            $row->images_nvw = '';
            //
            $row->so_cay = $request->so_cay;
            $row->khoang_cach = $request->khoang_cach;
            $row->pa_phat_quang = $request->pa_phat_quang;
            $row->save();
        }else if ($request->type == 'khiem_khuyet') {
            $row = new KhiemKhuyetModel;
            $row->id_nv = $request->user()->id;
            $row->create_time = now();
            $row->update_time_nv = now();
            $row->id_note_nv = $id_note_nv;
            $row->id_note_ql = $id_note_ql;
            $row->toa_do_nv = $request->toa_do_nv;
            $row->xuat_tuyen = $request->xuat_tuyen;
            $row->tu_tru_den_tru = $request->tu_tru_den_tru;
            $row->de_xuat = $request->de_xuat;
            $row->muc_do = $request->muc_do;
            $row->device_info = $request->device_info;
            $row->images = $request->image;
            $row->images_nvw = '';
            //
            $row->loai_khiem_khuyet = $request->loai_khiem_khuyet;
            $row->noi_dung_khiem_khuyet = $request->noi_dung_khiem_khuyet;
            $row->vat_tu = $request->vat_tu;
            $row->bien_phap_at = $request->bien_phap_at;
            $row->save();
        }
        return response()->json($request->all(), 200);
    }

    public function imageStore(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:100000',
        ]);
        $image_path = $request->file('image')->store('image', 'public');

        $data = [
            'image' => "storage/{$image_path}",
            "message" => "Image Uploaded Successfully",
            "status" => true
        ];

        return response($data, Response::HTTP_CREATED);
    }
}

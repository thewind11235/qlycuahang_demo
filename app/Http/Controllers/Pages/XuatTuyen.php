<?php

namespace App\Http\Controllers\Pages;

use App\Models\User;
use App\Models\XuatTuyen as XuatTuyenModel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use DB;


const ADMIN_PERMISSION = 1;
const PER_PAGE         = 5;

class XuatTuyen extends Controller
{
    public function index() {
        $data['items'] = XuatTuyenModel::orderBy('created_at','desc')
                                        ->paginate(PER_PAGE);
        return view("pages.xuat_tuyen.xuat_tuyen", $data);
    }

    public function search(Request $request) {
        $data['key_word'] = $key_word = $request->key_word;
        $data['items'] = XuatTuyenModel::where('name', 'like', "%$key_word%")
                                        ->orderBy('created_at','desc')
                                        ->paginate(PER_PAGE)
                                        ->appends(['key_word' => $key_word]);
        return view("pages.xuat_tuyen.xuat_tuyen", $data);
    }

    public function create_index() {
        return view("pages.xuat_tuyen.xuat_tuyen_create");
    }

    public function create(Request $request) {
        $exists = XuatTuyenModel::where('name', $request->name)->exists();
        if ($exists) {
            return back()->with('error', 'Xuất tuyến đã tồn tại!');
        }
        $data = new XuatTuyenModel;
        $data->name = $request->name;
        $data->position = $request->position;
        $data->description = $request->description;
        $data->created_at = now();
        $data->save();
        return back()->withStatus(__('Tạo xuất tuyến thành công.'));
    }

    public function update(Request $request) {
        try {
            $update = XuatTuyenModel::where('id', '=', $request->id)
            ->update([
                'name'        => $request->name,
                'position'    => $request->position,
                'description' => $request->description,
                'updated_at'  => now()
            ]);
        } catch (ModelNotFoundException $exception) {
            return back()->withError($exception->getMessage())->withInput();
        }
        return response()->json($update, 200);
    }

    public function delete(Request $request) {
        $data = XuatTuyenModel::find($request->id);
        if($data){
            $data->delete();
        }else {
            $rs = Collection::make([
                'error'=> 'Xuất tuyến này đã được xoá!'
            ]);
            return response()->json($rs, 200);
        }

    }
}

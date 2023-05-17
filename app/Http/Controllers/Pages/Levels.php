<?php

namespace App\Http\Controllers\Pages;

use App\Models\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

const ADMIN_PERMISSION = 1;
const PER_PAGE         = 5;

class Levels extends Controller
{
    public function index()
    {
        $data['users'] = User::where('permission_id', '!=', ADMIN_PERMISSION)
                            ->orderBy('updated_at','desc')
                            ->orderBy('name','asc')
                            ->paginate(PER_PAGE);
        return view("pages.levels", $data);
    }

    public function search(Request $request) {
        $data['key_word'] = $key_word = $request->input('key_word');
        $data['users'] = User::where('permission_id', '!=', ADMIN_PERMISSION)
                            ->where(function($query) use ($key_word){
                                $query->where('msnv', 'like', "%$key_word%")
                                      ->orWhere('name', 'like', "%$key_word%")
                                      ->orWhere('chuc_danh', 'like', "%$key_word%");
                            })
                            ->orderBy('name','desc')
                            ->paginate(PER_PAGE)
                            ->appends(['key_word' => $key_word]);
        return view("pages.levels", $data);
    }
    public function update(Request $request) {
        $input = $request->all();
        User::where('id', '=', $input['id'])
            ->update($input);
        return response()->json($input, 200);
    }
}

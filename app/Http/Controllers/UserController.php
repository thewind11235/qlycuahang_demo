<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use DB;
use \stdClass;

const PER_PAGE         = 5;

class UserController extends Controller
{
    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $roles = auth()->user()->permission()->first()->slug;
        if ( $roles == 'admin' )
        {
            $users = DB::table('users')
                        ->leftJoin('permissions', 'users.permission_id', '=', 'permissions.id')
                        ->select(
                            'users.msnv as msnv',
                            'users.name as name',
                            'users.email as email',
                            'permissions.permission_name as role'
                        )
                        ->paginate(PER_PAGE);
            // dd($users->toArray());
            return view('users.index', [
                'users' => $users
            ]);
        }
        abort(401);
    }

    public function search(Request $request) {
        $data['key_word'] = $key_word = $request->input('key_word');
        $data['users'] = User::where(function($query) use ($key_word){
                                $query->where('msnv', 'like', "%$key_word%")
                                      ->orWhere('name', 'like', "%$key_word%")
                                      ->orWhere('email', 'like', "%$key_word%");
                            })
                            ->orderBy('name','desc')
                            ->paginate(PER_PAGE)
                            ->appends(['key_word' => $key_word]);
        return view("users.index", $data);
    }

    public function edit ( Request $request )
    {
        $roles = auth()->user()->permission()->first()->slug;
        if ( $roles != 'admin' )
        {
            abort(401);
        }
        $users = new stdClass();
        $users->msnv    = auth()->user()->msnv;
        $users->name    = auth()->user()->name;
        $users->email   = auth()->user()->email;
        $users->role_id = auth()->user()->permission_id;
        $users->role    = auth()->user()->permission()->first()->permission_name;

        if ( isset($request->msnv) )
        {
            // check msnv exist in data
            $isNotExist   = User::select("*")
                        ->where("msnv", $request->msnv)
                        ->doesntExist();
            if( $isNotExist )
            {
                return view('users.edit', [
                    'users' => $users
                ]);
            }
            $query = DB::table('users')
                        ->leftJoin('permissions', 'users.permission_id', '=', 'permissions.id')
                        ->where('users.msnv', '=', $request->msnv)
                        ->select(
                            'users.msnv as msnv',
                            'users.name as name',
                            'users.email as email',
                            'users.permission_id as role_id',
                            'permissions.permission_name as role'
                        );
            $users = $query->get()->toArray()[0];
        }
        // get permission table
        $permissions = DB::table('permissions')->get();
        // dd($users);
        return view('users.edit', [
            'users'      => $users,
            'permissions' => $permissions
        ]);
    }

    public function create_user ( Request $request )
    {
        $roles = auth()->user()->permission()->first()->slug;
        if ( $roles == 'admin' )
        {
            $permissions = DB::table('permissions')->get();
            return view('users.create',[
                'permissions' => $permissions
            ]);
        }
        abort(401);
    }

    public function create ( Request $request )
    {
        if ( $request->all() )
        {
            if ( $request->msnv == '' || $request->password == '' || $request->email == '')
            {
                return back()->with('error', 'Tài khoản không hợp lệ, sửa lại biểu mẫu.');
            }
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'email_verified_at' => now(),
                'password' => Hash::make($request->password),
                'created_at' => now(),
                'updated_at' => now(),
                'msnv' => $request->msnv,
                'permission_id' => $request->role,
                'status' => 1
            ];

            DB::table('users')->insert($data);
            return back()->withStatus(__('Tạo user thành công.'));
        }
    }

    public function update ( Request $request )
    {
        if ( isset($request->msnv) )
        {
            $data = [
                'name'          => $request->name,
                'email'         => $request->email,
                'msnv'          => $request->msnv,
                'permission_id' => $request->role
            ];
            DB::table('users')
                ->where('msnv', $request->msnv )
                ->update($data);

            return back()->withStatus(__('Profile successfully updated.'));
        }
    }

    public function password ( Request $request )
    {
        if ( isset($request->msnv) )
        {
            if ( $request->password != $request->password_confirmation )
            {
                return back()->with('error', 'Password không trùng khớp');
            }
            $data = [
                'password'  => Hash::make($request->password)
            ];
            DB::table('users')
                ->where('msnv', $request->msnv )
                ->update($data);

            return back()->withPasswordStatus(__('Password successfully updated.'));
        }
    }
}

<?php

namespace App\Http\Controllers\Pages;

use DB;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Log;

class BillsController extends Controller
{
    public function index()
    {
        $roles = auth()->user()->permission()->first()->slug;

        $bills = DB::table('bills')
            ->leftJoin('users', 'users.id', '=', 'bills.staff_id')
            ->orderBy('bills.updated_at', 'desc')
            ->select(
                'bills.id',
                'bills.name_device',
                'bills.status_device',
                'bills.description',
                'bills.price',
                'bills.estimate_time',
                'bills.status_bill',
                'users.name',
            )
            ->get();
        // dd($bills);
        return view(
            'pages.bill.bill', [
            'bills' => $bills,
            'roles'    => $roles
            ],
        );
    }

    public function create_index()
    {
        $user = auth()->user();

        return view('pages.bill.bill_create_index', ['user' => $user]);
    }

    public function create()
    {

        // if ( $request->all() )
        // {
        //     if ( $request->msnv == '' || $request->password == '' || $request->email == '')
        //     {
        //         return back()->with('error', 'Tài khoản không hợp lệ, sửa lại biểu mẫu.');
        //     }
        //     $data = [
        //         'name' => $request->name,
        //         'email' => $request->email,
        //         'email_verified_at' => now(),
        //         'password' => Hash::make($request->password),
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //         'msnv' => $request->msnv,
        //         'permission_id' => $request->role,
        //         'status' => 1
        //     ];

        //     DB::table('users')->insert($data);
        //     return back()->withStatus(__('Tạo user thành công.'));
        // }
    }

    public function history()
    {
        return view('pages.bill.bill_history');
    }
}

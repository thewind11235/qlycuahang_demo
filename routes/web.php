<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Pages\Levels;
use App\Http\Controllers\Pages\XuatTuyen;
use App\Http\Controllers\Pages\Maps;
use App\Http\Controllers\Pages\HanhLangController;
use App\Http\Controllers\Pages\KhiemKhuyetController;
use App\Http\Controllers\Pages\BillsController;
use App\Http\Controllers\Pages\TramBienAp;
use App\Http\Controllers\Pages\DownloadApp;
use App\Http\Controllers\AjaxController;

Route::get(
    '/', function () {
        return view('auth/login');
    }
);
Auth::routes(
    [
    'register' => false,
    ]
);

// ajax
Route::controller(AjaxController::class)->group(
    function () {
        Route::post('ajaxRq/update', 'ajaxRq'); // update hanh lang/kk items
        Route::post('ajaxRq/delete', 'delete_task'); // delete hanh lang/kk items
        Route::post('ajaxRq/find', 'find'); // find name employee
        Route::get('ajaxRq/download_excel', 'download_excel'); // download excel file
        Route::get('ajaxRq/download_excel_admin', 'download_excel_admin'); // download excel file
        Route::get('ajaxRq/download_excel_kk_admin', 'download_excel_kk_admin'); // download excel file
    }
);


// end ajax

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

Route::group(
    ['middleware' => ['auth']], function () {
        Route::controller(HomeController::class)->group(
            function () {
                Route::get('/', ['as' => 'page.index', 'uses' => 'index']);
            }
        );
        // Admin
        // Profile
        Route::controller(ProfileController::class)->group(
            function () {
                Route::get('profile', ['as' => 'profile.edit'    , 'uses' => 'edit'    ]);
                Route::put('profile', ['as' => 'profile.update'  , 'uses' => 'update'  ]);
                Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'password']);
            }
        );
        // Users manage
        Route::controller(UserController::class)->group(
            function () {
                Route::get('user', ['as' => 'user.index'        , 'uses' => 'index'       ]);
                Route::get('users/search', ['as' => 'users.search'       , 'uses' => 'search'      ]);
                Route::get('users_edit', ['as' => 'users.edit'        , 'uses' => 'edit'        ]);
                Route::put('users_edit', ['as' => 'users.update'      , 'uses' => 'update'      ]);
                Route::put('users_edit/password', ['as' => 'users.password'    , 'uses' => 'password'    ]);
                Route::get('users_edit/create', ['as' => 'users.create_user' , 'uses' => 'create_user' ]);
                Route::put('users_edit/create', ['as' => 'users.create'      , 'uses' => 'create'      ]);
            }
        );
        // Pages
        // Maps
        Route::controller(Maps::class)->group(
            function () {
                Route::get('maps', ['as' => 'maps.index', 'uses' => 'index']);
            }
        );
        // Levels
        Route::controller(Levels::class)->group(
            function () {
                Route::get('levels', ['as' => 'levels.index', 'uses' => 'index']);
                Route::get('levels/search', ['as' => 'levels.search' , 'uses' => 'search' ]);
                Route::post('levels', ['as' => 'levels.update' , 'uses' => 'update' ]);
            }
        );
        // XuatTuyen
        Route::controller(XuatTuyen::class)->group(
            function () {
                Route::get('xuat_tuyen', ['as' => 'xuat_tuyen.index', 'uses' => 'index']);
                Route::get('xuat_tuyen/search', ['as' => 'xuat_tuyen.search' , 'uses' => 'search' ]);
                Route::post('xuat_tuyen/update', ['as' => 'xuat_tuyen.update' , 'uses' => 'update' ]);
                Route::get('xuat_tuyen/create_index', ['as' => 'xuat_tuyen.create_index' , 'uses' => 'create_index' ]);
                Route::put('xuat_tuyen/create', ['as' => 'xuat_tuyen.create' , 'uses' => 'create' ]);
                Route::post('xuat_tuyen/delete', ['as' => 'xuat_tuyen.delete' , 'uses' => 'delete' ]);
            }
        );
        // hanh lang
        Route::controller(HanhLangController::class)->group(
            function () {
                Route::get('hanh_lang', ['as' => 'hanhlang.index' , 'uses' => 'index' ]);
                Route::get('hanh_lang/detail', ['as' => 'hanhlang.detail', 'uses' => 'detail']);
            }
        );

        // khiem khuyet
        Route::controller(KhiemKhuyetController::class)->group(
            function () {
                Route::get('khiem_khuyet', ['as' => 'khiemkhuyet.index' , 'uses' => 'index' ]);
                Route::get('khiem_khuyet/detail', ['as' => 'khiemkhuyet.detail', 'uses' => 'detail']);
            }
        );
        // tram bien ap
        Route::controller(TramBienAp::class)->group(
            function () {
                Route::get('tram_bien_ap', ['as' => 'trambienap.index', 'uses' => 'index']);
            }
        );
        Route::controller(BillsController::class)->group(
            function () {
                Route::get('bills', ['as' => 'bill.index' , 'uses' => 'index' ]);
                Route::get('bills/create_index', ['as' => 'bill.create.index' , 'uses' => 'create_index' ]);
                Route::get('bills/create', ['as' => 'bill.create' , 'uses' => 'create' ]);
                Route::get('bills/history', ['as' => 'bill.history' , 'uses' => 'history' ]);
                Route::get('bills_edit', ['as' => 'bill.edit' , 'uses' => 'edit' ]);
            }
        );
        // Route::get('{page}', ['as' => 'page.index', 'uses' => 'App\Http\Controllers\PageController@index']);
        Route::controller(DownloadApp::class)->group(
            function () {
                Route::get('download_app', ['as' => 'download_app.index', 'uses' => 'index']);
            }
        );
    }
);

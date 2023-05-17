<?php

namespace App\Http\Controllers;

use App\Models\HanhLangModel;
use App\Models\KhiemKhuyetModel;

use DB;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Log;
use PhpOffice\PhpSpreadsheet\IOFactory;

class AjaxController extends Controller
{
    public function download_excel_admin(Request $request) {
        $roles = auth()->user()->permission()->first()->slug;
        if ($roles == 'admin') {
            $mytime = Carbon::now();
            $today = $mytime->format('d-m-Y');
            $excel_name = 'tong_hop_hanh_lang_'.auth()->user()->msnv.'_'.$today.'.xlsx';
            $inputFileName = 'excel/sample/th_hanh_lang_sample.xlsx';
            $outputFileName = 'excel/output/'.$excel_name;
            $result = [
                'status' => false,
                'error'  => 'File not found!'
            ];
            if(!file_exists(public_path('excel/output'))){
                mkdir(public_path('excel/output'));
            }
            // Query data
            $th_hanhlang = DB::table('hanh_lang')
                    ->leftJoin('users', 'users.id', '=', 'hanh_lang.id_nvw')
                    ->leftJoin('users as users2', 'users2.id', '=', 'hanh_lang.id_nv')
                    ->leftJoin('status_nv', 'status_nv.id', '=', 'hanh_lang.id_status_nv')
                    ->leftJoin('note_nv', 'note_nv.id', '=', 'hanh_lang.id_note_nv')
                    ->leftJoin('status_ql', 'status_ql.id', '=', 'hanh_lang.id_status_ql')
                    ->leftJoin('note_ql', 'note_ql.id', '=', 'hanh_lang.id_note_ql')
                    // ->whereNotNull('hanh_lang.id_nvw')
                    ->orderBy('users.name', 'asc')
                    ->orderBy('hanh_lang.update_time_nv', 'desc')
                    ->select(
                        'users.name as worker',
                        'hanh_lang.id as id',
                        'hanh_lang.id_nv as id_nv',
                        'users2.name as creator',
                        'hanh_lang.id_nvw as id_nvw',
                        'hanh_lang.id_status_nv',
                        'hanh_lang.xuat_tuyen',
                        'hanh_lang.tu_tru_den_tru',
                        'hanh_lang.muc_do',
                        'hanh_lang.pa_phat_quang',
                        DB::raw("DATE_FORMAT(hanh_lang.create_time,'%d-%m-%Y %H:%i:%s') as create_time"),
                        DB::raw("DATE_FORMAT(hanh_lang.update_time_nv,'%d-%m-%Y %H:%i:%s') as update_time_nv"),
                        DB::raw("DATE_FORMAT(hanh_lang.update_time_ql,'%d-%m-%Y %H:%i:%s') as update_time_ql"),
                        DB::raw("(select 'hanh_lang') as type"),
                        DB::raw("CONCAT(' Có ', hanh_lang.so_cay, ' cây, ',note_nv.content_note_nv, ' cách lưới ', hanh_lang.khoang_cach) as content_excel")
                    );
            $th_hanhlang = $th_hanhlang->get();
            $grouped = $th_hanhlang->groupBy('creator')->map(function($items, $name) {
                return [
                    'creator' => $name,
                    'count' => count($items),
                    'data' => $items
                ];
            });
            // Import the Excel file
            $file = public_path($inputFileName);
            $spreadsheet = IOFactory::load($file);
            // dd($spreadsheet);
            // Get the first sheet
            $sheet = $spreadsheet->getSheet(0);
            // dd($sheet);
            // Insert values into the sheet
            $count = $_count = 11;
            foreach($grouped as $items){
                // $spreadsheet->getActiveSheet()->mergeCells($count.':'.$items['count']);
                $sheet->setCellValue('A'.$count, $items['creator']);
                foreach($items['data'] as $item) {
                    // $sheet->setCellValue('A'.$_count, $items['name']);
                    // $sheet->setCellValue('P'.$_count, $item->ng_tao);
                    $sheet->setCellValue('B'.$_count, $item->create_time);
                    $sheet->setCellValue('C'.$_count, $item->xuat_tuyen);
                    $sheet->setCellValue('D'.$_count, $item->tu_tru_den_tru);
                    $sheet->setCellValue('E'.$_count, $item->content_excel);
                    if ($item->muc_do == 'Bình thường') {
                        $sheet->setCellValue('F'.$_count, 'x');
                    } else if($item->muc_do == 'Nguy hiểm') {
                        $sheet->setCellValue('G'.$_count, 'x');
                    }else if($item->muc_do == 'Đặc biệt nguy hiểm') {
                        $sheet->setCellValue('H'.$_count, 'x');
                    }
                    $sheet->setCellValue('I'.$_count, $item->pa_phat_quang);
                    $sheet->setCellValue('L'.$_count, $item->update_time_nv);
                    if ($item->id_status_nv == '1' || $item->id_status_nv == '2') {
                        $sheet->setCellValue('N'.$_count, 'x');
                    } else if ($item->id_status_nv == '3'){
                        $sheet->setCellValue('M'.$_count, 'x');
                    }
                    $_count++;
                }
                $count += $items['count'];
            }
            // Save the file with a new name
            $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
            $writer->save(public_path($outputFileName));
            // Download
            $download = public_path($outputFileName);
            if(!file_exists($download)){
                return response()->json($result);
            }
            return response()->download($download, $excel_name,
                [
                    'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                    'Content-Disposition' => 'attachment; filename='.$excel_name
                ]
            );
        }
    }
    public function download_excel_kk_admin(Request $request) {
        $roles = auth()->user()->permission()->first()->slug;
        if ($roles == 'admin') {
            $mytime = Carbon::now();
            $today = $mytime->format('d-m-Y');
            $excel_name = 'tong_hop_khiem_khuyet_'.auth()->user()->msnv.'_'.$today.'.xlsx';
            $inputFileName = 'excel/sample/th_khiem_khuyet_sample.xlsx';
            $outputFileName = 'excel/output/'.$excel_name;
            $result = [
                'status' => false,
                'error'  => 'File not found!'
            ];
            if(!file_exists(public_path('excel/output'))){
                mkdir(public_path('excel/output'));
            }
            // Query data
            $th_hanhlang = DB::table('khiem_khuyet')
                    ->leftJoin('users', 'users.id', '=', 'khiem_khuyet.id_nvw')
                    ->leftJoin('users as users2', 'users2.id', '=', 'khiem_khuyet.id_nv')
                    ->leftJoin('status_nv', 'status_nv.id', '=', 'khiem_khuyet.id_status_nv')
                    ->leftJoin('note_nv', 'note_nv.id', '=', 'khiem_khuyet.id_note_nv')
                    ->leftJoin('status_ql', 'status_ql.id', '=', 'khiem_khuyet.id_status_ql')
                    ->leftJoin('note_ql', 'note_ql.id', '=', 'khiem_khuyet.id_note_ql')
                    // ->whereNotNull('khiem_khuyet.id_nvw')
                    ->orderBy('users.name', 'asc')
                    ->orderBy('khiem_khuyet.update_time_nv', 'desc')
                    ->select(
                        'users.name as worker',
                        'khiem_khuyet.id as id',
                        'khiem_khuyet.id_nv as id_nv',
                        'users2.name as creator',
                        'khiem_khuyet.id_nvw as id_nvw',
                        'khiem_khuyet.id_status_nv',
                        'khiem_khuyet.xuat_tuyen',
                        'khiem_khuyet.tu_tru_den_tru',
                        'khiem_khuyet.muc_do',
                        'khiem_khuyet.bien_phap_at',
                        'khiem_khuyet.vat_tu',
                        'khiem_khuyet.noi_dung_khiem_khuyet as content_excel',
                        DB::raw("DATE_FORMAT(khiem_khuyet.create_time,'%d-%m-%Y %H:%i:%s') as create_time"),
                        DB::raw("DATE_FORMAT(khiem_khuyet.update_time_nv,'%d-%m-%Y %H:%i:%s') as update_time_nv"),
                        DB::raw("DATE_FORMAT(khiem_khuyet.update_time_ql,'%d-%m-%Y %H:%i:%s') as update_time_ql"),
                        DB::raw("(select 'khiem_khuyet') as type"),
                    );
            $th_hanhlang = $th_hanhlang->get();
            $grouped = $th_hanhlang->groupBy('creator')->map(function($items, $name) {
                return [
                    'creator' => $name,
                    'count' => count($items),
                    'data' => $items
                ];
            });
            // Import the Excel file
            $file = public_path($inputFileName);
            $spreadsheet = IOFactory::load($file);
            // dd($spreadsheet);
            // Get the first sheet
            $sheet = $spreadsheet->getSheet(0);
            // dd($sheet);
            // Insert values into the sheet
            $count = $_count = 11;
            foreach($grouped as $items){
                // $spreadsheet->getActiveSheet()->mergeCells($count.':'.$items['count']);
                $sheet->setCellValue('A'.$count, $items['creator']);
                foreach($items['data'] as $item) {
                    // $sheet->setCellValue('A'.$_count, $items['name']);
                    // $sheet->setCellValue('P'.$_count, $item->ng_tao);
                    $sheet->setCellValue('B'.$_count, $item->create_time);
                    $sheet->setCellValue('C'.$_count, $item->xuat_tuyen);
                    $sheet->setCellValue('D'.$_count, $item->tu_tru_den_tru);
                    $sheet->setCellValue('E'.$_count, $item->content_excel);
                    if ($item->muc_do == 'Bình thường') {
                        $sheet->setCellValue('F'.$_count, 'x');
                    } else if($item->muc_do == 'Nguy hiểm') {
                        $sheet->setCellValue('G'.$_count, 'x');
                    }else if($item->muc_do == 'Đặc biệt nguy hiểm') {
                        $sheet->setCellValue('H'.$_count, 'x');
                    }
                    $sheet->setCellValue('I'.$_count, $item->bien_phap_at);
                    $sheet->setCellValue('J'.$_count, $item->vat_tu);
                    $sheet->setCellValue('L'.$_count, $item->update_time_nv);
                    if ($item->id_status_nv == '1' || $item->id_status_nv == '2') {
                        $sheet->setCellValue('N'.$_count, 'x');
                    } else if ($item->id_status_nv == '3'){
                        $sheet->setCellValue('M'.$_count, 'x');
                    }
                    $_count++;
                }
                $count += $items['count'];
            }
            // Save the file with a new name
            $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
            $writer->save(public_path($outputFileName));
            // Download
            $download = public_path($outputFileName);
            if(!file_exists($download)){
                return response()->json($result);
            }
            return response()->download($download, $excel_name,
                [
                    'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                    'Content-Disposition' => 'attachment; filename='.$excel_name
                ]
            );
        }
    }
    public function download_excel()
    {
        $mytime = Carbon::now();
        $today = $mytime->format('d-m-Y');
        $excel_name = 'hanh_lang_'.auth()->user()->msnv.'_'.$today.'.xlsx';
        $inputFileName = 'excel/sample/hanh_lang_sample.xls';
        $outputFileName = 'excel/output/'.$excel_name;
        $result = [
            'status' => false,
            'error'  => 'File not found!'
        ];
        if(!file_exists(public_path('excel/output'))){
            mkdir(public_path('excel/output'));
        }

        // Query data
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
                        DB::raw("CONCAT(users.msnv, '-', users.name) as msnv"),
                        DB::raw("DATE_FORMAT(hanh_lang.update_time_nv,'%d-%m-%Y %H:%i:%s') as update_time_nv"),
                        DB::raw("DATE_FORMAT(hanh_lang.update_time_ql,'%d-%m-%Y %H:%i:%s') as update_time_ql"),
                        DB::raw("(select 'hanh_lang') as type"),
                        DB::raw("CONCAT(CONCAT('Từ trụ ', REPLACE(hanh_lang.tu_tru_den_tru, '→', ' đến trụ ')), ' có ', IFNULL(CONCAT(', ', hanh_lang.so_cay), ' '), ' cây', IFNULL(CONCAT(', gồm cây: ', note_nv.content_note_nv, ', '), ''), ' cách lưới ', hanh_lang.khoang_cach) as content_excel")

                    );
        // if auth is user, can not see all tasks
        if ( $roles != 'admin' ){
            $hanhlang = $hanhlang->where('hanh_lang.id_nv', '=', auth()->user()->id)
                                 ->orWhere('hanh_lang.id_nvw', '=', auth()->user()->id)
                                 ->where('hanh_lang.id_status_nv', '!=', '3');
        }
        $hanhlang = $hanhlang->get();

        // Import the Excel file
        $file = public_path($inputFileName);
        $spreadsheet = IOFactory::load($file);
        // dd($spreadsheet);
        // Get the first sheet
        $sheet = $spreadsheet->getSheet(0);
        // dd($sheet);
        // Insert values into the sheet
        $sheet->setTitle('Sheet 1');
        $sheet->setCellValue('B10', 'Ngày kiểm tra: '.$today);
        $sheet->setCellValue('C14', auth()->user()->name);
        $sheet->setCellValue('K14', auth()->user()->chuc_danh);
        $sheet->setCellValue('O14', auth()->user()->bac_tho);
        $sheet->setCellValue('R14', auth()->user()->bac_an_toan);
        $count = 18;
        foreach($hanhlang as $value){
            $sheet->setCellValue('B'.$count, $value->content_excel);
            $count++;
        }
        // Save the file with a new name
        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save(public_path($outputFileName));
        // Download
        $download = public_path($outputFileName);
        if(!file_exists($download)){
            return response()->json($result);
        }
        return response()->download($download, $excel_name,
            [
                'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
                'Content-Disposition' => 'attachment; filename='.$excel_name
            ]
        );
    }
    public function delete_task(Request $request) {
        if ($request->type == 'hanh_lang') {
            $hanhLang = HanhLangModel::find($request->id);
            if ($hanhLang) {
                $hanhLang->delete();
                die();
            }
        }
        if ($request->type == 'khiem_khuyet') {
            $khiemkhuyet = KhiemKhuyetModel::find($request->id);
            if ($khiemkhuyet) {
                $khiemkhuyet->delete();
                die();
            }
        }
        return response()->json(['error' => 'ID không tồn tại']);
    }

    public function ajaxRq(Request $request)
    {
        if(Auth::check())
        {
            $input = $request->all();
            $id_row = $input['id'];
            $type = $input['type'];
            $table = [
                'hanh_lang'    => 'hanh_lang',
                'khiem_khuyet'    => 'khiem_khuyet'
            ];
            Log::info($input);
            $roles = auth()->user()->permission()->first()->slug;
            $data = [];
            if( $roles == 'user' )
            {
                $data = [
                    'status'    => [
                        'id_status_nv' => $input['status_nv']
                    ],
                    'note'      => [
                        'note_nv'   => $input['note_nv']
                    ],
                    'update'    => [
                        'update_time_nv' => now()
                    ]
                ];
            }elseif( strpos($roles, '_mod') )
            {
                $data = [
                    'msnv_nvw'    => [
                        'msnv_nvw'    => $input['msnv_nvw']
                    ],
                    'status'    => [
                        'id_status_ql' => $input['status_ql'],
                    ],
                    'note'      => [
                        'note_ql'   => $input['note_ql']
                    ],
                    'update'    => [
                        'update_time_ql' => now()
                    ]
                ];
            }elseif( $roles == 'admin' )
            {
                $data = [
                    'msnv_nvw'    => [
                        'msnv_nvw'    => $input['msnv_nvw']
                    ],
                    'status'    => [
                        'id_status_ql' => $input['status_ql'],
                        'id_status_nv' => $input['status_nv']
                    ],
                    'note'      => [
                        'note_ql'   => $input['note_ql'],
                        'note_nv'   => $input['note_nv']
                    ],
                    'update'    => [
                        'update_time_ql' => now()
                    ]
                ];
            }
            $rs = ['error' => 'Empty data!'];
            if( !empty($data) )
            {
                // update nvw
                if ( isset($data['msnv_nvw']) )
                {
                    //get nvw id
                    $query = DB::table('users')
                            ->where('users.msnv', '=', $data['msnv_nvw']['msnv_nvw'])
                            ->select('id')
                            ->get();
                    // update
                    if ( sizeof($query) != 0 )
                    {
                        $id_nvw = $query[0]->id;
                        DB::table($table[$type])
                            ->where($table[$type].'.id', '=', $id_row)
                            ->update(['id_nvw' => $id_nvw]);
                    }else{
                        return ['error' => 'Bạn phải chọn nhân viên xử lí!~'];
                    }
                }
                // get id note
                // error: id note can not exist
                $query = DB::table($table[$type])
                            ->where($table[$type].'.id', '=', $id_row)
                            ->select('*')
                            ->get();
                $id_note_nv = $query[0]->id_note_nv;
                $id_note_ql = $query[0]->id_note_ql;
                // update nvw
                if ( isset($data['id_nvw']) )
                {
                    DB::table($table[$type])
                            ->where($table[$type].'.id', '=', $id_row)
                            ->update($data['id_nvw']);
                }
                // update status + update time
                DB::table($table[$type])
                        ->where($table[$type].'.id', '=', $id_row)
                        ->update(array_merge($data['status'], $data['update']));

                // update note
                if ( isset($data['note']['note_nv']) ) {
                    DB::table('note_nv')
                            ->where('id', $id_note_nv)
                            ->update([
                                'content_note_nv'=> $data['note']['note_nv'],
                                'type'           => $type
                            ]);
                }

                if ( isset($data['note']['note_ql']) )
                {
                    DB::table('note_ql')
                            ->where('id', $id_note_ql)
                            ->update([
                                'content_note_ql'=> $data['note']['note_ql'],
                                'type'           => $type
                            ]);
                }
                return response()->json($input);
            }else {
                return response()->json($rs);
            }
        }
    }

    public function find(Request $request)
    {
        if(Auth::check())
        {
            if ( isset($_POST['keyword']) )
            {
                $roles = auth()->user()->permission()->first()->slug;
                $input = $request->all();
                // $keyword = $input['keyword'];
                $keyword = $_POST['keyword'];
                // find follow keyword
                $rs = DB::table('users')
                            ->leftJoin('permissions', 'users.permission_id', '=', 'permissions.id')
                            ->where('permissions.slug', '!=', 'admin')
                            ->where('users.msnv', 'like', "$keyword%")
                            ->orWhere('users.name', 'like', "$keyword%")
                            ->orWhere('users.name', 'like', "%$keyword%")
                            ->orWhere('users.name', 'like', "%$keyword");
                            if( $roles == 'tech_mod')
                            {
                                $rs = $rs->where('permissions.slug', '!=', 'onduty_mod');
                            }else if ( $roles == 'onduty_mod')
                            {
                                $rs = $rs->where('permissions.slug', '!=', 'tech_mod');
                            }
                $rs = $rs->orderBy('users.msnv', 'asc')
                    ->select(
                        'users.msnv as id',
                        DB::raw("CONCAT(users.msnv, '_', users.name) as text"),
                    )
                    ->skip(0)->take(5)->get();
                $result = array_map(function ($value) {
                    return (array)$value;
                }, $rs->toArray());
                return response()->json($result);
            }
            // test if few data
            else{
                $rs = DB::table('users')
                            ->leftJoin('permissions', 'users.permission_id', '=', 'permissions.id')
                            ->where('permissions.slug', '!=', 'admin')
                            ->orderBy('users.msnv', 'asc')
                            ->select(
                                'users.msnv as id',
                                DB::raw("CONCAT(users.msnv, '_', users.name) as text"),
                            )
                            ->skip(0)->take(5)->get();
                $result = array_map(function ($value) {
                    return (array)$value;
                }, $rs->toArray());

                return response()->json($result);
            }
        }
    }
}

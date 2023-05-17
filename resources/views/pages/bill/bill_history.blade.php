@extends('layouts.app', [
    'namePage' => 'Lịch sử hoá đơn',
    'activePage' => 'bills.history',
])

@section('content')
    <div class="panel-header panel-header-sm"></div>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Lịch sử hoá đơn</h4>
                        <div class="col-12 mt-2"></div>
                    </div>
                    <div class="card-body">
                        <div class="toolbar">
                            <form class="col-md-3" method="get" autocomplete="off">
                                <div class="input-group no-border">
                                    <input type="text" name="key_word"
                                        value="@isset($key_word){{ old('key_word', $key_word) }}@endisset"
                                        class="form-control" placeholder="Tìm kiếm ...">
                                    <div class="input-group-append">
                                        <div class="input-group-text">
                                            <i class="now-ui-icons ui-1_zoom-bold"></i>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Nhân viên tiếp nhận</th>
                                    <th>Tên thiết bị</th>
                                    <th>Ngày hẹn trả</th>
                                    <th>Trạng thái hoá đơn</th>
                                    <th class="disabled-sorting text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Nhân viên</td>
                                    <td>Laptop Gaming 01</td>
                                    <td>12/05/2023</td>
                                    <td>Đã hoàn thành</td>
                                    <td class="text-right">
                                        <a type="button" rel="tooltip" class="btn btn-warning btn-icon btn-sm "
                                            data-original-title="" title="Chi tiết hoá đơn">
                                            <i class="now-ui-icons ui-2_settings-90"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>Nhân viên 01</td>
                                    <td>Laptop Gaming 02</td>
                                    <td>25/05/2023</td>
                                    <td>Huỷ bỏ</td>
                                    <td class="text-right">
                                        <a type="button" rel="tooltip" class="btn btn-warning btn-icon btn-sm "
                                            data-original-title="" title="Chi tiết hoá đơn">
                                            <i class="now-ui-icons ui-2_settings-90"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>Nhân viên</td>
                                    <td>Laptop Gaming 03</td>
                                    <td>27/05/2023</td>
                                    <td>Đang xử lý</td>
                                    <td class="text-right">
                                        <a type="button" rel="tooltip" class="btn btn-warning btn-icon btn-sm "
                                            data-original-title="" title="Chi tiết hoá đơn">
                                            <i class="now-ui-icons ui-2_settings-90"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>1</td>
                                    <td>Nhân viên 04</td>
                                    <td>Laptop Gaming 01</td>
                                    <td>25/05/2023</td>
                                    <td>Đang xử lý</td>
                                    <td class="text-right">
                                        <a type="button" rel="tooltip" class="btn btn-warning btn-icon btn-sm "
                                            data-original-title="" title="Chi tiết hoá đơn">
                                            <i class="now-ui-icons ui-2_settings-90"></i>
                                        </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <!-- end content-->
                </div>
                <!--  end card  -->
            </div>
        </div>
    </div>
@endsection

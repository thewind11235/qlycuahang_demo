@extends('layouts.app', [
    'namePage' => 'Hoá đơn',
    'activePage' => 'bills.create.index',
])

@section('content')
    <div class="panel-header panel-header-sm"></div>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">

                        <h4 class="card-title">Tạo hoá đơn mới</h4>
                        <div class="col-12 mt-2"></div>
                    </div>
                    <div class="card-body">
                        <div class="toolbar">
                            <!--        Here you can write extra buttons/actions for the toolbar              -->
                        </div>
                        {{-- content  --}}
                        {{-- <form method="post" action="{{ route('bill.create') }}" autocomplete="off" --}}
                        <div autocomplete="off" enctype="multipart/form-data">
                            @csrf
                            @method('put')
                            @include('alerts.success')
                            <div class="row"></div>
                            <div class="row">
                                <div class="col-md-10 pr-1">
                                    <div class="form-group">
                                        <label>{{ __(' Tên thiết bị') }}</label>
                                        <input type="text" name="name_device" class="form-control" value="">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10 pr-1">
                                    <div class="form-group">
                                        <label>{{ __('Tình trạng thiết bị') }}</label>
                                        <textarea name="status_device" class="form-control" value=""></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-10 pr-1">
                                    <div class="form-group">
                                        <label>{{ __('Giải pháp đề xuất') }}</label>
                                        <textarea name="description" class="form-control" value=""></textarea>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 pr-1">
                                    <div class="form-group">
                                        <label>{{ __('Thiết bị thay thế') }}</label>
                                        <select name="role" class="form-control">
                                            <option selected value="0">RAM DDR4 8GB Kingston</option>
                                            <option value="1">RAM DDR4 16GB Kingston</option>
                                            <option value="2">RAM DDR4 32GB Kingston</option>
                                            <option value="3">......</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 pr-1">
                                    <div class="form-group">
                                        <label>{{ __('Ngày hẹn lấy') }}</label>
                                        <input type="datetime-local" name="datetime" class="form-control"><br>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-4 pr-1">
                                    <div class="form-group">
                                        <label>{{ __('Người tạo đơn') }}</label>
                                        <p>{{ $user->name }}</p>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <button id="btn_create_bill" type="submit"
                                    class="btn btn-primary btn-round">{{ __('Tạo hoá đơn') }}</button>
                            </div>
                            <hr class="half-rule" />
                        </div>
                    </div>
                    <!-- end content-->
                </div>
                <!--  end card  -->
            </div>
        </div>
    </div>
@endsection

@extends('layouts.app', [
    'namePage' => 'Hành lang',
    'class' => 'sidebar-mini',
    'activePage' => 'hanh_lang_detail',
])

@section('content')
    <div class="panel-header panel-header-sm">
    </div>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Chi tiết task #{{ $task->id }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="col-md-6 left-card">
                            <h6># Nguời tạo task</h6>
                            <div class="row">
                                <div class="col-md-6 pr-1">
                                    <div class="form-group">
                                        <span>{{ __('Mã số nhân viên: ') }}</span>
                                        <span>{{ $task->msnv }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 pr-1">
                                    <div class="form-group">
                                        <span>{{ __('Tên nhân viên: ') }}</span>
                                        <span>{{ $task->name }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 pr-1">
                                    <div class="form-group">
                                        <span>{{ __('Thời gian tạo: ') }}</span>
                                        <span>{{ $task->create_time }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 pr-1">
                                    <div class="form-group">
                                        <span>{{ __('Hình ảnh ban đầu: ') }}</span>
                                        <div>
                                            <img src="@isset($task->images){{ url($task->images) }}@endisset" alt="task_creator" width="350px" height="200px">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 right-card">
                            <h6># Nguời xử lí</h6>
                            <div class="row">
                                <div class="col-md-6 pr-1">
                                    <div class="form-group">
                                        <span>{{ __('Mã số nhân viên: ') }}</span>
                                        <span>{{ $task->msnv_nvw }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 pr-1">
                                    <div class="form-group">
                                        <span>{{ __('Tên nhân viên: ') }}</span>
                                        <span>{{ $task->name_nvw }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 pr-1">
                                    <div class="form-group">
                                        <span>{{ __('Cập nhật lần cuối: ') }}</span>
                                        <span>{{ $task->create_time }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 pr-1">
                                    <div class="form-group">
                                        <span>{{ __('Hình ảnh hoàn thành: ') }}</span>
                                        <div>
                                            <img src="{{ url($task->images_nvw) }}" alt="task_maintain" width="350px" height="200px">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 full-card">
                            <hr class="half-rule"/>
                            <h6># Thông tin</h6>
                            <div class="row">
                                <div class="col-md-6 pr-1">
                                    <div class="form-group">
                                        <span>{{ __('Xuất tuyến: ') }}</span>
                                        <span>{{ $task->xuat_tuyen }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 pr-1">
                                    <div class="form-group">
                                        <span>{{ __('Từ trụ đến trụ: ') }}</span>
                                        <span>{{ $task->tu_tru_den_tru }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 pr-1">
                                    <div class="form-group">
                                        <span>{{ __('Số cây: ') }}</span>
                                        <span>{{ $task->so_cay }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 pr-1">
                                    <div class="form-group">
                                        <span>{{ __('Khoảng cách: ') }}</span>
                                        <span>{{ $task->khoang_cach }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 pr-1">
                                    <div class="form-group">
                                        <span>{{ __('Phương án phát quang: ') }}</span>
                                        <span>{{ $task->pa_phat_quang }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 pr-1">
                                    <div class="form-group">
                                        <span>{{ __('Đề xuất: ') }}</span>
                                        <span>{{ $task->de_xuat }}</span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6 pr-1">
                                    <div class="form-group">
                                        <span>{{ __('Mức độ: ') }}</span>
                                        <span>{{ $task->muc_do }}</span>
                                    </div>
                                </div>
                            </div>
                            <hr class="half-rule"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


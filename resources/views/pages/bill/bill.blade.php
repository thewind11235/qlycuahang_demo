@extends('layouts.app', [
    'namePage' => 'Hoá đơn',
    // 'class' => 'sidebar-mini',
    'activePage' => 'bill',
])

@section('content')
    <div class="panel-header panel-header-sm"></div>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="col-md-10 left-card">
                            <h4 class="card-title">Danh sách hoá đơn</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            @if (!empty($bills) && $bills->count())
                                <table class="table table-hover">
                                    <thead class="text-primary">
                                        <th>
                                            ID
                                        </th>
                                        <th>
                                            Nhân viên
                                        </th>
                                        <th>
                                            Tên thiết bị
                                        </th>
                                        <th>
                                            Trạng thái thiết bị
                                        </th>
                                        <th>
                                            Mô tả
                                        </th>
                                        <th>
                                            Đơn giá
                                        </th>
                                        <th>
                                            Thời gian sửa chữa
                                        </th>
                                        <th>
                                            Trạng thái đơn
                                        </th>
                                        <th>
                                            Actions
                                        </th>
                                    </thead>
                                    <tbody>

                                        @foreach ($bills as $item)
                                            <tr data-id={{ $item->id }}>
                                                <td>#{{ $item->id }}</td>
                                                <td>
                                                    {{ $item->name }}
                                                </td>
                                                <td>
                                                    {{ $item->name_device }}
                                                </td>
                                                <td>
                                                    {{ $item->status_device }}
                                                </td>
                                                <td>
                                                    {{ $item->description }}
                                                </td>
                                                <td>
                                                    {{ $item->price }}
                                                </td>
                                                <td>
                                                    {{ $item->estimate_time }}
                                                </td>
                                                <td>
                                                    {{ $item->status_bill }}
                                                </td>
                                                <td>
                                                    <button class="btn btn-info detail_btn">Chi tiết</button>
                                                    <button class="btn btn-primary update_btn">Cập nhật</button>
                                                    @if ($roles != 'user')
                                                        <button class="btn btn-alert delete_btn">Xoá</button>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{-- <div class="row_">{{ $hanhlang->links() }}</div> --}}
                            @else
                                <table class="table table-hover">
                                    <tbody>
                                        <tr>
                                            <td colspan="6">Không có dữ liệu</td>
                                        </tr>
                                    </tbody>
                                </table>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

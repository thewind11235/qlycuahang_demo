@extends('layouts.app', [
    'namePage' => 'Khiếm khuyết',
    'activePage' => 'khiem_khuyet',
])

@section('content')
    <div class="panel-header panel-header-sm">
    </div>
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="col-md-10 left-card">
                            <h4 class="card-title">Danh sách yêu cầu khiếm khuyết</h4>
                        </div>
                        <div class="right-card">
                            @if ($roles == 'admin')
                            <div class="download-excel-kk-admin" data-type="khiem_khuyet">
                                <i class="fas fa-file-csv"></i>
                                <a>Download data synthesis</a>
                            </div>
                            @endif
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="table-responsive">
                            @if (!empty($khiemkhuyet) && $khiemkhuyet->count())
                                <table class="table table-hover">
                                    <thead class="text-primary">
                                        <th>
                                            ID
                                        </th>
                                        <th>
                                            Người tạo
                                        </th>
                                        <th>
                                            Người nhận
                                        </th>
                                        {{-- <th>
                        NV cập nhật
                    </th>
                    <th>
                        QL cập nhật
                    </th> --}}
                                        <th>
                                            Status issues
                                        </th>
                                        <th>
                                            Notification issues
                                        </th>
                                        <th>
                                            Ghi chú NV
                                        </th>
                                        <th>
                                            Ghi chú QL
                                        </th>
                                        <th>
                                            Actions
                                        </th>
                                    </thead>
                                    <tbody>
                                        @foreach ($khiemkhuyet as $item)
                                            <tr data-type={{ $item->type }} data-id={{ $item->id }}>
                                                <td>#{{ $item->id }}</td>
                                                <td>
                                                    {{ $item->msnv }}
                                                </td>
                                                <td>
                                                    @if ($roles != 'user')
                                                        <div class="search-nvw">
                                                            <select class="select2-data-live" style="width: 100%">
                                                                <option selected value="{{ $item->msnv_nvw }}">
                                                                    {{ $item->name_nvw }}</option>
                                                            </select>
                                                        </div>
                                                        {{-- <input id="msnv_nvw" class="creator" type="text" value="{{ $item->name_nvw }}"/> --}}
                                                    @else
                                                        {{-- <input id="msnv_nvw" class="creator noedit" type="text" value="{{ $item->name_nvw }}" readonly /> --}}
                                                        <div class="search-nvw">
                                                            <select class="select2-data-live" disabled="true"
                                                                style="width: 100%">
                                                                <option selected value="{{ $item->msnv_nvw }}">
                                                                    {{ $item->name_nvw }}</option>
                                                            </select>
                                                        </div>
                                                    @endif
                                                </td>
                                                {{-- <td>{{ $item->update_time_nv }}</td>
                                    <td>{{ $item->update_time_ql }}</td> --}}
                                                <td>
                                                    <div class="form-group">
                                                        <select class="form-control" name="status_nv" id="status_nv"
                                                            @if (strpos($roles, '_mod')) disabled="true" @endif>
                                                            @foreach ($status_nv as $status)
                                                                @if ($item->status_nv_id == $status->id)
                                                                    <option selected value="{{ $status->id }}">
                                                                        {{ $status->status }}</option>
                                                                @else
                                                                    <option value="{{ $status->id }}">
                                                                        {{ $status->status }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <select class="form-control" name="status_ql" id="status_ql"
                                                            @if ($roles == 'user') disabled="true" @endif>
                                                            @foreach ($status_ql as $status)
                                                                @if ($item->status_ql_id == $status->id)
                                                                    <option selected value="{{ $status->id }}">
                                                                        {{ $status->status }}</option>
                                                                @else
                                                                    <option value="{{ $status->id }}">
                                                                        {{ $status->status }}</option>
                                                                @endif
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    <textarea id="note_nv" @if ($roles != 'user' && $roles != 'admin') class="noedit" readonly @endif>{{ $item->note_nv }}</textarea>
                                                </td>
                                                <td>
                                                    <textarea id="note_ql" @if (!strpos($roles, '_mod') && $roles != 'admin') class="noedit" readonly @endif>{{ $item->note_ql }}</textarea>
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
                                <div class="row_">{{ $khiemkhuyet->links() }}</div>
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

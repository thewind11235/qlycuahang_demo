@extends('layouts.app', [
    'namePage' => 'Xuất tuyến',
    'class' => 'sidebar-mini',
    'activePage' => 'xuat_tuyen',
])

@section('content')
  <div class="panel-header panel-header-sm"></div>
  <div class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card ">
          <div class="card-header card-title">
            <a class="btn btn-primary btn-round text-white pull-right" href="{{ route('xuat_tuyen.create_index') }}">Thêm xuất tuyến</a>
            <h4 class="card-title">Quản lý xuất tuyến</h4>
            <div class="col-12 mt-2"></div>
          </div>
          <div class="card-body ">
            <div class="table-responsive">
                <div class="toolbar">
                    <form class="col-md-3" method="get" action="{{ route('xuat_tuyen.search') }}" autocomplete="off">
                        <div class="input-group no-border">
                          <input name="key_word" type="text" value="@isset($key_word){{ old('key_word', $key_word) }}@endisset" class="form-control" placeholder="Tìm kiếm ...">
                          <div class="input-group-append">
                            <div class="input-group-text">
                              <i class="now-ui-icons ui-1_zoom-bold"></i>
                            </div>
                          </div>
                        </div>
                    </form>
                </div>
                @if ( !empty($items) && $items->count() )
                <table class="table table-hover">
                    <thead class="text-primary">
                        <th>Tên xuất tuyến</th>
                        <th>Vị trí</th>
                        <th>Mô tả</th>
                        <th></th>
                    </thead>
                    <tbody>
                        @foreach ($items as $item)
                            <tr data-id="{{$item->id}}">
                                <td>
                                    <div class="col-md-10 pr-1">
                                        <div class="form-group">
                                            <input
                                            type="text"
                                            name="name"
                                            autocomplete="off"
                                            class="form-control"
                                            placeholder="Tên xuất tuyến"
                                            value="{{ old('name', $item->name) }}">
                                            @include('alerts.feedback', ['field' => 'name'])
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="col-md-10 pr-1">
                                        <div class="form-group">
                                            <input
                                            type="text"
                                            name="position"
                                            autocomplete="off"
                                            class="form-control"
                                            placeholder="Vị trí"
                                            value="{{ old('position', $item->position) }}">
                                            @include('alerts.feedback', ['field' => 'position'])
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="col-md-10 pr-1">
                                        <div class="form-group">
                                            <input
                                            type="text"
                                            name="description"
                                            autocomplete="off"
                                            class="form-control"
                                            placeholder="Mô tả"
                                            value="{{ old('description', $item->description) }}">
                                            @include('alerts.feedback', ['field' => 'description'])
                                        </div>
                                    </div>
                                </td>
                                <td class="text-right">
                                    <button class="btn btn-primary update_xt"><i class="fas fa-sync"></i> Cập nhật</button>
                                    <button class="btn btn-primary delete_xt"><i class="fas fa-trash-alt"></i> Xoá</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="row_">{{ $items->links() }}</div>
                @else
                <table class="table-responsive">
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


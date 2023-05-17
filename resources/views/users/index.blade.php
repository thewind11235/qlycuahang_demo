@extends('layouts.app', [
    'namePage' => 'Quản lý user',
    'activePage' => 'users',
  ])

@section('content')
<div class="panel-header panel-header-sm"></div>
<div class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <a class="btn btn-primary btn-round text-white pull-right" href="{{ route('users.create_user') }}">Thêm user</a>
            <h4 class="card-title">Quản lý users</h4>
            <div class="col-12 mt-2"></div>
          </div>
          <div class="card-body">
            <div class="toolbar">
                <form class="col-md-3" method="get" action="{{ route('users.search') }}" autocomplete="off">
                    <div class="input-group no-border">
                      <input type="text" name="key_word" value="@isset($key_word){{ old('key_word', $key_word) }}@endisset" class="form-control" placeholder="Tìm kiếm ...">
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
                  <th>Profile</th>
                  <th>MSNV</th>
                  <th>Tên</th>
                  <th>Email</th>
                  <th>Role</th>
                  <th class="disabled-sorting text-right">Actions</th>
                </tr>
              </thead>
              <tbody>
                @if ( !empty($users) && $users->count() )
                    @foreach ($users as $item)
                        <tr>
                            <td>
                            <span class="avatar avatar-sm rounded-circle">
                                <img src="{{asset('assets')}}/img/default-avatar.png" alt="" style="max-width: 80px; border-radiu: 100px">
                            </span>
                            </td>
                            <td>{{ $item->msnv }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->role }}</td>
                            <td class="text-right">
                            <a type="button" href="{{ route('users.edit') }}?msnv={{ $item->msnv }}" rel="tooltip" class="btn btn-warning btn-icon btn-sm " data-original-title="" title="">
                                <i class="now-ui-icons ui-2_settings-90"></i>
                            </a>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="6">Không có dữ liệu</td>
                    </tr>
                @endif
              </tbody>
            </table>
            <div class="row_">{{ $users->links() }}</div>
          </div>
          <!-- end content-->
        </div>
        <!--  end card  -->
      </div>
    </div>
</div>
@endsection

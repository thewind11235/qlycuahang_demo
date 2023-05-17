@extends('layouts.app', [
    'namePage' => 'Levels',
    'class' => 'sidebar-mini',
    'activePage' => 'levels',
])

@section('content')
  <div class="panel-header panel-header-sm">
  </div>
  <div class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card ">
          <div class="card-header card-title">
            <h4 class="card-title">Cấp bậc thợ</h4>
          </div>
          <div class="card-body ">
            <div class="table-responsive">
                <div class="toolbar">
                    <form class="col-md-3" method="get" action="{{ route('levels.search') }}" autocomplete="off">
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
                <table class="table table-hover">
                    <thead class="text-primary">
                        <th>MSNV</th>
                        <th>Tên</th>
                        <th>Chức danh</th>
                        <th>Bậc thợ</th>
                        <th>Bậc an toàn</th>
                        <th></th>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr data-id="{{$user->id}}">
                                <td>{{$user->msnv}}</td>
                                <td>{{$user->name}}</td>
                                <td>
                                    <div class="col-md-10 pr-1">
                                        <div class="form-group">
                                            <input
                                            type="text"
                                            name="chuc_danh"
                                            class="form-control"
                                            placeholder="Chức danh"
                                            value="{{ old('chuc_danh', $user->chuc_danh) }}">
                                            @include('alerts.feedback', ['field' => 'chuc_danh'])
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="col-md-10 pr-1">
                                        <div class="form-group">
                                            <input
                                            type="text"
                                            name="bac_tho"
                                            class="form-control"
                                            placeholder="Bậc thợ"
                                            value="{{ old('bac_tho', $user->bac_tho) }}">
                                            @include('alerts.feedback', ['field' => 'bac_tho'])
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="col-md-10 pr-1">
                                        <div class="form-group">
                                            <input
                                            type="text"
                                            name="bac_an_toan"
                                            class="form-control"
                                            placeholder="Bậc an toàn"
                                            value="{{ old('bac_an_toan', $user->bac_an_toan) }}">
                                            @include('alerts.feedback', ['field' => 'bac_an_toan'])
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <button class="btn btn-primary update_levels">Cập nhật</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="row_">{{ $users->links() }}</div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection


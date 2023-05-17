@extends('layouts.app', [
    'namePage' => 'Tạo users',
    'activePage' => 'users',
  ])

@section('content')
<div class="panel-header panel-header-sm"></div>
<div class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">

            <h4 class="card-title">Tạo users</h4>
            <div class="col-12 mt-2"></div>
          </div>
          <div class="card-body">
            <div class="toolbar">
              <!--        Here you can write extra buttons/actions for the toolbar              -->
            </div>
            {{-- content  --}}
            <form
                method="post"
                action="{{ route('users.create') }}"
                autocomplete="off"
                enctype="multipart/form-data">
                @csrf
                @method('put')
                @include('alerts.success')
                <div class="row"></div>
                <div class="row">
                    <div class="col-md-10 pr-1">
                        <div class="form-group">
                            <label>{{__(" Name")}}</label>
                            <input
                                type="text"
                                name="name"
                                class="form-control"
                                value="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10 pr-1">
                        <div class="form-group">
                            <label>{{__(" MSNV")}}</label>
                            <input
                                type="number"
                                name="msnv"
                                class="form-control"
                                value="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10 pr-1">
                        <div class="form-group">
                            <label>{{__(" E-mail")}}</label>
                            <input
                                type="text"
                                name="email"
                                class="form-control"
                                value="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10 pr-1">
                        <div class="form-group">
                            <label>{{__(" Chức vụ")}}</label>
                            <select name="role" class="form-control">
                                @foreach ($permissions as $value)
                                    @if( $value->slug == 'user')
                                        <option selected value="{{ $value->id }}">{{ $value->permission_name }}</option>
                                    @else
                                        <option value="{{ $value->id }}">{{ $value->permission_name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10 pr-1">
                        <div class="form-group">
                            <label>{{__(" Mật khẩu")}}</label>
                            <input
                                type="password"
                                name="password"
                                class="form-control"
                                value="">
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-round">{{__('Tạo tài khoản')}}</button>
                </div>
                <hr class="half-rule"/>
            </form>
          </div>
          <!-- end content-->
        </div>
        <!--  end card  -->
      </div>
    </div>
</div>
@endsection

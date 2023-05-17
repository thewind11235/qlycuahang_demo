@extends('layouts.app', [ 'class' => 'sidebar-mini ', 'namePage' => 'User
Profile', 'activePage' => 'profile', 'activeNav' => '', ]) @section('content')
<div class="panel-header panel-header-sm"></div>
<div class="content">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="title">{{__(" Edit Profile")}}</h5>
                </div>
                <div class="card-body">
                    <form
                        method="post"
                        action="{{ route('users.update') }}"
                        autocomplete="off"
                        enctype="multipart/form-data">
                        @csrf @method('put') @include('alerts.success')
                        <div class="row"></div>
                        <div class="row">
                            <div class="col-md-7 pr-1">
                                <div class="form-group">
                                    <label>{{__(" Name")}}</label>
                                    <input
                                        type="text"
                                        name="name"
                                        class="form-control"
                                        value="{{ old('name', $users->name) }}">
                                    @include('alerts.feedback', ['field' => 'name'])
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-7 pr-1">
                                <div class="form-group">
                                    <label>{{__(" Chức vụ")}}</label>
                                    <select name="role" class="form-control">
                                        @foreach ($permissions as $value)
                                            @if ( $users->role_id == $value->id)
                                                <option value="{{ $users->role_id }}" selected>{{ $users->role }}</option>
                                            @else
                                                <option value="{{ $value->id}}">{{ $value->permission_name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-7 pr-1">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">{{__(" Email address")}}</label>
                                    <input
                                        type="email"
                                        name="email"
                                        class="form-control"
                                        placeholder="Email"
                                        value="{{ old('email', $users->email) }}">
                                    @include('alerts.feedback', ['field' => 'email'])
                                    <input
                                        readonly
                                        type="hidden"
                                        name="msnv"
                                        class="form-control"
                                        value="{{ old('email', $users->msnv) }}">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ">
                            <button type="submit" class="btn btn-primary btn-round">{{__('Save')}}</button>
                        </div>
                        <hr class="half-rule"/>
                    </form>
                </div>
                <div class="card-header">
                    <h5 class="title">{{__("Password")}}</h5>
                </div>
                <div class="card-body">
                    <form method="post" action="{{ route('users.password') }}" autocomplete="off">
                        @csrf @method('put') @include('alerts.success', ['key' => 'password_status'])
                        <div class="row">
                            <div class="col-md-7 pr-1">
                                <div class="form-group {{ $errors->has('password') ? ' has-danger' : '' }}">
                                    <label>{{__(" New password")}}</label>
                                    <input
                                        class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}"
                                        placeholder="{{ __('New Password') }}"
                                        type="password"
                                        name="password"
                                        required="required">
                                    @include('alerts.feedback', ['field' => 'password'])
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-7 pr-1">
                                <div class="form-group {{ $errors->has('password') ? ' has-danger' : '' }}">
                                    <label>{{__(" Confirm New Password")}}</label>
                                    <input
                                        class="form-control"
                                        placeholder="{{ __('Confirm New Password') }}"
                                        type="password"
                                        name="password_confirmation"
                                        required="required">
                                    <input
                                        readonly
                                        type="hidden"
                                        name="msnv"
                                        class="form-control"
                                        value="{{ old('email', $users->msnv) }}">
                                </div>
                            </div>
                        </div>
                        <div class="card-footer ">
                            <button type="submit" class="btn btn-primary btn-round ">{{__('Change Password')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card card-user">
                <div class="image">
                    <img src="{{asset('assets')}}/img/bg5.jpg" alt="...">
                </div>
                <div class="card-body">
                    <div class="author">
                        <a href="#">
                            <img
                                class="avatar border-gray"
                                src="{{asset('assets')}}/img/default-avatar.png"
                                alt="...">
                            <h5 class="title">{{ $users->name }}</h5>
                        </a>
                        <p class="description">
                            MSNV: {{ $users->msnv }}
                        </p>
                        <p class="description">
                            Role:
                            {{ $users->role }}
                        </p>
                        <p class="description">
                            {{ $users->email }}
                        </p>
                    </div>
                </div>
                <hr>
                <div class="button-container">
                    <button href="#" class="btn btn-neutral btn-icon btn-round btn-lg">
                        <i class="fab fa-facebook-square"></i>
                    </button>
                    <button href="#" class="btn btn-neutral btn-icon btn-round btn-lg">
                        <i class="fab fa-twitter"></i>
                    </button>
                    <button href="#" class="btn btn-neutral btn-icon btn-round btn-lg">
                        <i class="fab fa-google-plus-square"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

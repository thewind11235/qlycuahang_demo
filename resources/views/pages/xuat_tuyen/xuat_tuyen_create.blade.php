@extends('layouts.app', [
    'namePage' => 'Tạo users',
    'activePage' => 'xuat_tuyen',
  ])

@section('content')
<div class="panel-header panel-header-sm"></div>
<div class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h4 class="card-title">Tạo xuất tuyến</h4>
            <div class="col-12 mt-2"></div>
          </div>
          <div class="card-body">
            <div class="toolbar">
            </div>
            <form
                method="post"
                action="{{ route('xuat_tuyen.create') }}"
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
                            <label>{{__(" Position")}}</label>
                            <input
                                type="text"
                                name="position"
                                class="form-control"
                                value="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-10 pr-1">
                        <div class="form-group">
                            <label>{{__("Description")}}</label>
                            <input
                                type="text"
                                name="description"
                                class="form-control"
                                value="">
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-primary btn-round">{{__('Tạo xuất tuyến')}}</button>
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

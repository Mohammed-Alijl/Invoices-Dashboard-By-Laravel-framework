@extends('layouts.master')
@section('css')
    <!-- Internal Nice-select css  -->
    <link href="{{URL::asset('assets/plugins/jquery-nice-select/css/nice-select.css')}}" rel="stylesheet" />
    @section('title')
        {{__('Front-end/users.user.edit')}}
    @stop


@endsection
@section('page-header')
    <!-- breadcrumb -->
    <div class="breadcrumb-header justify-content-between">
        <div class="my-auto">
            <div class="d-flex">
                <h4 class="content-title mb-0 my-auto">{{__('Front-end/users.users')}}</h4><span class="text-muted mt-1 tx-13 mr-2 mb-0">/ {{__('Front-end/users.user.edit')}}</span>
            </div>
        </div>
    </div>
    <!-- breadcrumb -->
@endsection
@section('content')
    <!-- row -->
    <div class="row">
        <div class="col-lg-12 col-md-12">

            @if ($errors->any())
                <div class="alert alert-danger">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="card">
                <div class="card-body">
                    <br>
                    <form action="{{route('users.update',$user->id)}}" method="post">
                        @csrf
                        @method('put')

                    <div class="">

                        <div class="row mg-b-20">
                            <div class="parsley-input col-md-6" id="fnWrapper">
                                <label>{{__('Front-end/users.user.name')}}: <span class="tx-danger">*</span></label>
                                <input type="text" class="form-control" name="name" required value="{{$user->name}}">
                            </div>

                            <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                                <label>{{__('Front-end/users.email')}}: <span class="tx-danger">*</span></label>
                                <input type="email" class="form-control" name="email" required value="{{$user->email}}">
                            </div>
                        </div>

                    </div>

                    <div class="row mg-b-20">
                        <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                            <label>{{__('Front-end/users.password.change')}}: </label>
                            <input type="password" name="password" class="form-control">
                        </div>

                        <div class="parsley-input col-md-6 mg-t-20 mg-md-t-0" id="lnWrapper">
                            <label> {{__('Front-end/users.confirm.new.password')}}: </label>
                            <input type="password" name="confirm-password" class="form-control">
                        </div>
                    </div>

                    <div class="row row-sm mg-b-20">
                        <div class="col-lg-6">
                            <label class="form-label">{{__('Front-end/users.user.status')}}</label>
                            <select name="status" id="select-beast" class="form-control  nice-select  custom-select">
                                @if($user->status == 1)
                                <option value="1" selected>{{__('Front-end/users.active')}}</option>
                                <option value="0">{{__('Front-end/users.inactive')}}</option>
                                @else
                                    <option value="0" selected>{{__('Front-end/users.inactive')}}</option>
                                    <option value="1">{{__('Front-end/users.active')}}</option>
                                @endif
                            </select>
                        </div>
                    </div>

                    <div class="row mg-b-20">
                        <div class="col-xs-12 col-sm-12 col-md-12">
                            <div class="form-group">
                                <strong>{{__('Front-end/users.user.role')}}</strong>
                                <select name="roles_name[]" multiple class="form-control">
                                    @foreach($roles as $role)
                                        <option value="{{$role}}" {{in_array($role,$userRole)?'selected':''}}>{{$role}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="mg-t-30">
                        <button class="btn btn-main-primary pd-x-20" type="submit">{{__('Front-end/users.update')}}</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>




    </div>
    <!-- row closed -->
    </div>
    <!-- Container closed -->
    </div>
    <!-- main-content closed -->
@endsection
@section('js')

    <!-- Internal Nice-select js-->
    <script src="{{URL::asset('assets/plugins/jquery-nice-select/js/jquery.nice-select.js')}}"></script>
    <script src="{{URL::asset('assets/plugins/jquery-nice-select/js/nice-select.js')}}"></script>

    <!--Internal  Parsley.min js -->
    <script src="{{URL::asset('assets/plugins/parsleyjs/parsley.min.js')}}"></script>
    <!-- Internal Form-validation js -->
    <script src="{{URL::asset('assets/js/form-validation.js')}}"></script>
@endsection

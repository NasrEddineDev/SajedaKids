@extends('layouts.main')
@Push('css')
    <style>
        #addUser {
            margin: 10px;
            margin-top: 10px;
            margin-top: -10px;
        }
        .showedImage{
            padding: 0px!important;
        }
        .showedImage img{
            height:60px;
        }
    </style>
@endpush

@section('content')
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <!-- basic table -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <h4 class="card-title">{{ __('Users List') }}</h4>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <a href="{{ route('users.create') }}">
                                    <button id="addUser" type="button" class="btn btn-success btn-rounded float-right">
                                        <i class="fas fa-plus-circle"></i>{{ __('New User') }}</button></a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered no-wrap">
                                <thead>
                                    <tr>
                                        <th>{{ __('Id') }}</th>
                                        <th>{{ __('Name') }}</th>
                                        <th>{{ __('Email') }}</th>
                                        <th>{{ __('Role') }}</th>
                                        <th>{{ __('Store') }}</th>
                                        <th>{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr id="{{ $user->id }}">
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td id="role"><button
                                                class="btn
                                                {{ $user->role->name == 'user'
                                                            ? 'btn-default'
                                                            : ($user->role->name == 'seller_company'
                                                                ? 'btn-info'
                                                                : ($user->role->name == 'admin_company'
                                                                    ? 'btn-success'
                                                                    : ($user->role->name == 'manager_company'
                                                                        ? 'btn-warning'
                                                                        : 'btn-danger'))) }}"
                                                style="width:135px;border-radius:5px;font-size: 14px;padding:0px;padding-right:5px;padding-left:5px;">
                                                {{ __($user->role->name) }}</button>
                                            </td>
                                            <td>{{ $user->store?->name }}</td>
                                            <td class="datatable-ct">
                                                @can('update',  App\Models\User::class)
                                                <a rel="tooltip" class="" href="{{ route('users.edit',$user->id) }}" data-original-title="" title="Edit">
                                                    <i class="fa fa-pencil-square-o fa-lg warning"></i>
                                                </a>
                                                @endcan
                                                @can('delete',  App\Models\User::class)
                                                <a rel="tooltip" class=" pd-setting-ed" href="#" data-url="{{ route('users.destroy',$user->id) }}"
                                                data-user_name="{{ $user->name }}" data-original-title="" title="Delete" data-toggle="modal"
                                                data-target="#DangerModalhdbgcl" style="">
                                                    <i class="fa fa-trash fa-lg" style="color:red;" aria-hidden="true"></i>
                                                </a>
                                                @endcan
                                            </td>
                                            @can('view-company', App\Models\user::class)
                                                <td>{{ $user->company->name }}</td>
                                            @endcan
                                        </tr>
                                    @endforeach
                                    <!-- <tr>
                                        <td>Tiger Nixon</td>
                                        <td>System Architect</td>
                                        <td>Edinburgh</td>
                                        <td>61</td>
                                        <td>2011/04/25</td>
                                        <td>$320,800</td>
                                        <td>Sirwal</td>
                                        <td>Levis</td>
                                        <td>Yes</td>
                                        <td></td>
                                    </tr> -->
                                </tbody>
                                <!-- <tfoot>
                                    <tr>
                                        <th>{{ __('Id') }}</th>
                                        <th>{{ __('Name') }}</th>
                                        <th>{{ __('SKU') }}</th>
                                        <th>{{ __('Image') }}</th>
                                        <th>{{ __('Price') }}</th>
                                        <th>{{ __('Discount') }}</th>
                                        <th>{{ __('Category') }}</th>
                                        <th>{{ __('Brand') }}</th>
                                        <th>{{ __('Active') }}</th>
                                        <th>{{ __('Action') }}</th>
                                    </tr>
                                </tfoot> -->
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End PAge Content -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
@endsection

@Push('js')
    <script type="text/javascript"></script>
@endpush

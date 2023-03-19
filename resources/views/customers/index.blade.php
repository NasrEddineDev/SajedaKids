@extends('layouts.main')
@Push('css')
    <style>
        #addCustomer {
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
                                <h4 class="card-title">{{ __('Customers List') }}</h4>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <a href="{{ route('customers.create') }}">
                                    <button id="addCustomer" type="button" class="btn btn-success btn-rounded float-right">
                                        <i class="fas fa-plus-circle"></i>{{ __('New Customer') }}</button></a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered no-wrap">
                                <thead>
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
                                </thead>
                                <tbody>
                                    @foreach ($customers as $customer)
                                        <tr id="{{ $customer->id }}">
                                            <td>{{ $customer->id }}</td>
                                            <td>{{ $customer->name }}</td>
                                            <td>{{ $customer->SKU }}</td>
                                            <td class="showedImage">
                                                <img class="img-thumbnail"
                                                    src="https://t4.ftcdn.net/jpg/03/18/30/85/360_F_318308547_FALKncfWsTmjzwd0y0muNeCFOULPLB7Q.webp"
                                                    alt="...">
                                            </td>
                                            <td>{{ $customer->price }}</td>
                                            <td>{{ $customer->discount }}</td>
                                            <td>{{ $customer->category->name }}</td>
                                            <td>{{ $customer->brand->name }}</td>
                                            <td id="status"><button
                                                class="btn {{ $customer->active ? 'btn-success' : 'btn-danger' }}"
                                                style="width:50px;border-radius:5px;font-size: 14px;padding:0px;padding-right:5px;padding-left:5px;">
                                                {{ $customer->active ? __("Yes") : __("No") }}</button>
                                            </td>
                                            <td class="datatable-ct">
                                                @can('update',  App\Models\Customer::class)
                                                <a rel="tooltip" class="" href="{{ route('customers.edit',$customer->id) }}" data-original-title="" title="Edit">
                                                    <i class="fa fa-pencil-square-o fa-lg warning"></i>
                                                </a>
                                                @endcan
                                                @can('delete',  App\Models\Customer::class)
                                                <a rel="tooltip" class=" pd-setting-ed" href="#" data-url="{{ route('customers.destroy',$customer->id) }}"
                                                data-customer_name="{{ $customer->name }}" data-original-title="" title="Delete" data-toggle="modal"
                                                data-target="#DangerModalhdbgcl" style="">
                                                    <i class="fa fa-trash fa-lg" style="color:red;" aria-hidden="true"></i>
                                                </a>
                                                @endcan
                                            </td>
                                            @can('view-company', App\Models\customer::class)
                                                <td>{{ $customer->company->name }}</td>
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

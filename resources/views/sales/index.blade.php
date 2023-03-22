@extends('layouts.main')
@Push('css')
    <style>
        #addSale {
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
                                <h4 class="card-title">{{ __('Sales List') }}</h4>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <a href="{{ route('sales.create') }}">
                                    <button id="addSale" type="button" class="btn btn-success btn-rounded float-right">
                                        <i class="fas fa-plus-circle"></i>{{ __('New Sale') }}</button></a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered no-wrap">
                                <thead>
                                    <tr>
                                        <th>{{ __('Id') }}</th>
                                        <th>{{ __('Date') }}</th>
                                        <th>{{ __('Type') }}</th>
                                        <th>{{ __('Total Amount') }}</th>
                                        <th>{{ __('User') }}</th>
                                        <th>{{ __('Customer') }}</th>
                                        <th>{{ __('Store') }}</th>
                                        <th>{{ __('Status') }}</th>
                                        <th>{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($sales as $sale)
                                        <tr id="{{ $sale->id }}">
                                            <td>{{ $sale->id }}</td>
                                            <td>{{ $sale->date }}</td>
                                            <td>{{ $sale->type }}</td>
                                            <td>{{ $sale->total_amount }}</td>
                                            <td>{{ $sale->user->name }}</td>
                                            <td>{{ $sale->customer?->name }}</td>
                                            <td>{{ $sale->store->name }}</td>
                                            <td id="status"><button
                                                class="btn {{ $sale->status == 'Completed' ? 'btn-success' : 'btn-danger' }}"
                                                style="width:100px;border-radius:5px;font-size: 14px;padding:0px;padding-right:5px;padding-left:5px;">
                                                {{ __($sale->status) }}</button>
                                            </td>
                                            <td class="datatable-ct">
                                                @can('update',  App\Models\Sale::class)
                                                <a rel="tooltip" class="" href="{{ route('sales.edit',$sale->id) }}" data-original-title="" title="Edit">
                                                    <i class="fa fa-pencil-square-o fa-lg warning"></i>
                                                </a>
                                                @endcan
                                                @can('delete',  App\Models\Sale::class)
                                                <a rel="tooltip" class=" pd-setting-ed" href="#" data-url="{{ route('sales.destroy',$sale->id) }}"
                                                data-sale_name="{{ $sale->name }}" data-original-title="" title="Delete" data-toggle="modal"
                                                data-target="#DangerModalhdbgcl" style="">
                                                    <i class="fa fa-trash fa-lg" style="color:red;" aria-hidden="true"></i>
                                                </a>
                                                @endcan
                                            </td>
                                            @can('view-company', App\Models\sale::class)
                                                <td>{{ $sale->company->name }}</td>
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

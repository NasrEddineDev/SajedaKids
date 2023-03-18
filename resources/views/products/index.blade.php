@extends('layouts.main')
@Push('css')

    <style>

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
                                <h4 class="card-title">{{ __("Products List") }}</h4>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                    <a href="{{ route('products.create') }}">
                                <button type="button" class="btn btn-success btn-rounded float-right">
                                    <i class="fas fa-plus-circle"></i>{{ __("New Product") }}</button></a>
                                </div>
                                </div>
                                <div class="table-responsive">
                                    <table id="zero_config" class="table table-striped table-bordered no-wrap">
                                        <thead>
                                            <tr>
                                                <th>{{ __("Id") }}</th>
                                                <th>{{ __("Name") }}</th>
                                                <th>{{ __("SKU") }}</th>
                                                <th>{{ __("Image") }}</th>
                                                <th>{{ __("Price") }}</th>
                                                <th>{{ __("Discount") }}</th>
                                                <th>{{ __("Category") }}</th>
                                                <th>{{ __("Brand") }}</th>
                                                <th>{{ __("Active") }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @foreach ($products as $product)
                                            <tr id="{{ $product->id }}">
                                                <td>{{ $product->id }}</td>
                                                <td>{{ $product->name }}</td>
                                                <td>{{ $product->SKU }}</td>
                                                <td>{{ $product->image }}</td>
                                                <td>{{ $product->price }}</td>
                                                <td>{{ $product->discount }}</td>
                                                <td>{{ $product->category }}</td>
                                                <td>{{ $product->brand }}</td>
                                                <td>{{ $product->active }}</td>
                                                @can('view-enterprise',  App\Models\product::class)
                                                <td>{{ $product->enterprise->name }}</td>
                                                @endcan
                                            </tr>
                                        @endforeach
                                            <tr>
                                                <td>Tiger Nixon</td>
                                                <td>System Architect</td>
                                                <td>Edinburgh</td>
                                                <td>61</td>
                                                <td>2011/04/25</td>
                                                <td>$320,800</td>
                                                <td>Sirwal</td>
                                                <td>Levis</td>
                                                <td>Yes</td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>{{ __("Id") }}</th>
                                                <th>{{ __("Name") }}</th>
                                                <th>{{ __("SKU") }}</th>
                                                <th>{{ __("Image") }}</th>
                                                <th>{{ __("Price") }}</th>
                                                <th>{{ __("Discount") }}</th>
                                                <th>{{ __("Category") }}</th>
                                                <th>{{ __("Brand") }}</th>
                                                <th>{{ __("Active") }}</th>
                                            </tr>
                                        </tfoot>
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
    <script type="text/javascript">

    </script>
@endpush

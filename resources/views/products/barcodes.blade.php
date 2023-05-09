@extends('layouts.main')
@Push('css')



<link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.3.3/css/rowReorder.dataTables.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css" />

    <style>
        #addProduct {
            margin: 10px;
            margin-top: 10px;
            margin-top: -10px;
        }

        .showedImage {
            padding: 0px !important;
        }

        .showedImage img {
            height: 60px;
        }

        @font-face {
            font-family: 'Material Icons';
            font-style: normal;
            font-weight: 400;
            src: url(https://fonts.gstatic.com/s/materialicons/v140/flUhRq6tzZclQEJ-Vdg-IuiaDsNc.woff2) format('woff2');
        }

        .material-icons {
            font-family: 'Material Icons';
            font-weight: normal;
            font-style: normal;
            font-size: 32px;
            line-height: 1;
            letter-spacing: normal;
            text-transform: none;
            display: inline-block;
            white-space: nowrap;
            word-wrap: normal;
            direction: ltr;
            -moz-font-feature-settings: 'liga';
            -moz-osx-font-smoothing: grayscale;
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
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 {{ App::currentLocale() == 'ar' ? 'text-right' : 'text-left' }}">
                                <h4 class="card-title">{{ __('Barcodes List') }}</h4>
                            </div>
                            <div id="menu" class="col-lg-6 col-md-6 col-sm-6 col-xs-6  {{ App::currentLocale() == 'ar' ? 'text-left' : 'text-right' }}">

                                <a rel="tooltip" id="print" name="print" class=" pd-setting-ed" href="#"
                                    data-url="" data-product_name="" data-original-title="" title="{{__('Print')}}"
                                    data-toggle="modal" data-target="#DangerModalhdbgcl" style="">
                                    {{-- <i class="material-icons" style="color:red;" aria-hidden="true">&#xe92b;</i> --}}
                                    <i class="material-icons text-info">&#xe8ad;</i>
                                </a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="main_datatable" class="table table-striped table-bordered no-wrap">
                                <thead>
                                    <tr>
                                        <th>{{ __('Id') }}</th>
                                        <th>{{ __('Product name') }}</th>
                                        <th>{{ __('SKU') }}</th>
                                        <th>{{ __('Image') }}</th>
                                        <th>{{ __('Price') }}</th>
                                        <th>{{ __('Active') }}</th>
                                        {{-- <th>{{ __('Action') }}</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($products as $product)
                                        <tr id="{{ $product->id }}">
                                            <td>{{ $product->id }}</td>
                                            <td id="productName">{{ $product->name }}</td>
                                            <td id="productSKU">{{ $product->SKU }}</td>
                                            <td class="showedImage">
                                                <img class="img-thumbnail"
                                                    src="https://t4.ftcdn.net/jpg/03/18/30/85/360_F_318308547_FALKncfWsTmjzwd0y0muNeCFOULPLB7Q.webp"
                                                    alt="...">
                                            </td>
                                            <td>{{ $product->price }}</td>
                                            <td id="status"><button
                                                class="btn {{ $product->active ? 'btn-success' : 'btn-danger' }}"
                                                style="width:50px;border-radius:5px;font-size: 14px;padding:0px;padding-right:5px;padding-left:5px;">
                                                {{ $product->active ? __("Yes") : __("No") }}</button>
                                            </td>
                                            @can('view-company', App\Models\product::class)
                                                <td>{{ $product->company->name }}</td>
                                            @endcan
                                        </tr>
                                    @endforeach
                                </tbody>
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


    <!-- Modal -->
    <div class="modal fade" id="printModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __("Print Barcode") }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-check" style="margin:auto">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">{{__('Add product price')}}</label>
                      </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios1" value="option1" checked>
                            <label class="form-check-label" for="exampleRadios1">
                                {{__('Add product name')}}
                            </label>
                          </div>
                          <div class="form-check">
                            <input class="form-check-input" type="radio" name="exampleRadios" id="exampleRadios2" value="option2">
                            <label class="form-check-label" for="exampleRadios2">
                                {{__('Add Label')}}
                            </label>
                          </div>
                    <div style="width:151.1px;height:75.6px;background-color:black;margin:auto" ></div>
                    {{-- <span aria-hidden="true">{{ __("Would you like to delete this item") }}</span><br />
                    {{ __("Product Id: ") }}<strong><span id='productId'></span><br /></strong>
                    {{ __("Product SKU: ") }}<strong><span id='productSKU'></span><br /></strong>
                    {{ __("Product Name: ") }}<strong><span id='productName'></span></strong> --}}
                </div>
                <div class="modal-footer">
                    <button type="button" id='cancel' name='cancel' class="btn btn-success" data-dismiss="modal">{{ __("Cancel") }}</button>
                    <button type="button" id='Confirm' name='Confirm' class="btn btn-danger">{{ __("Confirm") }}</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@Push('js')
<script src="https://cdn.datatables.net/rowreorder/1.3.3/js/dataTables.rowReorder.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>




    <script type="text/javascript">
        $(document).ready(function() {
        var main_datatable_table = $('#main_datatable').DataTable();


        var table = $('#product_table').DataTable();
        $('#main_datatable tbody').on('click', 'tr', function() {
            if ($(this).hasClass('selected')) {
                $(this).removeClass('selected');
            } else {
                main_datatable_table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }
        });

        $('#print').click(function(e) {
            e.preventDefault();
            var id = main_datatable_table.row( '.selected' ).id();
            if (id){
                $('#printModal #productId').text(id);
                $('#printModal #productSKU').text($("#"+id+" #productSKU").text());
                $('#printModal #productName').text($("#"+id+" #productName").text());
                $('#printModal').modal('toggle');
            }
        });

        $("#Confirm").click(function(e) {
            e.preventDefault();
            var id = main_datatable_table.row( '.selected' ).id();
            var url = "{{ route('products.destroy', 'id') }}".replace('id', id);
            console.log(url);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                type: 'DELETE',
                success: function(result) {
                    if(result.done){
                        var res = main_datatable_table.row( '.selected' ).remove().draw();
                        $('#printModal').modal('toggle');
                    }
                    // e.preventDefault();
                    // selections = getIdSelections();
                    // $table.bootstrapTable('remove', {
                    //     field: 'id',
                    //     values: selections
                    // });
                    // $('#DangerModalhdbgcl').modal('toggle');
                }
            });
        });
        });
    </script>
@endpush

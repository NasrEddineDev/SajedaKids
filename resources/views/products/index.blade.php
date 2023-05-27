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
                            <div
                                class="col-lg-6 col-md-6 col-sm-6 col-xs-6 {{ App::currentLocale() == 'ar' ? 'text-right' : 'text-left' }}">
                                <h4 class="card-title">{{ __('Products List') }}</h4>
                            </div>
                            <div id="menu"
                                class="col-lg-6 col-md-6 col-sm-6 col-xs-6  {{ App::currentLocale() == 'ar' ? 'text-left' : 'text-right' }}">
                                <a rel="tooltip" class="" href="{{ route('products.create') }}" title="{{ __('New Product') }}">
                                    <i class="material-icons text-success">&#xe89c;</i>
                                </a>
                                <a rel="tooltip" class="" href="#" id="edit" name="edit" title="{{ __('Edit') }}">
                                    <i class="material-icons">&#xe22b;</i>
                                </a>
                                <a rel="tooltip" id="delete" name="delete" class=" pd-setting-ed" href="#"
                                    data-url="" data-product_name="" data-original-title="" title="{{ __('Delete') }}"
                                    data-toggle="modal" data-target="#DangerModalhdbgcl" style="">
                                    <i class="material-icons" style="color:red;" aria-hidden="true">&#xe92b;</i>
                                </a>
                                <a rel="tooltip" id="print" name="print" class=" pd-setting-ed" href="#"
                                    data-url="" data-product_name="" data-original-title="" title="{{ __('Print') }}"
                                    data-toggle="modal" data-target="#DangerModalhdbgcl" style="">
                                    <i class="material-icons text-info">&#xe8ad;</i>
                                </a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="main_datatable" class="table table-striped table-bordered no-wrap">
                                <thead>
                                    <tr>
                                        <th>{{ __('Id') }}</th>
                                        <th>{{ __('Name') }}</th>
                                        <th>{{ __('SKU') }}</th>
                                        <th>{{ __('Quantity') }}</th>
                                        <th>{{ __('Price') }}</th>
                                        <th>{{ __('Discount') }}</th>
                                        <th>{{ __('Image') }}</th>
                                        <th>{{ __('Category') }}</th>
                                        <!-- <th>{{ __('Brand') }}</th> -->
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
                                            <td>{{ $product->quantity }}</td>
                                            <td>{{ $product->price }}</td>
                                            <td>{{ $product->discount }}</td>
                                            <td class="showedImage">
                                                <img class="img-thumbnail"
                                                    src="https://t4.ftcdn.net/jpg/03/18/30/85/360_F_318308547_FALKncfWsTmjzwd0y0muNeCFOULPLB7Q.webp"
                                                    alt="...">
                                            </td>
                                            <td>{{ $product->category?->name }}</td>
                                            <!-- <td>{{ $product->brand?->name }}</td> -->
                                            <td id="status"><button
                                                    class="btn {{ $product->active ? 'btn-success' : 'btn-danger' }}"
                                                    style="width:50px;border-radius:5px;font-size: 14px;padding:0px;padding-right:5px;padding-left:5px;">
                                                    {{ $product->active ? __('Yes') : __('No') }}</button>
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
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('Delete Product') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <span aria-hidden="true">{{ __('Would you like to delete this item') }}</span><br />
                    {{ __('Product Id: ') }}<strong><span id='productId'></span><br /></strong>
                    {{ __('Product SKU: ') }}<strong><span id='productSKU'></span><br /></strong>
                    {{ __('Product Name: ') }}<strong><span id='productName'></span></strong>
                </div>
                <div class="modal-footer">
                    <button type="button" id='cancel' name='cancel' class="btn btn-success"
                        data-dismiss="modal">{{ __('Cancel') }}</button>
                    <button type="button" id='Confirm' name='Confirm'
                        class="btn btn-danger">{{ __('Confirm') }}</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="printModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ __('Print Barcode') }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body" >
                    <!-- <div class="form-check" style="margin:auto">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">{{ __('Add product price') }}</label>
                    </div>
                    <div class="form-check" style="margin:auto">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">{{ __('Add product name') }}</label>
                    </div>
                    <br /> -->
                    <div style="margin:auto" id="images">
                        <img style="height:100px;;margin:auto" id="barcodeImage" class="img-thumbnail" src="barcodes/white_40_20m.jpg" alt="...">
                        <!-- <img style="height:100px;;margin:auto" class="img-thumbnail" src="barcodes8590604653.png" alt="..."> -->
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id='cancel' name='cancel' class="btn btn-danger"
                        data-dismiss="modal">{{ __('Cancel') }}</button>
                    <button type="button" id='downloadImage' name='downloadImage'
                        class="btn btn-success">{{ __('Download Image') }}</button>
                    <button type="button" id='downloadPDF' name='downloadPDF' disabled
                        class="btn btn-info">{{ __('Download PDF') }}</button>
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

                // var selectedProductId = $(this).attr('id');
                // $.ajax({
                //     headers: {
                //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                //     },
                //     url: "/getproductdetails/" + selectedProductId,
                //     type: "GET",
                //     success: function(data) {
                //         console.log(data);
                //         console.log(data.product.date);
                //         document.getElementById('date').valueAsDate = new Date(data.product.date);
                //         // products_table.clear().draw();
                //         var rows = table.rows().remove().draw();
                //         $(".dataTables_empty").closest('tr').hide();
                //         var rowIdx = 0,
                //             total = 0;
                //         $.each(data.product_items, function(index, product_item) {
                //             $('#tbody').append(`<tr id="${++rowIdx}">
            //                                     <td>${rowIdx}</td>
            //                                     <td>${product_item.product_sku}</td>
            //                                     <td>${product_item.price}</td>
            //                                     <td>${product_item.quantity}</td>
            //                                     <td>Product Name: ${product_item.product_name}, Price: ${product_item.product_price}</td>
            //                                     <td>${product_item.total_amount}</td>
            //                                     </tr>`);
                //             total += parseInt(product_item.total_amount);
                //         })
                //         $("#total").val(total+'{{ ' ' . __('DA') }}');
                //     }
                // })
            });

            $('#delete').click(function(e) {
                e.preventDefault();
                var id = main_datatable_table.row('.selected').id();
                if (id) {
                    $('#deleteModal #productId').text(id);
                    $('#deleteModal #productSKU').text($("#" + id + " #productSKU").text());
                    $('#deleteModal #productName').text($("#" + id + " #productName").text());
                    $('#deleteModal').modal('toggle');
                }
            });
            $('#edit').click(function(e) {
                e.preventDefault();
                var id = main_datatable_table.row('.selected').id();
                window.location.href = '/products/' + id + '/edit';
            });

            $("#Confirm").click(function(e) {
                e.preventDefault();
                var id = main_datatable_table.row('.selected').id();
                var url = "{{ route('products.destroy', 'id') }}".replace('id', id);
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: url,
                    type: 'DELETE',
                    success: function(result) {
                        if (result.done) {
                            var res = main_datatable_table.row('.selected').remove().draw();
                            $('#deleteModal').modal('toggle');
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

            // $('#printModal').on('hidden.bs.modal', function (e){ 
            //         // $("#barcodeImage").attr("src",'');
            //         $(this).removeData('bs.modal');
            // });
            // $('#printModal').on('hidden.bs.modal', function () {
            //     $(this).remove();
            // });

            var originalModal = $('#printModal').clone();
$(document).on('#printModal', 'hidden.bs.modal', function () {
    $('#printModal').remove();
    var myClone = originalModal.clone();
    $('body').append(myClone);
});

            $("#printModal").on('hidden.bs.modal', function () {
                $(this).data('bs.modal', null);
            });

            $('body').on('hidden.bs.modal', '.modal', function () {
                $(this).removeData('bs.modal');
            });

            $("#printModal").on('hidden.bs.modal', function() {
                $(this).data('bs.modal', null);
            });
            $("#printModal").on('shown.bs.modal', function() {
                $(this).data('bs.modal', null);
            });

            $('#print').click(function(e) {
                e.preventDefault();
                var id = main_datatable_table.row('.selected').id();
                if (id) {
                    $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: '{{ route("settings.print-barcode") }}',
                    type: 'POST',
                    data: {'product_id': id},
                    success: function(result) {
                        $('#printModal').modal('show')
                        $("#images").html("");
                        $("#images").html(`                        
                            <img style="height:100px;;margin:auto" id="barcodeImage1" class="" src="${result.path}" alt="...">
                        `);
                        $("#barcodeImage1").attr("src",result.path);
                        // document.getElementById("barcodeImage1").setAttribute('src', result.path);
                        document.getElementById("barcodeImage1").src = result.path;

                        // var image = new Image();
                        // image.src = result.path;
                        // $('#images').append(image);

                        // $('#printModal').modal('toggle');

                        // $("#printModal").val(null).trigger("change");
                        // $("#printModal .modal-body").load(function() { 
                        //     $("#printModal").modal("show"); 
                        // });
                    }
                });
                }
            });


            $("#downloadImage").click(function(e) {
                e.preventDefault();
                const data = '/barcodes/print.jpg';
                const link = document.createElement('a');
                link.setAttribute('href', data);
                link.setAttribute('download', 'barecode.jpg'); // Need to modify filename ...
                link.click();
                // TODO: Download PDF file
                // var id = main_datatable_table.row('.selected').id();
                // $.ajax({
                //     headers: {
                //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                //     },
                //     url: '{{ route("downloads.barcode-image") }}',
                //     type: 'GET',
                //     success: function(result) {
                //         const data = '/barcodes/print.jpg';
                //         const link = document.createElement('a');
                //         link.setAttribute('href', data);
                //         link.setAttribute('download', 'barecode.jpg'); // Need to modify filename ...
                //         link.click();
                //     }
                // });
            });
        });
    </script>
@endpush

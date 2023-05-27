@extends('layouts.main')
@Push('css')



<link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.3.3/css/rowReorder.dataTables.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css" />

    <style>
        #addPurchase {
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
                                <h4 class="card-title">{{ __('Purchases List') }}</h4>
                            </div>
                            <div id="menu" class="col-lg-6 col-md-6 col-sm-6 col-xs-6  {{ App::currentLocale() == 'ar' ? 'text-left' : 'text-right' }}">
                                <a rel="tooltip" class="" href="{{ route('purchases.create') }}" title="Edit">
                                    <i class="material-icons text-success">&#xe89c;</i>
                                </a>
                                <a rel="tooltip" class="" href="#" id="edit" name="edit"
                                    title="Edit">
                                    <i class="material-icons">&#xe22b;</i>
                                    {{-- xe3c9 --}}
                                </a>
                                <a rel="tooltip" id="delete" name="delete" class=" pd-setting-ed" href="#"
                                    data-url="" data-purchase_name="" data-original-title="" title="Delete"
                                    data-toggle="modal" data-target="#DangerModalhdbgcl" style="">
                                    <i class="material-icons" style="color:red;" aria-hidden="true">&#xe92b;</i>
                                </a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="main_datatable" class="table table-striped table-bordered no-wrap">
                                <thead>
                                    <tr>
                                        <th>{{ __('Id') }}</th>
                                        <th>{{ __('Date') }}</th>
                                        <th>{{ __('Type') }}</th>
                                        <th>{{ __('Total Amount') }}</th>
                                        <th>{{ __('User') }}</th>
                                        <th>{{ __('Store') }}</th>
                                        <th>{{ __('Customer') }}</th>
                                        <th>{{ __('Status') }}</th>
                                        {{-- <th>{{ __('Action') }}</th> --}}
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($purchases as $purchase)
                                        <tr id="{{ $purchase->id }}">
                                            <td>{{ $purchase->id }}</td>
                                            <td id="purchaseDate">{{ $purchase->date }}</td>
                                            <td>{{ __($purchase->type) }}</td>
                                            <td id="purchaseTotal">{{ $purchase->total_amount }}</td>
                                            <td>{{ $purchase->user->name }}</td>
                                            <td>{{ $purchase->store->name }}</td>
                                            <td>{{ $purchase->customer?->name }}</td>
                                            <td id="status"><button
                                                    class="btn {{ $purchase->status == 'Completed' ? 'btn-success' : 'btn-danger' }}"
                                                    style="width:100px;border-radius:5px;font-size: 14px;padding:0px;padding-right:5px;padding-left:5px;">
                                                    {{ __($purchase->status) }}</button>
                                            </td>
                                            {{-- <td class="datatable-ct">
                                                @can('update', App\Models\Purchase::class)
                                                <a rel="tooltip" class="" href="{{ route('purchases.edit',$purchase->id) }}" data-original-title="" title="Edit">
                                                    <i class="fa fa-pencil-square-o fa-lg warning"></i>
                                                </a>
                                                @endcan
                                                @can('delete', App\Models\Purchase::class)
                                                <a rel="tooltip" class=" pd-setting-ed" href="#" data-url="{{ route('purchases.destroy',$purchase->id) }}"
                                                data-purchase_name="{{ $purchase->name }}" data-original-title="" title="Delete" data-toggle="modal"
                                                data-target="#DangerModalhdbgcl" style="">
                                                    <i class="fa fa-trash fa-lg" style="color:red;" aria-hidden="true"></i>
                                                </a>
                                                @endcan
                                            </td> --}}
                                            @can('view-company', App\Models\purchase::class)
                                                <td>{{ $purchase->company->name }}</td>
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
                                            <th>{{ __('Price') }}</th>
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


        <!-- purchase details-->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ __('Purchase Details') }}</h4>
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>{{ __('Date') }}</label>
                                        <input type="date" class="form-control" id="date" name="date"
                                            placeholder="dd-mm-yyyy" required readonly>
                                    </div>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-right">
                                    <div class="form-group">
                                        <label>{{ __('Total') }}</label>
                                        <input type="text" class="form-control text-right" id="total" name="total"
                                            value="00,00DA" required readonly>
                                    </div>
                                    {{-- <div class="">
                                            {{ __('Total: ') }} <span id="total"></span>
                                        </div> --}}
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                    <h4 class="card-title">{{ __('Products List') }}</h4>
                                </div>
                            </div>

                            <div class="table-responsive">
                                <table id="purchase_table" class="table table-striped table-bordered no-wrap"
                                    style="table-layout: fixed">
                                    <thead>
                                        <tr>
                                            <th style="width: 15px">{{ __('N°') }}</th>
                                            <th style="width: 160px">{{ __('SKU') }}</th>
                                            <th style="width: 100px">{{ __('Price') }}</th>
                                            <th style="width: 100px">{{ __('Quantity') }}</th>
                                            <th style="width: 300px">{{ __('Product Details') }}</th>
                                            <th style="width: 100px">{{ __('Total') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody id='tbody'>
                                    </tbody>
                                    <!-- <tfoot>
                                            <tr>
                                                <th>{{ __('Id') }}</th>
                                                <th>{{ __('Name') }}</th>
                                                <th>{{ __('SKU') }}</th>
                                                <th>{{ __('Image') }}</th>
                                                <th>{{ __('Price') }}</th>
                                                <th>{{ __('Price') }}</th>
                                                <th>{{ __('Category') }}</th>
                                                <th>{{ __('Brand') }}</th>
                                                <th>{{ __('Active') }}</th>
                                                <th>{{ __('Action') }}</th>
                                            </tr>
                                        </tfoot> -->
                                </table>
                            </div>
                        </div>
                        {{-- <div class="form-actions">
                                <div class="text-right">
                                    {{ __('Total: ') }} <span id="total">00,00</span>DA
                                </div>
                            </div> --}}
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
                    <h5 class="modal-title" id="exampleModalLabel">{{ __("Delete Purchase") }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <span aria-hidden="true">{{ __("Would you like to delete this item") }}</span><br />
                    {{ __("Purchase Id: ") }}<strong><span id='purchaseId'></span><br /></strong>
                    {{ __("Total Amount: ") }}<strong><span id='purchaseTotal'></span><br /></strong>
                    {{ __("Purchase Date: ") }}<strong><span id='purchaseDate'></span></strong>
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

        var purchase_table = $('#purchase_table').DataTable();
        $('#main_datatable tbody').on('click', 'tr', function() {
            if ($(this).hasClass('selected')) {
                $(this).removeClass('selected');
            } else {
                main_datatable_table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }

            var selectedPurchaseId = $(this).attr('id');
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: "/getpurchasedetails/" + selectedPurchaseId,
                type: "GET",
                success: function(data) {
                    document.getElementById('date').valueAsDate = new Date(data.purchase.date);
                    // products_table.clear().draw();
                    var rows = purchase_table.rows().remove().draw();
                    $(".dataTables_empty").closest('tr').hide();
                    var rowIdx = 0,
                        total = 0;
                    $.each(data.purchase_items, function(index, purchase_item) {
                        $('#tbody').append(`<tr id="${++rowIdx}">
                                                <td>${rowIdx}</td>
                                                <td>${purchase_item.product_sku}</td>
                                                <td>${purchase_item.price}</td>
                                                <td>${purchase_item.quantity}</td>
                                                <td>{{__('Product Name: ')}}${purchase_item.product_name}, {{__('Price: ')}}${purchase_item.product_price}</td>
                                                <td>${purchase_item.total_amount}</td>
                                                </tr>`);
                        total += parseInt(purchase_item.total_amount);
                    })
                    $("#total").val(total+'{{" ".__("DA")}}');
                }
            })
        });

        $('#delete').click(function(e) {
            e.preventDefault();
            var id = main_datatable_table.row( '.selected' ).id();
            if (id){
                $('#deleteModal #purchaseId').text(id);
                $('#deleteModal #purchaseDate').text($("#"+id+" #purchaseDate").text());
                $('#deleteModal #purchaseTotal').text($("#"+id+" #purchaseTotal").text());
                $('#deleteModal').modal('toggle');
            }
        });
        $('#edit').click(function(e) {
            e.preventDefault();
            var id = main_datatable_table.row( '.selected' ).id();
            window.location.href = '/purchases/'+id+'/edit';
        });

        $("#Confirm").click(function(e) {
            e.preventDefault();
            var id = main_datatable_table.row( '.selected' ).id();
            var url = "{{ route('purchases.destroy', 'id') }}".replace('id', id);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                type: 'DELETE',
                success: function(result) {
                    if(result.done){
                        var res = main_datatable_table.row( '.selected' ).remove().draw();
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
        });
    </script>
@endpush

@extends('layouts.main')
@Push('css')



<link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.3.3/css/rowReorder.dataTables.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css" />

    <style>
        #addCustomer {
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
                            <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                <h4 class="card-title">{{ __('Customers List') }}</h4>
                            </div>
                            <div id="menu" class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-right">
                                <a rel="tooltip" class="" href="{{ route('customers.create') }}" title="Edit">
                                    <i class="material-icons text-success">&#xe89c;</i>
                                </a>
                                <a rel="tooltip" class="" href="#" id="edit" name="edit"
                                    title="Edit">
                                    <i class="material-icons">&#xe22b;</i>
                                    {{-- xe3c9 --}}
                                </a>
                                <a rel="tooltip" id="delete" name="delete" class=" pd-setting-ed" href="#"
                                    data-url="" data-customer_name="" data-original-title="" title="Delete"
                                    data-toggle="modal" data-target="#DangerModalhdbgcl" style="">
                                    <i class="material-icons" style="color:red;" aria-hidden="true">&#xe92b;</i>
                                </a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table id="zero_config_customer" class="table table-striped table-bordered no-wrap">
                                <thead>
                                    <tr>
                                        <th>{{ __('Id') }}</th>
                                        <th>{{ __('Name') }}</th>
                                        <th>{{ __('Email') }}</th>
                                        <th>{{ __('Mobile') }}</th>
                                        <th>{{ __('City') }}</th>
                                        <th>{{ __('State') }}</th>
                                        <th>{{ __('Address') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($customers as $customer)
                                        <tr id="{{ $customer->id }}">
                                            <td>{{ $customer->id }}</td>
                                            <td id="customerName">{{ $customer->name }}</td>
                                            <td>{{ $customer->email }}</td>
                                            <td>{{ $customer->mobile }}</td>
                                            <td id="customerCity">{{ $customer->city->name }}</td>
                                            <td>{{ $customer->city->state->name }}</td>
                                            <td>{{ $customer->address }}</td>
                                            @can('view-company', App\Models\customer::class)
                                                <td>{{ $customer->company->name }}</td>
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
                    <h5 class="modal-title" id="exampleModalLabel">{{ __("Delete Customer") }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <span aria-hidden="true">{{ __("Would you like to delete this item") }}</span><br />
                    {{ __("Customer Id: ") }}<strong><span id='customerId'></span></strong><br />
                    {{ __("Name: ") }}<strong><span id='customerName'></span></strong><br />
                    {{ __("City: ") }}<strong><span id='customerCity'></span></strong>
                </div>
                <div class="modal-footer">
                    <button type="button" id='cancel' name='cancel' class="btn btn-success" data-dismiss="modal">{{ __("Cancel") }}</button>
                    <button type="button" id='confim' name='confim' class="btn btn-danger">{{ __("Confim") }}</button>
                </div>
            </div>
        </div>
    </div>

@endsection

@Push('js')
<script src="https://cdn.datatables.net/rowreorder/1.3.3/js/dataTables.rowReorder.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>




    <script type="text/javascript">
    var zero_config_customer_table = $('#zero_config_customer').DataTable( {
        // rowReorder: {
        //     selector: 'td:nth-child(2)'
        // },
        // responsive: true
    } );

        var table = $('#customer_table').DataTable();
        $('#zero_config_customer tbody').on('click', 'tr', function() {
            if ($(this).hasClass('selected')) {
                $(this).removeClass('selected');
            } else {
                zero_config_customer_table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }

            // var selectedCustomerId = $(this).attr('id');
            // $.ajax({
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //     },
            //     url: "/getcustomerdetails/" + selectedCustomerId,
            //     type: "GET",
            //     success: function(data) {
            //         console.log(data);
            //         console.log(data.customer.date);
            //         document.getElementById('date').valueAsDate = new Date(data.customer.date);
            //         // customers_table.clear().draw();
            //         var rows = table.rows().remove().draw();
            //         $(".dataTables_empty").closest('tr').hide();
            //         var rowIdx = 0,
            //             total = 0;
            //         $.each(data.customer_items, function(index, customer_item) {
            //             $('#tbody').append(`<tr id="${++rowIdx}">
            //                                     <td>${rowIdx}</td>
            //                                     <td>${customer_item.customer_sku}</td>
            //                                     <td>${customer_item.price}</td>
            //                                     <td>${customer_item.quantity}</td>
            //                                     <td>Customer Name: ${customer_item.customer_name}, Price: ${customer_item.customer_price}</td>
            //                                     <td>${customer_item.total_amount}</td>
            //                                     </tr>`);
            //             total += parseInt(customer_item.total_amount);
            //         })
            //         $("#total").val(total+'{{" ".__("DA")}}');
            //     }
            // })
        });

        $('#delete').click(function(e) {
            e.preventDefault();
            var id = zero_config_customer_table.row( '.selected' ).id();
            if (id){
                $('#deleteModal #customerId').text(id);
                $('#deleteModal #customerName').text($("#"+id+" #customerName").text());
                $('#deleteModal #customerCity').text($("#"+id+" #customerCity").text());
                $('#deleteModal').modal('toggle');
            }
        });
        $('#edit').click(function(e) {
            e.preventDefault();
            var id = zero_config_customer_table.row( '.selected' ).id();
            window.location.href = '/customers/'+id+'/edit';
        });

        $("#confim").click(function(e) {
            e.preventDefault();
            var id = zero_config_customer_table.row( '.selected' ).id();
            var url = "{{ route('customers.destroy', 'id') }}".replace('id', id);
            console.log(url);
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: url,
                type: 'DELETE',
                success: function(result) {
                    if(result.done){
                        var res = zero_config_customer_table.row( '.selected' ).remove().draw();
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
    </script>
@endpush

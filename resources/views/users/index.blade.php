@extends('layouts.main')
@Push('css')



<link rel="stylesheet" href="https://cdn.datatables.net/rowreorder/1.3.3/css/rowReorder.dataTables.min.css" />
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.4.1/css/responsive.dataTables.min.css" />

    <style>
        #addUser {
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
                                <h4 class="card-title">{{ __('Users List') }}</h4>
                            </div>
                            <div id="menu" class="col-lg-6 col-md-6 col-sm-6 col-xs-6  {{ App::currentLocale() == 'ar' ? 'text-left' : 'text-right' }}">
                                <a rel="tooltip" class="" href="{{ route('users.create') }}" title="Edit">
                                    <i class="material-icons text-success">&#xe89c;</i>
                                </a>
                                <a rel="tooltip" class="" href="#" id="edit" name="edit"
                                    title="Edit">
                                    <i class="material-icons">&#xe22b;</i>
                                    {{-- xe3c9 --}}
                                </a>
                                <a rel="tooltip" id="delete" name="delete" class=" pd-setting-ed" href="#"
                                    data-url="" data-user_name="" data-original-title="" title="Delete"
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
                                        <th>{{ __('Name') }}</th>
                                        <th>{{ __('Email') }}</th>
                                        <th>{{ __('Role') }}</th>
                                        <th>{{ __('Store') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($users as $user)
                                        <tr id="{{ $user->id }}">
                                            <td>{{ $user->id }}</td>
                                            <td id="userName">{{ $user->name }}</td>
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
                                            <td id="userStore">{{ $user->store?->name }}</td>
                                            @can('view-company', App\Models\user::class)
                                                <td>{{ $user->company->name }}</td>
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
                    <h5 class="modal-title" id="exampleModalLabel">{{ __("Delete User") }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    </button>
                </div>
                <div class="modal-body">
                    <span aria-hidden="true">{{ __("Would you like to delete this item") }}</span><br />
                    {{ __("User Id: ") }}<strong><span id='userId'></span></strong><br />
                    {{ __("Name: ") }}<strong><span id='userName'></span></strong><br />
                    {{ __("Store: ") }}<strong><span id='userStore'></span></strong>
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

        var table = $('#user_table').DataTable();
        $('#main_datatable tbody').on('click', 'tr', function() {
            if ($(this).hasClass('selected')) {
                $(this).removeClass('selected');
            } else {
                main_datatable_table.$('tr.selected').removeClass('selected');
                $(this).addClass('selected');
            }

            // var selectedUserId = $(this).attr('id');
            // $.ajax({
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //     },
            //     url: "/getuserdetails/" + selectedUserId,
            //     type: "GET",
            //     success: function(data) {
            //         console.log(data);
            //         console.log(data.user.date);
            //         document.getElementById('date').valueAsDate = new Date(data.user.date);
            //         // users_table.clear().draw();
            //         var rows = table.rows().remove().draw();
            //         $(".dataTables_empty").closest('tr').hide();
            //         var rowIdx = 0,
            //             total = 0;
            //         $.each(data.user_items, function(index, user_item) {
            //             $('#tbody').append(`<tr id="${++rowIdx}">
            //                                     <td>${rowIdx}</td>
            //                                     <td>${user_item.user_sku}</td>
            //                                     <td>${user_item.price}</td>
            //                                     <td>${user_item.quantity}</td>
            //                                     <td>User Name: ${user_item.user_name}, Price: ${user_item.user_price}</td>
            //                                     <td>${user_item.total_amount}</td>
            //                                     </tr>`);
            //             total += parseInt(user_item.total_amount);
            //         })
            //         $("#total").val(total+'{{" ".__("DA")}}');
            //     }
            // })
        });

        $('#delete').click(function(e) {
            e.preventDefault();
            var id = main_datatable_table.row( '.selected' ).id();
            if (id){
                $('#deleteModal #userId').text(id);
                $('#deleteModal #userName').text($("#"+id+" #userName").text());
                $('#deleteModal #userStore').text($("#"+id+" #userStore").text());
                $('#deleteModal').modal('toggle');
            }
        });
        $('#edit').click(function(e) {
            e.preventDefault();
            var id = main_datatable_table.row( '.selected' ).id();
            window.location.href = '/users/'+id+'/edit';
        });

        $("#Confirm").click(function(e) {
            e.preventDefault();
            var id = main_datatable_table.row( '.selected' ).id();
            var url = "{{ route('users.destroy', 'id') }}".replace('id', id);
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

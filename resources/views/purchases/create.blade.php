@extends('layouts.main')


@Push('css')
<style>
    .error {
        color: #FF0000;
    }

    .warning {
        color: red;
    }

    input.error {
        border: 1px solid red !important;
    }

    tbody>tr {
        height: 40px !important;
    }

    tbody tr {
        min-height: 35px !important;
    }

    .form-control {
        margin: -8px !important;
    }

    .input-group,
    td input {
        /* margin-top: +2px !important; */
    }

    .input-group {
        margin-bottom: -8px !important;
    }

    td button {
        margin: -8px;
        margin-left: +8px !important;
    }
</style>
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
@endpush

@section('content')
<div class="basic-form-area mg-b-15">
    <div class="container-fluid">
        {{-- <div id="reader" width="600px"></div> --}}
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ __('Add New Purchases') }}</h4>
                        <form class="form-sample" method="post" action="{{ route('purchases.store') }}">
                            @csrf
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ __('Date') }}</label>
                                            <input type="date" class="form-control" id="date" name="date" placeholder="dd-mm-yyyy" required>
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ __('Customer') }}</label>
                                    <input type="text" class="form-control" id="customer" name="customer" placeholder="{{ __('Customer') }}">
                                </div>
                            </div> --}}
                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <h4 class="card-title">{{ __('Products List') }}</h4>
                        </div>
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                            <button id="addProduct" type="button" class="btn btn-success btn-rounded {{ App()->currentLocale() == 'ar' ? 'float-left' : 'float-right' }}">
                                <i class="fas fa-plus-circle"></i>{{ __('New Product') }}</button>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table id="purchase_table" class="table table-striped table-bordered no-wrap" style="table-layout: fixed">
                            <thead>
                                <tr>
                                    <th style="width: 15px">{{ __('N°') }}</th>
                                    <th style="width: 160px">{{ __('SKU') }}</th>
                                    <th style="width: 100px">{{ __('Price') }}</th>
                                    <th style="width: 100px">{{ __('Quantity') }}</th>
                                    <th style="width: 300px">{{ __('Product Details') }}</th>
                                    <th style="width: 100px">{{ __('Total') }}</th>
                                    <th>{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody id='tbody'>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="form-actions">
                    <div class="text-right" style="font-weight: bold;">
                        {{ __('Total: ') }} <span id="total">00,00 DA</span>
                    </div>
                </div>
                <div class="form-actions">
                    <div class="text-center">

                        <button type="submit" id="save" name="save"
                                          class="btn btn-success">{{ __('Save') }}</button>

                                        <button type="submit" id="saveAndClose" name="saveAndClose"
                                          class="btn btn-info">{{ __('Save And Close') }}</button>

                        <a href="{{ route('purchases.index') }}">
                            <button type="button" class="btn btn-dark">{{ __('Cancel') }}</button>
                        </a>
                    </div>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

</div>
</div>
<div class="modal fade" id="scanBareCodeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __("Scan the barcode") }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                </button>
            </div>
            <div class="modal-body">
                <span aria-hidden="true">{{ __("Put the camera in the correct position") }}</span><br />
                <div id="reader" width="600px"></div>
                {{ __("Product SKU: ") }}<strong><span id='productSKU'></span><br /></strong>
            </div>
            <div class="modal-footer">
                <button type="button" id='cancel' name='cancel' class="btn btn-success" data-dismiss="modal">{{ __("Close") }}</button>
            </div>
        </div>
    </div>
</div>

@endsection

@Push('js')
<script src="{{ URL::asset('assets/libs/jquery/dist/jquery.validate.min.js') }}"></script>
<script src="{{ URL::asset('dist/js/html5-qrcode.min.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function() {

        var currentId = 1;

        function onScanSuccess(decodedText, decodedResult) {
            $('#' + currentId + ' #SKU').val(decodedText);
            $('#scanBareCodeModal #productSKU').text(decodedText);
            $('#scanBareCodeModal').modal('hide');
        }

        var html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", {
                fps: 10,
                qrbox: {
                    width: 250,
                    height: 250,
                }
            });
        html5QrcodeScanner.render(onScanSuccess);

        $(document).on("click", "#scanBareCode", function(e) {
            e.preventDefault();
            $('#scanBareCodeModal').modal('show');
            var child = $(this).closest('tr').nextAll();

            var row = $(this).closest('tr');
            currentId = row.attr('id');
        });

        /****************************************
         *          Create Sale Table           *
         ****************************************/
        // var products_table = $('#purchase_table').DataTable({
        //     "autoWidth": false,
        //     "searching": false,
        //     "paging": false,
        //     "info": false
        // });

        // Denotes total number of rows.
        document.getElementById('date').valueAsDate = new Date();

        var rowIdx = 0;
        var total = 0;

        // jQuery button click event to add a row.
        $('#addProduct').on('click', function() {

            $(".dataTables_empty").closest('tr').hide();
            $('#tbody').append(`<tr id="R${++rowIdx}">
                <td>${rowIdx}</td>
                <td>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" id="SKU" name="SKU" placeholder="رقم الكود"
                        aria-label="${"{{ __('SKU') }}"}" aria-describedby="basic-addon2" required>
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" id="scanBareCode" type="button"  data-toggle="modal" data-target="#exampleModal">
                            <i class="fas fa-barcode"></i></button>
                        </div>
                    </div>
                </td>
                <td>
                    <input type="text" class="form-control" id="price" name="price" placeholder="الثمن دج"
                    aria-label="{{ __('Price') }}" aria-describedby="basic-addon2" required>
                </td>
                <td>
                    <input type="text" class="form-control" id="quantity" name="quantity" placeholder="الكمية"
                    aria-label="{{ __('Quantity') }}" aria-describedby="basic-addon2" required value="1">
                </td>
                <td id="product_details"></td>
                <td class="text-success"><span class="product_total"></span>DA</td>
                <td class="datatable-ct">
                    <a rel="tooltip" class="remove pd-setting-ed" href="#" data-url=""
                    data-purchase_name="    " data-original-title="" title="Delete" data-toggle="modal"
                    data-target="#DangerModalhdbgcl" style="">
                        <i class="fa fa-trash fa-lg" style="color:red;" aria-hidden="true"></i>
                    </a>
                </td>
                </tr>`);


            //setup before functions
            var typingTimer; //timer identifier
            var doneTypingInterval = 1000; //time in ms, 5 seconds for example



            var $input = document.querySelectorAll('#R' + rowIdx + ' #SKU');
            //on keyup, start the countdown
            var child;
            $input[0].addEventListener('keyup', function(event) {
                child = $(this).closest('tr'); //.nextAll();
                // $input.on('keyup', function () {
                clearTimeout(typingTimer);
                typingTimer = setTimeout(doneTyping, doneTypingInterval);
            });
            //on keydown, clear the countdown
            $input[0].addEventListener('keydown', function(event) {
                // $input.on('keydown', function () {
                clearTimeout(typingTimer);
            });
            //user is "finished typing," do something
            function doneTyping() {
                //do something
                // var SKU = $('#R' + rowIdx + ' #SKU').val();
                var id = child.attr('id');
                var SKU = $("#" + id + ' #SKU').val();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "/getproductbysku/" + SKU,
                    type: "GET",
                    success: function(data) {
                        if (data.exist) {

                            var price = $("#" + id + ' #price').val();
                            if (!price) price = 0;
                            var quantity = $("#" + id + ' #quantity').val();
                            if (!quantity) quantity = 0;
                            var product_total = price * quantity;
                            var old_product_total = $("#" + id + " .product_total").text();
                            if (!old_product_total) old_product_total = '0';
                            total = total - parseInt(old_product_total) + product_total;
                            $("#" + id + " .product_total").text(`${product_total}`);
                            $("#total").text(total + " DA");
                            $("#" + id + " #product_details").text(
                                `{{__('Product Name: ')}}${data.product.name_ar}, {{__('Price: ') }}${data.product.price}`
                            );
                        } else {
                            alert('{{__("This Product Not Exist and will not added") }}');
                        }
                    }
                })
            }

            //price
            var $input1 = document.querySelectorAll('#R' + rowIdx + ' #price');
            //on keyup, start the countdown
            var child1;
            $input1[0].addEventListener('keyup', function(event) {
                child1 = $(this).closest('tr'); //.nextAll();
                // $input.on('keyup', function () {
                clearTimeout(typingTimer);
                typingTimer = setTimeout(doneTyping1, doneTypingInterval);
            });
            //on keydown, clear the countdown
            $input1[0].addEventListener('keydown', function(event) {
                // $input.on('keydown', function () {
                clearTimeout(typingTimer);
            });
            //user is "finished typing," do something
            function doneTyping1() {
                //do something
                // var SKU = $('#R' + rowIdx + ' #SKU').val();
                var id = child1.attr('id');
                var SKU = $("#" + id + ' #SKU').val();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "/getproductbysku/" + SKU,
                    type: "GET",
                    success: function(data) {
                        if (data.exist) {

                            var price = $("#" + id + ' #price').val();
                            if (!price) price = 0;
                            var quantity = $("#" + id + ' #quantity').val();
                            if (!quantity) quantity = 0;
                            var product_total = price * quantity;
                            var old_product_total = $("#" + id + " .product_total").text();
                            if (!old_product_total) old_product_total = '0';
                            total = total - parseInt(old_product_total) + product_total;
                            $("#" + id + " .product_total").text(`${product_total}`);
                            $("#total").text(total + " DA");
                        } else {
                            alert('{{__("This Product Not Exist and will not added") }}');
                        }
                    }
                })
            }

            //Quantity
            var $input2 = document.querySelectorAll('#R' + rowIdx + ' #quantity');
            //on keyup, start the countdown
            var child2;
            $input2[0].addEventListener('keyup', function(event) {
                child2 = $(this).closest('tr'); //.nextAll();
                // $input.on('keyup', function () {
                clearTimeout(typingTimer);
                typingTimer = setTimeout(doneTyping2, doneTypingInterval);
            });
            //on keydown, clear the countdown
            $input2[0].addEventListener('keydown', function(event) {
                // $input.on('keydown', function () {
                clearTimeout(typingTimer);
            });
            //user is "finished typing," do something
            function doneTyping2() {
                //do something
                // var SKU = $('#R' + rowIdx + ' #SKU').val();
                var id = child2.attr('id');
                var SKU = $("#" + id + ' #SKU').val();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "/getproductbysku/" + SKU,
                    type: "GET",
                    success: function(data) {
                        if (data.exist) {

                            var price = $("#" + id + ' #price').val();
                            if (!price) price = 0;
                            var quantity = $("#" + id + ' #quantity').val();
                            if (!quantity) quantity = 0;
                            var product_total = price * quantity;
                            var old_product_total = $("#" + id + " .product_total").text();
                            if (!old_product_total) old_product_total = '0';
                            total = total - parseInt(old_product_total) + product_total;
                            $("#" + id + " .product_total").text(`${product_total}`);
                            $("#total").text(total + " DA");
                        } else {
                            alert('{{__("This Product Not Exist and will not added") }}');
                        }
                    }
                })
            }
        });

        // jQuery button click event to remove a row
        $('#tbody').on('click', '.remove', function() {

            // Getting all the rows next to the
            // row containing the clicked button
            var child = $(this).closest('tr').nextAll();

            var row = $(this).closest('tr');
            var id = row.attr('id');
            var old_product_total = $("#" + id + " .product_total").text();
            total = total - parseInt(old_product_total);
            $("#total").text(total + " DA");

            // Iterating across all the rows
            // obtained to change the index
            child.each(function() {
                // Getting <tr> id.
                id = $(this).attr('id');

                // Getting the <p> inside the .row-index class.
                var idx = $(this).children('.row-index').children('p');
                // Gets the row number from <tr> id.
                var dig = parseInt(id.substring(1));
                // Modifying row index.
                idx.html(`Row ${dig - 1}`);
                // Modifying row id.
                $(this).attr('id', `R${dig - 1}`);
            });

            // Removing the current row.
            $(this).closest('tr').remove();

            // Decreasing the total number of rows by 1.
            rowIdx--;
        });

        $('.form-sample').submit(function(e) {
            e.preventDefault();

            var account_validator1 = $(".form-sample").validate({

                rules: {
                    date: {
                        required: true,
                    },
                },
                messages: {

                    date: {
                        required: "{{ __('Date is required') }}",
                    },
                },
            });

            // geting data
            var products = [];
            $("#purchase_table").find('tr').each(function(i, el) {
                var id = $(this).attr('id');
                //    var id = $(this).attr('id', `R${dig - 1}`);
                var SKU = $("#" + id + ' #SKU').val();
                var price = $("#" + id + ' #price').val();
                var quantity = $("#" + id + ' #quantity').val();
                if (SKU && quantity) {
                    products.push({
                        SKU: SKU,
                        price: price,
                        quantity: quantity,
                    });
                }
            });

            if (products.length>0){
                var formdata = false;
                formdata = new FormData();
                formdata.append("date", $('#date').val());
                // formdata.append("customer", $('#customer').val());
                formdata.append("products", JSON.stringify(products));
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    type: $(this).attr('method'),
                    url: $(this).attr('action'),
                    data: formdata,
                    cache: false,
                    processData: false,
                    contentType: false,
                    success: function(data) {
                        if (data.result == 'success') {
                            var btnClicked = e.originalEvent.submitter;
                                if (btnClicked.id == 'save'){
                                    window.location.href = data.url;
                                }
                                else if (btnClicked.id == 'saveAndClose'){
                                    window.location.href = data.url_close;
                                }
                        } else if (data.result == 'failed') {

                        }
                    },
                    error: function(data) {
                        var errors;
                        $(".login-link").addClass("show");
                        $(".login-link .nav-link").attr("aria-expanded", "true");
                        $("#login-form1").addClass("show");
                        if (data.result == 'failed') {
                            errors = data.errors;
                        } else {
                            errors = data.responseJSON.errors;
                        }

                        if (!$("#g-recaptcha-response").val()) {
                            $("#recaptcha1-error").text(
                                "{{ __('Captcha must be checked') }}");
                            $("#recaptcha1-error").attr("style", "display:block");
                        }

                        account_validator1.showErrors(errors);
                    }
                });
            }
        });

        $('input[type=file]').change(function(event) {
            var tmppath = URL.createObjectURL(event.target.files[0]);
            $("#showedImage").fadeIn("fast").attr('src', URL.createObjectURL(event.target.files[0]));
        });

    });
</script>
@endpush
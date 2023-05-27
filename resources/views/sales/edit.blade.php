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
            <!-- <div id="reader" width="600px"></div> -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">{{ __('Edit Sale #') . $sale->id }}</h4>
                            <form class="form-sample" method="POST" action="{{ route('sales.update', $sale->id) }}">
                                @csrf
                                @method('put')
                                <input hidden type="text" class="form-control" value="{{ $sale->id ?? '' }}"
                                    id="sale_id" name="sale_id">
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ __('Date') }}</label>
                                                <input type="date" class="form-control" id="date" name="date"
                                                    placeholder="dd-mm-yyyy" required>
                                            </div>
                                        </div>
                                        {{-- <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ __('Customer') }}</label>
                                                <input type="text" class="form-control" id="customer" name="customer"
                                                    placeholder="{{ __('Customer') }}">
                                            </div>
                                        </div> --}}
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                            <h4 class="card-title">{{ __('Products List') }}</h4>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                            <button id="addProduct" type="button"
                                                class="btn btn-success btn-rounded float-right">
                                                <i class="fas fa-plus-circle"></i>{{ __('New Product') }}</button>
                                        </div>
                                    </div>

                                    <div class="table-responsive">
                                        <table id="sale_table" class="table table-striped table-bordered no-wrap"
                                            style="table-layout: fixed">
                                            <thead>
                                                <tr>
                                                    <th style="width: 15px">{{ __('N°') }}</th>
                                                    <th style="width: 160px">{{ __('SKU') }}</th>
                                                    <th style="width: 100px">{{ __('Discount') }}</th>
                                                    <th style="width: 100px">{{ __('Quantity') }}</th>
                                                    <th style="width: 300px">{{ __('Product Details') }}</th>
                                                    <th style="width: 100px">{{ __('Total') }}</th>
                                                    <th>{{ __('Actions') }}</th>
                                                </tr>
                                            </thead>
                                            <tbody id='tbody'>

                                                @if (isset($sale))
                                                    @foreach ($sale->saleItems as $count => $saleItem)
                                                        {{ ++$count }}
                                                        <tr id="R{{ $count }}">
                                                            <td>{{ $count }}</td>
                                                            <td>
                                                                <div class="input-group mb-3">
                                                                    <input type="text" class="form-control"
                                                                        id="SKU" name="SKU"
                                                                        placeholder="رقم الكود"
                                                                        aria-label="{{ __('SKU') }}"
                                                                        aria-describedby="basic-addon2" required
                                                                        value="{{ $saleItem->product_sku }}">
                                                                    <div class="input-group-append">
                                                                        <button class="btn btn-outline-secondary"
                                                                            type="button" data-toggle="modal"
                                                                            data-target="#exampleModal">
                                                                            <i class="fas fa-barcode"></i></button>
                                                                    </div>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control" id="discount"
                                                                    name="discount" placeholder="التخفيض دج"
                                                                    aria-label="{{ __('Discount') }}"
                                                                    aria-describedby="basic-addon2"
                                                                    value="{{ $saleItem->discount }}" required>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control" id="quantity"
                                                                    name="quantity" placeholder="الكمية"
                                                                    aria-label="{{ __('Quantity') }}"
                                                                    aria-describedby="basic-addon2" required
                                                                    value="{{ $saleItem->quantity }}">
                                                            </td>
                                                            <td id="product_details">
                                                                {{ __('Product Name: ') . $saleItem->product_name . ', '.__('Price: ') . $saleItem->product_price }}
                                                            </td>
                                                            <td class="text-success"><span
                                                                    class="product_total">{{ $saleItem->total_amount }}</span>DA
                                                            </td>
                                                            <td class="datatable-ct">
                                                                <a rel="tooltip" class="remove pd-setting-ed"
                                                                    href="#" data-url="" data-sale_name="    "
                                                                    data-original-title="" title="Delete"
                                                                    data-toggle="modal" data-target="#DangerModalhdbgcl"
                                                                    style="">
                                                                    <i class="fa fa-trash fa-lg" style="color:red;"
                                                                        aria-hidden="true"></i>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <div class="text-right">
                                        {{ __('Total: ') }} <span id="total">{{ $sale->total_amount }}</span> {{__('DA')}}
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <div class="text-center">
                                        <button type="submit" id="save" name="save"
                                            class="btn btn-info">{{ __('Save') }}</button>

                                        <a href="{{ route('sales.index') }}">
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

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
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
            // Denotes total number of rows.
            document.getElementById('date').valueAsDate = new Date('{{ $sale->date }}');

            // table.rows().every( function ( rowIdx, tableLoop, rowLoop ) {
            //     var id = this.attr('id');
            // ... do something with data(), or this.node(), etc


            // //setup before functions
            // var typingTimer; //timer identifier
            // var doneTypingInterval = 1000; //time in ms, 5 seconds for example

            // var $input = document.querySelectorAll('#R' + rowIdx + ' #SKU');
            // //on keyup, start the countdown
            // var child;
            // $input[0].addEventListener('keyup', function(event) {
            //     child = $(this).closest('tr'); //.nextAll();
            //     // $input.on('keyup', function () {
            //     clearTimeout(typingTimer);
            //     typingTimer = setTimeout(doneTyping, doneTypingInterval);
            // });
            // //on keydown, clear the countdown
            // $input[0].addEventListener('keydown', function(event) {
            //     // $input.on('keydown', function () {
            //     clearTimeout(typingTimer);
            // });
            // //user is "finished typing," do something
            // function doneTyping() {
            //     //do something
            //     // var SKU = $('#R' + rowIdx + ' #SKU').val();
            //     var id = child.attr('id');
            //     var SKU = $("#" + id + ' #SKU').val();
            //     $.ajax({
            //         headers: {
            //             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //         },
            //         url: "/getproductbysku/" + SKU,
            //         type: "GET",
            //         success: function(data) {
            //             if (data.exist) {

            //                 var discount = $("#" + id + ' #discount').val();
            //                 if (!discount) discount = 0;
            //                 var quantity = $("#" + id + ' #quantity').val();
            //                 if (!quantity) quantity = 0;
            //                 var product_total = (data.product.price - discount) * quantity;
            //                 var old_product_total = $("#" + id + " .product_total").text();
            //                 if (!old_product_total) old_product_total = '0';
            //                 total = total - parseInt(old_product_total) + product_total;
            //                 $("#" + id + " .product_total").text(`${product_total}`);
            //                 $("#total").text(total + " DA");
            //                 $("#" + id + " #product_details").text(
            //                     `Product Name: ${data.product.name_ar}, Price: ${data.product.price}`
            //                 );
            //             } else {
            //                 alert('This Product Not Exist and will not added');
            //             }
            //         }
            //     })
            // }
            // });


            var rowIdx = parseInt("{{ $sale->sale_items_count }}");
            var total = parseInt("{{ $sale->total_amount }}");
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
                            <button class="btn btn-outline-secondary" type="button"  data-toggle="modal" data-target="#exampleModal">
                            <i class="fas fa-barcode"></i></button>
                        </div>
                    </div>
                </td>
                <td>
                    <input type="text" class="form-control" id="discount" name="discount" placeholder="التخفيض دج"
                    aria-label="{{ __('Discount') }}" aria-describedby="basic-addon2" required>
                </td>
                <td>
                    <input type="text" class="form-control" id="quantity" name="quantity" placeholder="الكمية"
                    aria-label="{{ __('Quantity') }}" aria-describedby="basic-addon2" required value="1">
                </td>
                <td id="product_details"></td>
                <td class="text-success"><span class="product_total"></span>DA</td>
                <td class="datatable-ct">
                    <a rel="tooltip" class="remove pd-setting-ed" href="#" data-url=""
                    data-sale_name="    " data-original-title="" title="Delete" data-toggle="modal"
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

                                var discount = $("#" + id + ' #discount').val();
                                if (!discount) discount = 0;
                                var quantity = $("#" + id + ' #quantity').val();
                                if (!quantity) quantity = 0;
                                var product_total = (data.product.price - discount) * quantity;
                                var old_product_total = $("#" + id + " .product_total").text();
                                if (!old_product_total) old_product_total = '0';
                                total = parseInt($("#total").text());
                                total = total - parseInt(old_product_total) + product_total;
                                $("#" + id + " .product_total").text(`${product_total}`);
                                $("#total").text(total + " DA");
                                $("#" + id + " #product_details").text(
                                    `{{__("Product Name: ")}}${data.product.name_ar}, {{__("Price: ")}}${data.product.price}`
                                );
                            } else {
                                alert('{{__("This Product Not Exist and will not added")}}');
                            }
                        }
                    })
                }

                //discount
                var $input1 = document.querySelectorAll('#R' + rowIdx + ' #discount');
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

                                var discount = $("#" + id + ' #discount').val();
                                if (!discount) discount = 0;
                                var quantity = $("#" + id + ' #quantity').val();
                                if (!quantity) quantity = 0;
                                var product_total = (data.product.price - discount) * quantity;
                                var old_product_total = $("#" + id + " .product_total").text();
                                if (!old_product_total) old_product_total = '0';
                                total = parseInt($("#total").text());
                                total = total - parseInt(old_product_total) + product_total;
                                $("#" + id + " .product_total").text(`${product_total}`);
                                $("#total").text(total + " DA");
                            } else {
                                alert('{{__("This Product Not Exist and will not added")}}');
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

                                var discount = $("#" + id + ' #discount').val();
                                if (!discount) discount = 0;
                                var quantity = $("#" + id + ' #quantity').val();
                                if (!quantity) quantity = 0;
                                var product_total = (data.product.price - discount) * quantity;
                                var old_product_total = $("#" + id + " .product_total").text();
                                if (!old_product_total) old_product_total = '0';
                                total = parseInt($("#total").text());
                                total = total - parseInt(old_product_total) + product_total;
                                $("#" + id + " .product_total").text(`${product_total}`);
                                $("#total").text(total + " DA");
                            } else {
                                alert('{{__("This Product Not Exist and will not added")}}');
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
                total = parseInt($("#total").text());
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
                $("#sale_table").find('tr').each(function(i, el) {
                    var id = $(this).attr('id');
                    //    var id = $(this).attr('id', `R${dig - 1}`);
                    var SKU = $("#" + id + ' #SKU').val();
                    var discount = $("#" + id + ' #discount').val();
                    var quantity = $("#" + id + ' #quantity').val();
                    if (SKU && quantity) {
                        products.push({
                            SKU: SKU,
                            discount: discount,
                            quantity: quantity,
                        });
                    }
                });

                // var formdata = false;
                // formdata = new FormData();
                // formdata.append();
                // formdata.append("customer", $('#customer').val());
                // formdata.append("sale_id", $('#sale_id').val());
                // formdata.append("products", JSON.stringify(products));
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        "Access-Control-Allow-Methods": "GET, POST, PATCH, PUT, DELETE"
                    },
                    // type: $(this).attr('method'),
                    type: 'PUT',
                    url: $(this).attr('action'),
                    data: {"sale_id":$('#sale_id').val(), "date": $('#date').val(), "products": JSON.stringify(products)},
                    // cache: false,
                    // processData: false,
                    // contentType: false,
                    success: function(data) {
                        if (data.result == 'success') {
                            // console.log(data);
                            window.location.href = data.url;
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
            });

            $('input[type=file]').change(function(event) {
                var tmppath = URL.createObjectURL(event.target.files[0]);
                $("#showedImage").fadeIn("fast").attr('src', URL.createObjectURL(event.target.files[0]));
            });

            function onScanSuccess(decodedText, decodedResult) {
                // Handle on success condition with the decoded text or result.
                console.log(`Scan result: ${decodedText}`, decodedResult);
            }

            var html5QrcodeScanner = new Html5QrcodeScanner(
                "reader", {
                    fps: 10,
                    qrbox: 250
                });
            html5QrcodeScanner.render(onScanSuccess);

            // $.validator.addMethod("formatcheck", function(value, element, regexp) {
            //     /* Check if the value is truthy (avoid null.constructor) & if it's not a RegEx. (Edited: regex --> regexp)*/
            //     if (regexp && regexp.constructor != RegExp) {
            //         /* Create a new regular expression using the regex argument. */
            //         regexp = new RegExp(regexp);
            //     }
            //     /* Check whether the argument is global and, if so set its last index to 0. */
            //     else if (regexp.global) regexp.lastIndex = 0;
            //     /* Return whether the element is optional or the result of the validation. */
            //     return this.optional(element) || regexp.test(value);
            // });

            // var account_validator = $(".form-sample").validate({
            //     rules: {
            //         hs_code: {
            //             // required: true,
            //             formatcheck: '[0-9]{2}.[0-9]{4}.[0-9]{4}',
            //         },
            //     },
            //     messages: {
            //         hs_code: {
            //             // required: " __('This field is required.') }}",
            //             formatcheck: "{{ __('Incorrect Format') }}",
            //         },
            //     },
            // });

        });

        window.addEventListener('load', function() {
            // document.getElementById("id1").addEventListener("click", click_handler1, false);
            // document.getElementById("id2").addEventListener("click", click_handler2, false);
            $("#sale_table").find('tr').each(function(i, el) {
                var id = $(this).attr('id');
                if (id) {
                    console.log("id=" + id);
                    //setup before functions
                    var typingTimer; //timer identifier
                    var doneTypingInterval = 1000; //time in ms, 5 seconds for example

                    var $input = document.querySelectorAll('#' + id + ' #SKU');
                    console.log($input);
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
                        // var SKU = $('#R' + rowIdx + ' #SKU').val()
                        console.log('hi');
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

                                    var discount = $("#" + id + ' #discount').val();
                                    if (!discount) discount = 0;
                                    var quantity = $("#" + id + ' #quantity').val();
                                    if (!quantity) quantity = 0;
                                    var product_total = (data.product.price - discount) *
                                        quantity;
                                    var old_product_total = $("#" + id + " .product_total")
                                        .text();
                                    if (!old_product_total) old_product_total = '0';
                                    total = parseInt($("#total").text());
                                    total = total - parseInt(old_product_total) + product_total;
                                    $("#" + id + " .product_total").text(`${product_total}`);
                                    $("#total").text(total + " DA");
                                    $("#" + id + " #product_details").text(
                                        `{{__("Product Name: ")}}${data.product.name_ar}, {{__("Price: ")}}${data.product.price}`
                                    );
                                } else {
                                    alert('{{__("This Product Not Exist and will not added")}}');
                                }
                            }
                        })
                    }

                    //discount
                    var $input1 = document.querySelectorAll('#' + id + ' #discount');
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

                                    var discount = $("#" + id + ' #discount').val();
                                    if (!discount) discount = 0;
                                    var quantity = $("#" + id + ' #quantity').val();
                                    if (!quantity) quantity = 0;
                                    var product_total = (data.product.price - discount) *
                                        quantity;
                                    var old_product_total = $("#" + id + " .product_total")
                                        .text();
                                    if (!old_product_total) old_product_total = '0';
                                    total = parseInt($("#total").text());
                                    total = total - parseInt(old_product_total) + product_total;
                                    $("#" + id + " .product_total").text(`${product_total}`);
                                    $("#total").text(total + " DA");
                                } else {
                                    alert('{{__("This Product Not Exist and will not added")}}');
                                }
                            }
                        })
                    }

                    //Quantity
                    var $input2 = document.querySelectorAll('#' + id + ' #quantity');
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

                                    var discount = $("#" + id + ' #discount').val();
                                    if (!discount) discount = 0;
                                    var quantity = $("#" + id + ' #quantity').val();
                                    if (!quantity) quantity = 0;
                                    var product_total = (data.product.price - discount) * quantity;
                                    var old_product_total = $("#" + id + " .product_total").text();
                                    if (!old_product_total) old_product_total = 0;
                                    total = parseInt($("#total").text());
                                    total = total - parseInt(old_product_total) + product_total;
                                    $("#" + id + " .product_total").text(`${product_total}`);
                                    $("#total").text(total + " DA");
                                } else {
                                    alert('{{__("This Product Not Exist and will not added")}}');
                                }
                            }
                        })
                    }


                }

            });
        });
    </script>
@endpush

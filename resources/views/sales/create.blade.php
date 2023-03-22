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
            margin: -10px !important;
        }

        .input-group {
            margin-bottom: -10px !important;
        }

        td button {
            margin: -10px;
            margin-left: +10px !important;
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
                            <h4 class="card-title">{{ __('Add New Sales') }}</h4>
                            <form class="form-sample" method="post" action="{{ route('sales.store') }}">
                                @csrf
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
                                                {{-- <tr>
                                        <td>1</td>
                                        <td>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" id="SKU" name="SKU" placeholder="{{ __('SKU') }}"
                                                aria-label="{{ __('SKU') }}" aria-describedby="basic-addon2" required>
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-secondary" type="button"><i class="fas fa-barcode"></i></button>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" id="discount" name="discount" placeholder="{{ __('Discount') }}"
                                            aria-label="{{ __('Discount') }}" aria-describedby="basic-addon2" required>
                                        </td>
                                        <td>
                                            <input type="text" class="form-control" id="quantity" name="quantity" placeholder="{{ __('Quantity') }}"
                                            aria-label="{{ __('Quantity') }}" aria-describedby="basic-addon2" required vlaue="1">
                                        </td>
                                        <td>Product 01, Price, Levis, shoes</td>
                                        <td>1500DA</td>
                                        <td class="datatable-ct">
                                            <a rel="tooltip" class="" href="" data-original-title="" title="Edit">
                                                <i class="fa fa-pencil-square-o fa-lg"></i>
                                            </a>
                                            <a rel="tooltip" class=" pd-setting-ed" href="#" data-url=""
                                            data-sale_name="    " data-original-title="" title="Delete" data-toggle="modal"
                                            data-target="#DangerModalhdbgcl" style="">
                                                <i class="fa fa-trash fa-lg" style="color:red;" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                    </tr> --}}

                                                @if (isset($products))
                                                    @foreach ($products as $product)
                                                        <tr id="{{ $product->id }}">
                                                            <td>{{ $product->id }}</td>
                                                            <td>{{ $product->SKU }}</td>
                                                            <td>{{ $product->name }}</td>
                                                            <td>{{ $product->price }}</td>
                                                            <td>{{ $product->discount }}</td>
                                                            <td>{{ $product->category->name }}</td>
                                                            <td>{{ $product->brand->name }}</td>
                                                            <td class="datatable-ct">
                                                                @can('update', App\Models\SaleItem::class)
                                                                    <a rel="tooltip" class=""
                                                                        href="{{ route('sales.edit', $sale->id) }}"
                                                                        data-original-title="" title="Edit">
                                                                        <i class="fa fa-pencil-square-o fa-lg warning"></i>
                                                                    </a>
                                                                @endcan
                                                                @can('delete', App\Models\SaleItem::class)
                                                                    <a rel="tooltip" class=" pd-setting-ed" href="#"
                                                                        data-url="{{ route('sales.destroy', $sale->id) }}"
                                                                        data-sale_name="{{ $sale->name }}"
                                                                        data-original-title="" title="Delete"
                                                                        data-toggle="modal" data-target="#DangerModalhdbgcl"
                                                                        style="">
                                                                        <i class="fa fa-trash fa-lg" style="color:red;"
                                                                            aria-hidden="true"></i>
                                                                    </a>
                                                                @endcan
                                                            </td>
                                                            @can('view-company', App\Models\sale::class)
                                                                <td>{{ $product->company->name }}</td>
                                                            @endcan
                                                        </tr>
                                                    @endforeach
                                                @endif
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
                                <div class="form-actions">
                                    <div class="text-right">
                                        {{ __('Total: ') }} <span id="total">00,00 DA</span>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <div class="text-center">
                                        <button type="submit" id="save" name="save"
                                            class="btn btn-info">{{ __('Save') }}</button>

                                        <a href="{{ route('products.index') }}">
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
    {{-- <script>
        $(document).ready(function() {
            function onScanSuccess(decodedText, decodedResult) {
  // handle the scanned code as you like, for example:
  console.log(`Code matched = ${decodedText}`, decodedResult);
}

function onScanFailure(error) {
  // handle scan failure, usually better to ignore and keep scanning.
  // for example:
  console.warn(`Code scan error = ${error}`);
}

let html5QrcodeScanner = new Html5QrcodeScanner(
  "reader",
  { fps: 10, qrbox: {width: 250, height: 250} },
  /* verbose= */ false);
html5QrcodeScanner.render(onScanSuccess, onScanFailure);


        const html5QrCode = new Html5Qrcode("reader");
        const qrCodeSuccessCallback = (decodedText, decodedResult) => {
            /* handle success */
            console.log(`Scan result: ${decodedText}`, decodedResult);
            document.getElementById('kode_barang').value=decodedText;
            // ...
            html5QrcodeScanner.clear();
        };
        const config = { fps: 10, qrbox: 250 };// Select front camera or fail with `OverconstrainedError`.
        // html5QrCode.start({ facingMode: { exact: "environment"} }, config, qrCodeSuccessCallback);


        $("#btnsearch").click(function(e){
            // This method will trigger user permissions
Html5Qrcode.getCameras().then(devices => {
  /**
   * devices would be an array of objects of type:
   * { id: "id", label: "label" }
   */
  if (devices && devices.length) {
    var cameraId = devices[0].id;
    // .. use this to start scanning.
  }
}).catch(err => {
  // handle err
});
        html5QrCode.start({ facingMode: { exact: "environment"} }, config, qrCodeSuccessCallback);
            // e.preventDefault();
            // var url = $("#Delete").attr("href");
            // var id = url.substring(url.lastIndexOf('/') + 1);
            // $.ajax({
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //     },
            //     url: url,
            //     type: 'DELETE',
            //     success: function(result) {
            //         $('#DangerModalhdbgcl').modal('toggle');
            //         $('table#table tr#'+id).remove();
            //     }
            // });
        });
        html5QrCode.start({ facingMode: { exact: "user"} }, config, qrCodeSuccessCallback);
        });
        </script> --}}

    <script type="text/javascript">
        $(document).ready(function() {
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
                                console.log(old_product_total);
                                total = total - parseInt(old_product_total) + product_total;
                                $("#" + id + " .product_total").text(`${product_total}`);
                                $("#total").text(total + " DA");
                                $("#" + id + " #product_details").text(
                                    `Product Name: ${data.product.name_ar}, Price: ${data.product.price}`
                                );
                            } else {
                                alert('This Product Not Exist an will not added');
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
                            console.log(data);
                            if (data.exist) {

                                var discount = $("#" + id + ' #discount').val();
                                if (!discount) discount = 0;
                                var quantity = $("#" + id + ' #quantity').val();
                                if (!quantity) quantity = 0;
                                var product_total = (data.product.price - discount) * quantity;
                                var old_product_total = $("#" + id + " .product_total").text();
                                if (!old_product_total) old_product_total = '0';
                                console.log(old_product_total);
                                total = total - parseInt(old_product_total) + product_total;
                                $("#" + id + " .product_total").text(`${product_total}`);
                                $("#total").text(total + " DA");
                            } else {
                                alert('This Product Not Exist an will not added');
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
                            console.log(data);
                            if (data.exist) {

                                var discount = $("#" + id + ' #discount').val();
                                if (!discount) discount = 0;
                                var quantity = $("#" + id + ' #quantity').val();
                                if (!quantity) quantity = 0;
                                var product_total = (data.product.price - discount) * quantity;
                                var old_product_total = $("#" + id + " .product_total").text();
                                if (!old_product_total) old_product_total = '0';
                                console.log(old_product_total);
                                total = total - parseInt(old_product_total) + product_total;
                                $("#" + id + " .product_total").text(`${product_total}`);
                                $("#total").text(total + " DA");
                            } else {
                                alert('This Product Not Exist an will not added');
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

                // Iterating across all the rows
                // obtained to change the index
                child.each(function() {

                    // Getting <tr> id.
                    var id = $(this).attr('id');

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
                // var data = products_table.rows().data();
                // data.each(function(value, index) {
                //     console.log(`For index ${index}, data value is ${value}`);
                //     products.push({
                //         SKU: '1111111',
                //         discount: '10',
                //         quantity: '1',
                //     });
                // });
                // console.log(data);

                $("#sale_table").find('tr').each(function (i, el) {
                   var id = $(this).attr('id');
                    var SKU = $("#" + id + ' #SKU').val();
                    var discount = $("#" + id + ' #discount').val();
                    var quantity = $("#" + id + ' #quantity').val();
                    if (SKU & quantity){
                        products.push({
                            SKU: SKU,
                            discount: discount,
                            quantity: quantity,
                        });
                    }
                    // var $tds = $(this).find('td'),
                    //     productId = $tds.eq(0).text(),
                    //     product = $tds.eq(1).text(),
                    //     Quantity = $tds.eq(2).text();
                    // do something with productId, product, Quantity
                });

                console.log(products);

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
                            window.location.href = data.url;
                        } else if (data.result == 'failed') {

                        }
                        console.log("success");
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
    </script>
@endpush

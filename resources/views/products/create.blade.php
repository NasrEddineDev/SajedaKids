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
</style>
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
@endpush

@section('content')
<div class="basic-form-area mg-b-15">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ __('Add New Product') }}</h4>
                        <form class="form-sample" method="post" action="{{ route('products.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            @if(true)
                                            <label>{{ __('SKU') }}</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" id="SKU" name="SKU" placeholder="{{ __('SKU') }}"
                                                aria-label="{{ __('SKU') }}" aria-describedby="basic-addon2" required>
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-secondary" id="scan" type="button">{{ __('Scan Barcode') }}</button>
                                                </div>
                                            </div>
                                            <!-- <div id="qr-reader" width="600px"></div> -->
                                            <!-- <div class="input-group">
                                                    <input type="text" name="kode_barang" id="kode_barang"
                                                        class="form-control" placeholder="Cari Kode Barang/ Barcode">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-primary" id="btnsearch" type="button">
                                                            <svg xmlns="http://www.w3.org/2000/svg" x="0px"
                                                                y="0px" width="20" height="20"
                                                                viewBox="0 0 50 50" style=" fill:#000000;">
                                                                <path
                                                                    d="M 21 3 C 11.621094 3 4 10.621094 4 20 C 4 29.378906 11.621094 37 21 37 C 24.710938 37 28.140625 35.804688 30.9375 33.78125 L 44.09375 46.90625 L 46.90625 44.09375 L 33.90625 31.0625 C 36.460938 28.085938 38 24.222656 38 20 C 38 10.621094 30.378906 3 21 3 Z M 21 5 C 29.296875 5 36 11.703125 36 20 C 36 28.296875 29.296875 35 21 35 C 12.703125 35 6 28.296875 6 20 C 6 11.703125 12.703125 5 21 5 Z">
                                                                </path>
                                                            </svg>
                                                        </button>
                                                    </div>
                                                </div> -->

                                            <!-- <button type="button" class="btn btn-dark">{{ __('Cancel') }}</button>
                                                    <button id="opener">Barcode scanner</button>
                                                    <div id="modal" title="Barcode scanner">
                                                        <span class="found"></span>
                                                        <div id="interactive" class="viewport"></div>
                                                    </div>
                                                    <div id="reader" width="600px"></div>
                                                    <input type="file" id="qr-input-file" accept="image/*"> -->
                                            @else
                                            <label>{{ __('Code') }}</label>
                                            <input type="text" class="form-control" id="code" name="code" placeholder="{{ __('Code') }}">
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ __('Name In Arabic') }}</label>
                                            <input type="text" class="form-control" id="name_ar" name="name_ar"
                                            placeholder="{{ __('Name In Arabic') }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ __('Name In French') }}</label>
                                            <input type="text" class="form-control" id="name_fr" name="name_fr" placeholder="{{ __('Name In French') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ __('Name In English') }}</label>
                                            <input type="text" class="form-control" id="name_en" name="name_en" placeholder="{{ __('Name In English') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ __('Price') }}</label>
                                            <input type="text" class="form-control" id="price" name="price"
                                            placeholder="{{ __('Price') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ __('Discount') }}</label>
                                            <input type="text" class="form-control" id="discount" name="discount"
                                            placeholder="{{ __('Discount') }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ __('Brand') }}</label>
                                            <select name="brand_id" id="brand_id" class="form-control" required>
                                                <option value="0" disabled selected>
                                                    {{ __('Select The Brand') }}
                                                </option>
                                                @foreach ($brands as $brand)
                                                <option value="{{ $brand->id }}">
                                                    {{ $brand->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ __('Category') }}</label>
                                            <select name="category_id" id="category_id" class="form-control" required>
                                                <option value="0" disabled selected>
                                                    {{ __('Select The Category') }}
                                                </option>
                                                @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">
                                                    {{ $category->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <label>{{ __('Image') }}</label>
                                                <div class="input-group">
                                                    <div class="custom-file">
                                                        <input type="file" id="image" name="image" class="custom-file-input" id="inputGroupFile01" aria-describedby="inputGroupFileAddon01">
                                                        <label class="custom-file-label" for="inputGroupFile01">{{ __('Choose file') }}</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 d-flex justify-content-center">
                                                <img style="height:100px;" id="showedImage" class="img-thumbnail" src="https://t4.ftcdn.net/jpg/03/18/30/85/360_F_318308547_FALKncfWsTmjzwd0y0muNeCFOULPLB7Q.webp" alt="...">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ __('Description') }}</label>
                                            <input type="text" class="form-control" id="description" name="description" placeholder="{{ __('Description') }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="text-center">
                                    <button type="submit" class="btn btn-info">{{ __('Save') }}</button>

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
<div class="modal fade" id="scanBareCodeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
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

        $('input[type=file]').change(function(event) {
            var tmppath = URL.createObjectURL(event.target.files[0]);
            $("#showedImage").fadeIn("fast").attr('src', URL.createObjectURL(event.target.files[0]));
        });


        function onScanSuccess(decodedText, decodedResult) {
            // Handle on success condition with the decoded text or result.
            document.getElementById("SKU").innerHTML = decodedText;
            $('#scanBareCodeModal #productSKU').text(decodedText);
            console.log(`Scan result: ${decodedText}`, decodedResult);
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
            $(document).on('click', '#scan', function() {
            // $('#scanBareCodeModal').modal('toggle');
            $('#scanBareCodeModal').modal('show');
            // var id = main_datatable_table.row('.selected').id();
            // if (id) {
            //     $('#deleteModal #customerId').text(id);
            //     $('#deleteModal #productSKU').text($("#" + id + " #customerName").text());
            //     $('#deleteModal #customerCity').text($("#" + id + " #customerCity").text());
            // }
        });

    });
</script>
@endpush

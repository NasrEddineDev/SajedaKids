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
    <!-- <div class="basic-form-area mg-b-15"> -->
        <div class="container-fluid">
            {{-- <div id="reader" width="600px"></div> --}}
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">{{ __('Edit Sale') }}</h4>
                            <form class="form-sample" method="post" action="{{ route('products.update', $product->id) }}"
                                enctype="multipart/form-data">
                                @csrf
                                @method('put')
                                <input hidden type="text" class="form-control" value="{{ $product->id ?? ''}}" id="product_id" name="product_id" >
                                <div class="form-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                            @if(true)
                                            <label>{{ __('SKU') }}</label>
                                            <div class="input-group mb-3">
                                                <input type="text" class="form-control" id="SKU" name="SKU" placeholder="{{ __('SKU') }}"
                                                aria-label="{{ __('SKU') }}" aria-describedby="basic-addon2"
                                                value="{{ $product->SKU ?? ''}}" required>
                                                <div class="input-group-append">
                                                    <button class="btn btn-outline-secondary" type="button">Scan Barcode</button>
                                                </div>
                                            </div>
                                            @else
                                            <label>{{ __('Code') }}</label>
                                            <input type="text" class="form-control" id="code" name="code"
                                                    placeholder="{{ __('Code') }}" value="{{ $product->code ?? ''}}">
                                            @endif
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ __('Name In Arabic') }}</label>
                                                <input type="text" class="form-control" id="name_ar" name="name_ar"
                                                    placeholder="{{ __('Name In Arabic') }}" value="{{ $product->name_ar ?? ''}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ __('Name In French') }}</label>
                                                <input type="text" class="form-control" id="name_fr" name="name_fr"
                                                    placeholder="{{ __('Name In French') }}" value="{{ $product->name_fr ?? ''}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ __('Name In English') }}</label>
                                                <input type="text" class="form-control" id="name_en" name="name_en"
                                                    placeholder="{{ __('Name In English') }}" value="{{ $product->name_en ?? ''}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ __('Price') }}</label>
                                                <input type="text" class="form-control" id="price" name="price"
                                                    placeholder="{{ __('Price') }}" value="{{ $product->price ?? ''}}">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ __('Discount') }}</label>
                                                <input type="text" class="form-control" id="discount" name="discount"
                                                    placeholder="{{ __('Discount') }}" value="{{ $product->discount ?? ''}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ __('Brand') }}</label>
                                                <select name="brand_id" id="brand_id" class="form-control" required>
                                                    <option value="0" disabled selected>
                                                        {{ __('Select The Brand') }}</option>
                                                    @foreach ($brands as $brand)
                                                        <option value="{{ $brand->id }}" {{ $product->brand->id == $brand->id ? 'selected' : '' }}>
                                                            {{ $brand->name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ __('Category') }}</label>
                                                <select name="category_id" id="category_id" class="form-control"
                                                    required>
                                                    <option value="0" disabled selected>
                                                        {{ __('Select The Category') }}</option>
                                                    @foreach ($categories as $category)
                                                        <option value="{{ $category->id }}" {{ $product->category->id == $category->id ? 'selected' : '' }}>
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
                                                            <input type="file" id="image" name="image"
                                                                class="custom-file-input" id="inputGroupFile01"
                                                                aria-describedby="inputGroupFileAddon01">
                                                            <label class="custom-file-label"
                                                                for="inputGroupFile01">{{ __('Choose file') }}</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 d-flex justify-content-center">
                                                    <img style="height:100px;" id="showedImage" class="img-thumbnail"
                                                        src="https://t4.ftcdn.net/jpg/03/18/30/85/360_F_318308547_FALKncfWsTmjzwd0y0muNeCFOULPLB7Q.webp"
                                                        alt="...">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>{{ __('Description') }}</label>
                                                <input type="text" class="form-control" id="description" value="{{ $product->description ?? ''}}"
                                                    name="description" placeholder="{{ __('Description') }}">
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
    <!-- </div> -->
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

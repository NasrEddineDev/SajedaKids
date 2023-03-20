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
        <!-- <div id="reader" width="600px"></div> -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">{{ __('Add New Sales') }}</h4>
                        <form class="form-sample" method="post" action="{{ route('products.store') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ __('Date') }}</label>
                                            <input type="text" class="form-control" id="date" name="date"
                                            placeholder="{{ __('Date') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ __('Customer') }}</label>
                                            <input type="text" class="form-control" id="customer" name="customer" placeholder="{{ __('Customer') }}"
                                             required>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                        <h4 class="card-title">{{ __('Products List') }}</h4>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6">
                                            <button id="addProduct" type="button" class="btn btn-success btn-rounded float-right">
                                                <i class="fas fa-plus-circle"></i>{{ __('New Product') }}</button>
                                    </div>
                                </div>

                        <div class="table-responsive">
                            <table id="zero_config" class="table table-striped table-bordered no-wrap">
                                <thead>
                                    <tr>
                                        <th>{{ __('Id') }}</th>
                                        <th>{{ __('SKU') }}</th>
                                        <th>{{ __('Name') }}</th>
                                        <th>{{ __('Price') }}</th>
                                        <th>{{ __('Discount') }}</th>
                                        <th>{{ __('Category') }}</th>
                                        <th>{{ __('Brand') }}</th>
                                        <th>{{ __('Action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
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
                                                @can('update',  App\Models\SaleItem::class)
                                                <a rel="tooltip" class="" href="{{ route('sales.edit',$sale->id) }}" data-original-title="" title="Edit">
                                                    <i class="fa fa-pencil-square-o fa-lg warning"></i>
                                                </a>
                                                @endcan
                                                @can('delete',  App\Models\SaleItem::class)
                                                <a rel="tooltip" class=" pd-setting-ed" href="#" data-url="{{ route('sales.destroy',$sale->id) }}"
                                                data-sale_name="{{ $sale->name }}" data-original-title="" title="Delete" data-toggle="modal"
                                                data-target="#DangerModalhdbgcl" style="">
                                                    <i class="fa fa-trash fa-lg" style="color:red;" aria-hidden="true"></i>
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

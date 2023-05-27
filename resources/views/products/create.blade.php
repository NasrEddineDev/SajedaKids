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
<!-- <div class="mb-3">{!! DNS2D::getBarcodeHTML('4445645656', 'QRCODE') !!}</div>
<div class="mb-3">{!! DNS1D::getBarcodeHTML('4445645656', 'PHARMA') !!}</div>
<div class="mb-3">{!! DNS1D::getBarcodeHTML('4445645656', 'PHARMA2T') !!}</div>
<div class="mb-3">{!! DNS1D::getBarcodeHTML('4445645656', 'CODABAR') !!}</div>
<div class="mb-3">{!! DNS1D::getBarcodeHTML('4445645656', 'KIX') !!}</div>
<div class="mb-3">{!! DNS1D::getBarcodeHTML('4445645656', 'RMS4CC') !!}</div>
<div class="mb-3">{!! DNS1D::getBarcodeHTML('4445645656', 'UPCA') !!}</div> -->
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

                                            <div class="row">
                                                <div class="col-md-8">
                                                    <label>{{ __('SKU') }}</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control" id="SKU" name="SKU" placeholder="{{ __('SKU') }}" aria-label="{{ __('SKU') }}" aria-describedby="basic-addon2" required>
                                                        <div class="input-group-append">

                                                            <button class="btn btn-light" type="button" id="scanBareCode">
                                                                <i class="fa fa-lg fa-barcode"></i>
                                                            </button>
                                                            <button class="btn btn-light" type="button" id="generateBareCode">
                                                                <i class="fa fa-lg fa-plus-square"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 d-flex justify-content-center">
                                                    <img style="height:100px;" id="showedBarcode" class="img-thumbnail" src="https://t4.ftcdn.net/jpg/03/18/30/85/360_F_318308547_FALKncfWsTmjzwd0y0muNeCFOULPLB7Q.webp" alt="...">
                                                </div>
                                            </div>
                                            @else
                                            <label>{{ __('Code') }}</label>
                                            <input type="text" class="form-control" id="code" name="code" placeholder="{{ __('Code') }}">
                                            @endif
                                        </div>
                                    </div>
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
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ __('Name In Arabic') }}</label>
                                            <input type="text" class="form-control" id="name_ar" name="name_ar" placeholder="{{ __('Name In Arabic') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ __('Name In French') }}</label>
                                            <input type="text" class="form-control" id="name_fr" name="name_fr" placeholder="{{ __('Name In French') }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ __('Name In English') }}</label>
                                            <input type="text" class="form-control" id="name_en" name="name_en" placeholder="{{ __('Name In English') }}">
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
                                        <div class="form-group">
                                            <label>{{ __('Price') }}</label>
                                            <input type="text" class="form-control" id="price" name="price" placeholder="{{ __('Price') }}" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ __('Discount') }}</label>
                                            <input type="text" class="form-control" id="discount" name="discount" placeholder="{{ __('Discount') }}" required>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>{{ __('Description') }}</label>
                                            <input type="text" class="form-control" id="description" name="description" placeholder="{{ __('Description') }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <!-- <div class="form-group">
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
                                        </div> -->
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
<script src="{{ URL::asset('dist/js/html5-qrcode.min.js') }}"></script>

<script type="text/javascript">
    $(document).ready(function() {

        $('input[type=file]').change(function(event) {
            var tmppath = URL.createObjectURL(event.target.files[0]);
            $("#showedImage").fadeIn("fast").attr('src', URL.createObjectURL(event.target.files[0]));
        });


        function onScanSuccess(decodedText, decodedResult) {
            // Handle on success condition with the decoded text or result.
            $('#SKU').val(decodedText);
            $('#scanBareCodeModal #productSKU').text(decodedText);
            $('#scanBareCodeModal').modal('hide');
            //console.log(`Scan result: ${decodedText}`, decodedResult);
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
            $("#barcode").val('0').change();
            $('#scanBareCodeModal').modal('show');
        });
        $(document).on("click", "#generateBareCode", function(e) {
            e.preventDefault();
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '{{ route("settings.get-new-barcode") }}',
                type: 'GET',
                success: function(result) {
                    $('#SKU').val(result.barcode);
                    $("#showedBarcode").attr("src", result.path);
                }
            });
        });

    });
</script>
@endpush
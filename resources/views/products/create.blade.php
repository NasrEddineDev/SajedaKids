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
                                <form class="form-sample" method="post" action="{{ route('products.store') }}">
                                    @csrf
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>{{ __('SKU') }}</label>
                                                    <input type="text" class="form-control" placeholder="{{ __('SKU') }}">
                                                    <button type="button" class="btn btn-dark">{{ __('Cancel') }}</button>
                                                    <button id="opener">Barcode scanner</button>
                                                    <div id="modal" title="Barcode scanner">
                                                        <span class="found"></span>
                                                        <div id="interactive" class="viewport"></div>
                                                    </div>
                                                    <div id="reader" width="600px"></div>
                                                    <input type="file" id="qr-input-file" accept="image/*">

                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>{{ __('Code') }}</label>
                                                    <input type="text" class="form-control" placeholder="{{ __('Code') }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>{{ __('Name In Arabic') }}</label>
                                                    <input type="text" class="form-control" placeholder="{{ __('Name In Arabic') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>{{ __('Name In English') }}</label>
                                                    <input type="text" class="form-control" placeholder="{{ __('Name In English') }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>{{ __('Name In French') }}</label>
                                                    <input type="text" class="form-control" placeholder="{{ __('Name In Arabic') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>{{ __('Image') }}</label>
                                                    <input type="text" class="form-control" placeholder="{{ __('Image') }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>{{ __('Price') }}</label>
                                                    <input type="text" class="form-control" placeholder="{{ __('Price') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>{{ __('Discount') }}</label>
                                                    <input type="text" class="form-control" placeholder="{{ __('Discount') }}">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>{{ __('Description') }}</label>
                                                    <input type="text" class="form-control" placeholder="{{ __('Description') }}">
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>{{ __('Store') }}</label>
                                                    <select name="category_id" id="category_id" class="form-control"
                                                        required>
                                                        <option value="0" disabled selected>
                                                            {{ __('Select The Store') }}</option>
                                                        @foreach ($stores as $store)
                                                            <option value="{{ $store->id }}">
                                                                {{ $store->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label>{{ __('Brand') }}</label>
                                                    <select name="brand_id" id="brand_id" class="form-control"
                                                        required>
                                                        <option value="0" disabled selected>
                                                            {{ __('Select The Brand') }}</option>
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
                                                    <select name="category_id" id="category_id" class="form-control"
                                                        required>
                                                        <option value="0" disabled selected>
                                                            {{ __('Select The Category') }}</option>
                                                        @foreach ($categories as $category)
                                                            <option value="{{ $category->id }}">
                                                                {{ $category->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-actions">
                                        <div class="text-center">
                                            <button type="submit" class="btn btn-info">{{ __('Save') }}</button>
                                            <button type="button" class="btn btn-dark">{{ __('Cancel') }}</button>
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
    <script src="{{ URL::asset('js/jquery.validate.min.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/lang/messages_' . App()->currentLocale() . '.js') }}"></script>
    <script src="{{ URL::asset('js/input-mask/jquery.inputmask.min.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript">

    <script type="text/javascript">
        $(document).ready(function() {

            $("#hs_code").autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: "route('products.searchproductsbyhscode') }}",
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        type: 'POST',
                        dataType: "json",
                        data: {
                            search: request.term
                        },
                        success: function(data) {
                            response(data);
                        }
                    });
                },
                select: function(event, ui) {
                    $('#hs_code').val(ui.item.value.substr(0, 2) + '.' + ui.item.value.substr(2,5) + '.' + ui.item.value.substr(7,10)); // display the selected text
                    $('#label').val(ui.item.original_name);
                    $('#name_fr').val(ui.item.name_fr);
                    $('#name_ar').val(ui.item.name_ar);
                    $('#name_en').val(ui.item.name_en);
                    $("#category_id").val(ui.item.category_id).change();
                    $("#measure_unit").val(ui.item.measure_unit).change();
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        url: "/getsubcategories/" + ui.item.category_id,
                        type: "GET",
                        success: function(data) {
                            $('#sub_category_id').empty();
                            $.each(data.subCategories, function(index, subCategory) {
                                $('#sub_category_id').append('<option value="' + subCategory.value +
                                    '" ' + (subCategory.value == ui.item.sub_category_id ? 'selected' : '')+'>' + subCategory.text + '</option>');
                            })
                        }
                    })
                    return false;
                },
                focus: function(event, ui) {
                    $('#hs_code').val(ui.item.value.substr(0, 2) + '.' + ui.item.value.substr(2,5) + '.' + ui.item.value.substr(7,10)); // display the selected text
                    $('#label').val(ui.item.original_name);
                    $('#name_fr').val(ui.item.name_fr);
                    $('#name_ar').val(ui.item.name_ar);
                    $('#name_en').val(ui.item.name_en);
                    return false;
                },
            });

            $('#category_id').on('change', function() {
                var selectedCategory = $('#category_id').find(":selected").val();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: "/getsubcategories/" + selectedCategory,
                    type: "GET",
                    success: function(data) {
                        $('#sub_category_id').empty();
                        $('#sub_category_id').append(
                            '<option value="0" disabled selected>{{ __('Select The SubCategory') }}</option>'
                        );
                        $.each(data.subCategories, function(index, subCategory) {
                            $('#sub_category_id').append('<option value="' + subCategory
                                .value +
                                '">' + subCategory.text + '</option>');
                        })
                    }
                })
            });

            $.validator.addMethod("formatcheck", function(value, element, regexp) {
                /* Check if the value is truthy (avoid null.constructor) & if it's not a RegEx. (Edited: regex --> regexp)*/
                if (regexp && regexp.constructor != RegExp) {
                    /* Create a new regular expression using the regex argument. */
                    regexp = new RegExp(regexp);
                }
                /* Check whether the argument is global and, if so set its last index to 0. */
                else if (regexp.global) regexp.lastIndex = 0;
                /* Return whether the element is optional or the result of the validation. */
                return this.optional(element) || regexp.test(value);
            });

            var account_validator = $(".form-sample").validate({
                rules: {
                    hs_code: {
                        // required: true,
                        formatcheck: '[0-9]{2}.[0-9]{4}.[0-9]{4}',
                    },
                },
                messages: {
                    hs_code: {
                        // required: " __('This field is required.') }}",
                        formatcheck: "{{ __('Incorrect Format') }}",
                    },
                },
            });

            $('#hs_code').inputmask("99.9999.9999");
        });
    </script>
@endpush

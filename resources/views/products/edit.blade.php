@extends('layouts.mainlayout')

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
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="sparkline12-list">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title">{{ __('Edit Product') }}</h4>
                                <br />
                                <p class="card-description"> {{ __('Product') }} </p>
                                <form class="form-sample" method="post"
                                    action="{{ route('products.update', $product->id) }}">
                                    @csrf
                                    @method('put')
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group row">
                                                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                                    <input type="text" name="label" id="label" class="form-control"
                                                        readonly  value="{{ $product->customsTariff()?->name_fr }}"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div
                                            class="col-lg-6 col-md-6 col-sm-12 col-xs-12 {{ App()->currentLocale() == 'ar' ? 'pull-right' : '' }}">
                                            <div class="form-group row">
                                                <label
                                                    class="col-lg-4 col-md-4 col-sm-12 col-xs-12 col-form-label {{ App()->currentLocale() == 'ar' ? 'pull-right' : '' }}">
                                                    {{ __('HS Code') }}</label>
                                                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                                    <input name="hs_code" id="hs_code" type="text"
                                                        class="form-control" value="{{ $product->hs_code }}"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group row">
                                                <label
                                                    class="required col-lg-4 col-md-4 col-sm-12 col-xs-12 col-form-label {{ App()->currentLocale() == 'ar' ? 'pull-right' : '' }}">
                                                    {{ __('Product Name In French') }}</label>
                                                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                                    <input type="text" name="name_fr" id="name_fr" class="form-control"
                                                        required  value="{{ $product->name_fr }}"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group row">
                                                <label
                                                    class="required col-lg-4 col-md-4 col-sm-12 col-xs-12 col-form-label {{ App()->currentLocale() == 'ar' ? 'pull-right' : '' }}">
                                                    {{ __('Product Name In Arabic') }}</label>
                                                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                                    <input type="text" name="name_ar" id="name_ar" class="form-control"
                                                        required  value="{{ $product->name_ar }}"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div
                                            class="col-lg-6 col-md-6 col-sm-12 col-xs-12 {{ App()->currentLocale() == 'ar' ? 'pull-right' : '' }}">
                                            <div class="form-group row">
                                                <label
                                                    class="required col-lg-4 col-md-4 col-sm-12 col-xs-12 col-form-label {{ App()->currentLocale() == 'ar' ? 'pull-right' : '' }}">
                                                    {{ __('Product Name In English') }}</label>
                                                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                                    <input type="text" name="name_en" id="name_en" class="form-control"
                                                        required  value="{{ $product->name_en }}"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 {{ App()->currentLocale() == 'ar' ? 'pull-right' : '' }}">
                                            <div class="form-group row">
                                                <label
                                                    class="required col-lg-4 col-md-4 col-sm-12 col-xs-12 col-form-label {{ App()->currentLocale() == 'ar' ? 'pull-right' : '' }}">{{ __('Measure Unit') }}</label>
                                                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                                    <select name="measure_unit" id="measure_unit" class="form-control"
                                                        required>
                                                        <option value="" disabled>
                                                            {{ __('Select The Measure Unit') }}</option>
                                                        <option value="KG"
                                                            {{ $product->measure_unit == 'KG' ? 'selected' : '' }}>
                                                            {{ __('Kilogram (kg), for mass (weight)') }}</option>
                                                        <option value="T"
                                                            {{ $product->measure_unit == 'T' ? 'selected' : '' }}>
                                                            {{ __('Tonne (T), for mass (weight)') }}</option>
                                                        <option value="U"
                                                            {{ $product->measure_unit == 'U' ? 'selected' : '' }}>
                                                            {{ __('Unit (u), for number of units') }}</option>
                                                        <option value="L"
                                                            {{ $product->measure_unit == 'L' ? 'selected' : '' }}>
                                                            {{ __('Litre (L), for capacity (volume)') }}</option>
                                                        <option value="M"
                                                            {{ $product->measure_unit == 'M' ? 'selected' : '' }}>
                                                            {{ __('Metre (M), for length (distance)') }}</option>
                                                        <option value="M²"
                                                            {{ $product->measure_unit == 'M²' ? 'selected' : '' }}>
                                                            {{ __('Square Metre (M²), for area') }}</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 {{ App()->currentLocale() == 'ar' ? 'pull-right' : '' }}">
                                            <div class="form-group row">
                                                <label
                                                    class="required col-lg-4 col-md-4 col-sm-12 col-xs-12 col-form-label {{ App()->currentLocale() == 'ar' ? 'pull-right' : '' }}">{{ __('Product Category') }}</label>
                                                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                                    <select name="category_id" id="category_id" class="form-control"
                                                        required>
                                                        <option value="0" disabled>
                                                            {{ __('Select The Category') }}</option>
                                                        @foreach ($categories as $category)
                                                            <option value="{{ $category->id }}"
                                                                {{ $product->subCategory->category_id == $category->id ? 'selected' : '' }}>
                                                                {{ $category->number . ' ' . $category->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label
                                                    class="required col-lg-4 col-md-4 col-sm-12 col-xs-12 col-form-label {{ App()->currentLocale() == 'ar' ? 'pull-right' : '' }}">{{ __('Product SubCategory') }}</label>
                                                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                                    <select name="sub_category_id" id="sub_category_id" class="form-control"
                                                        required>
                                                        <option value="0" disabled>
                                                            {{ __('Select The SubCategory') }}</option>
                                                        @foreach ($sub_categories as $sub_category)
                                                            <option value="{{ $sub_category->id }}"
                                                                {{ $product->sub_category_id == $sub_category->id ? 'selected' : '' }}>
                                                                {{ $sub_category->number . ' ' . $sub_category->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        @can('view-enterprises', App\Models\Product::class)
                                        <div class="col-md-6 {{ App()->currentLocale() == 'ar' ? 'pull-right' : '' }}">
                                            <div class="form-group row">
                                                <label
                                                    class="required col-lg-4 col-md-4 col-sm-12 col-xs-12 col-form-label {{ App()->currentLocale() == 'ar' ? 'pull-right' : '' }}">{{ __('Enterprise') }}</label>
                                                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                                    <select name="enterprise_id" id="enterprise_id" class="form-control"
                                                        required>
                                                        <option selected disabled>{{ __('Select The Enterprise') }}
                                                        </option>
                                                        @foreach ($enterprises as $enterprise)
                                                            <option value="{{ $enterprise->id }}"
                                                                {{ $product->enterprise->id == $enterprise->id ? 'selected' : '' }}>
                                                                {{ __($enterprise->name) }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        @endcan
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12 {{ App()->currentLocale() == 'ar' ? 'pull-right' : '' }}">
                                            <div class="form-group row">
                                                <label
                                                    class="col-lg-4 col-md-4 col-sm-12 col-xs-12 col-form-label {{ App()->currentLocale() == 'ar' ? 'pull-right' : '' }}">{{ __('Product Brand') }}</label>
                                                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                                    <input type="text" name="brand" id="brand" class="form-control"  value="{{ $product->brand }}"/>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                                            <div class="form-group row">
                                                <label
                                                    class="col-lg-4 col-md-4 col-sm-12 col-xs-12 col-form-label {{ App()->currentLocale() == 'ar' ? 'pull-right' : '' }}">{{ __('Description') }}</label>
                                                <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                                                    <input name="description" id="description" type="text"
                                                        class="form-control"  value="{{ $product->description }}"/>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group-inner">
                                        <div class="login-btn-inner">
                                            <div class="row">
                                                <div class="col-lg-3"></div>
                                                <div class="col-lg-9">
                                                    <div class="login-horizental cancel-wp pull-left form-bc-ele">
                                                        <button type="button" class="btn btn-white">
                                                            <a href="{{ route('products.index') }}"
                                                                style="color: inherit;">{{ __('Cancel') }}</a>
                                                        </button>
                                                        <button type="submit"
                                                            class="btn btn-primary login-submit-cs">{{ __('Save Change') }}</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
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
    <script type="text/javascript">
        $(document).ready(function() {


            $("#hs_code").autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: "{{ route('products.searchproductsbyhscode') }}",
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
                        required: true,
                        formatcheck: '[0-9]{2}.[0-9]{4}.[0-9]{4}',
                    },
                },
                messages: {
                    hs_code: {
                        required: "{{ __('This field is required.') }}",
                        formatcheck: "{{ __('Incorrect Format') }}",
                    },
                },
            });

            $('#hs_code').inputmask("99.9999.9999"); //specifying options

        });
    </script>
@endpush

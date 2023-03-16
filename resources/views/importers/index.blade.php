@extends('layouts.main')
@Push('css')

    <style>
    </style>

@endpush

@section('content')

    <!-- Static Table Start -->
    {{-- <div class="data-table-area mg-b-15">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="sparkline13-list">
                        <div class="sparkline13-hd">
                            <div class="main-sparkline13-hd">
                                <h1>{{ __('Importers List') }}</h1>
                            </div>
                        </div>
                        <div class="sparkline13-graph">
                            <div class="datatable-dashv1-list custom-datatable-overright">
                                <div id="toolbar">
                                    <div class="{{ App()->currentLocale() == 'ar' ? 'pull-right' : '' }}">
                                        @can('create',  App\Models\Importer::class)
                                        <button id="new" style="background-color: #2C7744;"
                                            class="dropbtn btn btn-success dropdown-toggle {{ (Auth::User()->role->name == 'user' && Auth::User()->enterprise->status ==
                                            "Pending") ? 'not-active' : '' }}" data-toggle="dropdown"
                                            aria-haspopup="true" aria-expanded="false"
                                            title="{{ __('Add New Importer') }}">
                                            <i class="fa fa-user-plus"></i>
                                        </button>
                                        @endcan
                                        @can('update',  App\Models\Importer::class)
                                        <button id="edit" rel="tooltip" class="btn btn-primary" title="{{ __('Edit') }}"
                                            disabled>
                                            <i class="fa fa-pencil-square-o"></i>
                                        </button>
                                        @endcan
                                        @can('delete',  App\Models\Importer::class)
                                        <button id="remove" class="btn btn-danger" title="{{ __('Delete') }}"
                                            data-toggle="modal" data-target="#DangerModalhdbgcl"
                                            style="background-color: #d80027!important;" disabled>
                                            <i class="fa fa-trash"></i>
                                        </button>
                                        @endcan
                                    </div>
                                    @can('filter-country',  App\Models\Importer::class)
                                    <div class="col-lg-4 {{ App()->currentLocale() == 'ar' ? 'pull-right' : '' }}">
                                        <select id="certificatesSelecor" name="certificatesSelecor" class="form-control">
                                            <option value="ALL" selected>ALL</option>
                                            <option value="UEA">UEA</option>
                                            <option value="EGYPT">EGYPT</option>
                                        </select>
                                    </div>
                                    @endcan
                                </div>
                                <table id="table" data-toggle="table" data-pagination="true" data-search="true"
                                    data-show-columns="true" data-show-pagination-switch="true" data-show-refresh="true"
                                    data-key-events="true" data-show-toggle="true" data-resizable="true" data-cookie="true"
                                    data-cookie-id-table="saveId" data-show-export="true" data-click-to-select="true"
                                    data-buttons-align="{{ App()->currentLocale() == 'ar' ? 'left' : 'right' }}"
                                    data-search-align="{{ App()->currentLocale() == 'ar' ? 'left' : 'right' }}"
                                    data-toolbar-align="{{ App()->currentLocale() == 'ar' ? 'right' : 'left' }}"
                                    data-toolbar="#toolbar" data-detail-view="true" data-detail-formatter="detailFormatter"
                                    data-locale="{{ App()->currentLocale() == 'en' ? 'en-US' : (App()->currentLocale() == 'ar' ? 'ar-SA' : 'fr-FR') }}">
                                    <thead>
                                        <tr>
                                            <th data-field="state" data-checkbox="true"></th>
                                            <th data-field="id">{{ __('ID') }}</th>
                                            <th data-field="name" data-editable="true">{{ __('Name') }}</th>
                                            <th data-field="activity_type" data-editable="true">{{ __('Activity Type') }}</th>
                                            <th data-field="country" data-editable="true">{{ __('Country') }}</th>
                                            <th data-field="address" data-editable="true">{{ __('Address') }}</th>
                                            <th data-field="mobile" data-editable="true">{{ __('Mobile') }}</th>
                                            <th data-field="email" data-editable="true">{{ __('Email') }}</th>
                                            @if (Auth::user()->can('view-enterprise-user'))
                                                <th data-field="enterprise" data-editable="true">{{ __('Enterprise') }}
                                                </th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($importers as $importer)
                                            <tr id="{{ $importer->id }}">
                                                <td></td>
                                                <td>{{ $importer->id }}</td>
                                                <td>{{ $importer->name }}</td>
                                                <td>{{ $importer->category->name }}</td>
                                                <td>{{ $importer->state->country->name }}</td>
                                                <td>{{ $importer->address }}</td>
                                                <td>{{ $importer->mobile }}</td>
                                                <td>{{ $importer->email }}</td>
                                                @if (Auth::user()->can('view-enterprise-user'))
                                                    <td>{{ $importer->enterprise->name }}</td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> --}}


@endsection

@Push('js')
    <script type="text/javascript">

    </script>
@endpush

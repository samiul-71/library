@extends('backend.layouts.app')

@section ('title', ucfirst($module_title) . ' ' . ucfirst($module_action))

@section('page-header')
    <h1>
        <i class="{!! $module_icon !!}"></i> {!! ucfirst($module_title) !!}
        <small>
            {!! ucfirst($module_action) !!}
        </small>
    </h1>
@endsection

@section('after-styles-end')
    <style>

    </style>
@endsection

@section('content')

    <div class="row">
        <div class="col-sm-12">
            <div class="box box-primary">
                <div class="box-header with-border">

                    <h3 class="box-title">{!! ucfirst($module_title) !!} {!! ucfirst($module_action) !!}</h3>

                    <div class="box-tools pull-right">
                        <a href="{!! route('admin.pharmaceutical-companies.create') !!}" class="btn btn-xs btn-success">
                            <i class="fa fa-plus"></i> {!! trans('labels.general.buttons.pharmaceutical-companies.create') !!}
                        </a>
                        <a href="{!! route("admin.pharmaceutical-companies.trash") !!}" class="btn btn-xs btn-danger">
                            <i class="fa fa-trash"></i> {!! trans('labels.general.buttons.trash') !!}
                        </a>
                    </div>

                </div>
                <div class="box-body">
                    @if(count($pharmaceutical_companies))
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover table-condensed pharmaceutical-companies-table" id="pharmaceutical-companies-table">
                                <thead>
                                <tr>
                                    <th>SL.</th>
                                    <th>Name</th>
                                    <th>Registration No.</th>
                                    <th>Phone</th>
                                    <th>Company Type</th>
                                    <th>Registration Status</th>
                                    <th>Status</th>
                                    <th class="text-center" style="width: 120px;">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach( $pharmaceutical_companies as $key => $pharmaceutical_company)
                                    <tr>
                                        <td>
                                            {{ ++$key }}
                                        </td>
                                        <td>
                                            <a href="{{ route("admin.pharmaceutical-companies.show", $pharmaceutical_company->id) }}" >
                                                {!! $pharmaceutical_company->name !!}
                                            </a>
                                        </td>
                                        <td>
                                            {!! $pharmaceutical_company->registration_number !!}
                                        </td>
                                        <td>
                                            {!! $pharmaceutical_company->phone !!}
                                        </td>
                                        <td>
                                            {!! $pharmaceutical_company->company_type !!}
                                        </td>
                                        <td>
                                            {!! $pharmaceutical_company->registration_status !!}
                                        </td>
                                        <td>
                                            @if($pharmaceutical_company->status && $pharmaceutical_company->status == 1)
                                                {!! 'Active' !!}
                                            @else
                                                {!! 'Not Active' !!}
                                            @endif
                                        </td>
                                        <td style="width: 120px;">
                                            <a class="btn btn-xs btn-primary" data-toggle="tooltip" data-placement="top" title="Edit" href="{{ route("admin.pharmaceutical-companies.edit", $pharmaceutical_company->id) }}">
                                                <i class="fa fa-pencil"></i>
                                                {!! 'Edit' !!}
                                            </a>
                                            <a class="btn btn-xs btn-info" data-toggle="tooltip" data-placement="top" title="Show" href="{{ route("admin.pharmaceutical-companies.show", $pharmaceutical_company->id) }}">
                                                <i class="fa fa-list"></i>
                                                {!! 'Show' !!}
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="col-sm-12 text-center" style="padding: 150px 0;">
                            <h1 style="opacity: 0.3">You don't have any Pharmaceutical Company created yet.</h1>
                            <a href="{!! route('admin.pharmaceutical-companies.create') !!}" type="button" class="btn btn-default">
                                You Can Add/Create Here
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

@stop

@section('after-scripts-end')
    <script>
        $(document).ready(function() {
            $('#pharmaceutical-companies-table').DataTable();
        });
    </script>
@stop

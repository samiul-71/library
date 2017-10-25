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

@section('after-styles')
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
                        <a href="{!! route('admin.medicine.create') !!}" class="btn btn-xs btn-success">
                            <i class="fa fa-plus"></i> {!! trans('labels.general.buttons.medicine.create') !!}
                        </a>
                        <a href="{!! route("admin.medicine.trash") !!}" class="btn btn-xs btn-danger">
                            <i class="fa fa-trash"></i> {!! trans('labels.general.buttons.trash') !!}
                        </a>
                    </div>

                </div>
                <div class="box-body">
                    @if(count($medicines))
                        <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover table-condensed generic_name-table" id="generic_name-table">
                            <thead>
                                <tr>
                                    <th>Medicine Name</th>
                                    <th>Code</th>
                                    <th>Genre</th>
                                    <th>Manufacturer</th>
                                    <th>Pack & Price</th>
                                    <th>Status</th>
                                    <th class="text-center" style="width: 120px;">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($medicines as $medicine)
                                <tr>
                                    <td>
                                        <a href="{{ route("admin.medicine.show", $medicine->id) }}" >
                                            {!! $medicine->name !!} {!! $medicine->strength !!} ({!! $medicine->medicine_type_name !!})
                                        </a>
                                    </td>
                                    <td>
                                        {!! $medicine->code !!}
                                    </td>
                                    <td>
                                        {!! $medicine->generic_name !!}
                                    </td>
                                    <td>
                                        {!! $medicine->pharma_name !!}
                                    </td>
                                    <td>
                                        {!! $medicine->pack_size !!} pcs.
                                        {!! $medicine->unit_price !!}
                                        {!! $medicine->currency !!}
                                    </td>
                                    <td>
                                        @if($medicine->status && $medicine->status == 1)
                                            {!! 'Publish' !!}
                                        @else
                                            {!! 'Not Publish' !!}
                                        @endif
                                    </td>
                                    <td style="width: 120px;">
                                        <a class="btn btn-xs btn-primary" data-toggle="tooltip" data-placement="top" title="Edit" href="{{ route("admin.medicine.edit", $medicine->id) }}">
                                            <i class="fa fa-pencil"></i>
                                            {!! 'Edit' !!}
                                        </a>
                                        <a class="btn btn-xs btn-info" data-toggle="tooltip" data-placement="top" title="Show" href="{{ route("admin.medicine.show", $medicine->id) }}">
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
                            <h1 style="opacity: 0.3">You don't have any Medicine Item yet.</h1>
                            <a href="{!! route('admin.medicine.create') !!}" type="button" class="btn btn-default">
                                You Can Add/Create Here
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

@stop

@section('after-scripts')
    <script>
        $(document).ready(function() {
//            $('#medicine-table').DataTable();
        });
    </script>
@stop

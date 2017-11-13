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
                        <a href="{!! route("admin.$module_path.create") !!}" class="btn btn-xs btn-success">
                            <i class="fa fa-plus"></i> {!! trans("labels.general.buttons.$module_path.create") !!}
                        </a>
                        <a href="{!! route("admin.$module_path.trash") !!}" class="btn btn-xs btn-danger">
                            <i class="fa fa-trash"></i> {!! trans("labels.general.buttons.trash") !!}
                        </a>
                    </div>

                </div>
                <div class="box-body">
                    @if(count($therapeutic_classes))
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover table-condensed therapeutic-class-table" id="therapeutic-class-table">
                                <thead>
                                <tr>
                                    <th>SL.</th>
                                    <th>Therapeutic Class</th>
                                    <th>Status</th>
                                    <th class="text-center" style="width: 120px;">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach( $therapeutic_classes as $key => $therapeutic_class)
                                    <tr>
                                        <td>
                                            {{ ++$key }}
                                        </td>
                                        <td>
                                            <a href="{{ route("admin.$module_path.show", $therapeutic_class->id) }}" >
                                                {{ $therapeutic_class->name }}
                                            </a>
                                        </td>
                                        <td>
                                            @if($therapeutic_class->status && $therapeutic_class->status == 1)
                                                {!! 'Active' !!}
                                            @else
                                                {!! 'Not Active' !!}
                                            @endif
                                        </td>
                                        <td style="width: 120px;">
                                            <a class="btn btn-xs btn-primary" data-toggle="tooltip" data-placement="top" title="Edit" href="{{ route("admin.$module_path.edit", $therapeutic_class->id) }}">
                                                <i class="fa fa-pencil"></i>
                                                {!! 'Edit' !!}
                                            </a>
                                            <a class="btn btn-xs btn-info" data-toggle="tooltip" data-placement="top" title="Show" href="{{ route("admin.$module_path.show", $therapeutic_class->id) }}">
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
                            <h1 style="opacity: 0.3">You don't have any Therapeutic Class info. created yet.</h1>
                            <a href="{!! route("admin.$module_path.create") !!}" type="button" class="btn btn-default">
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
            $('#therapeutic-class-table').DataTable();
        });
    </script>
@stop

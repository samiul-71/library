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
                        <a href="{!! route('admin.lab-test.create') !!}" class="btn btn-xs btn-success">
                            <i class="fa fa-plus"></i> {!! trans('labels.general.buttons.lab-test.create') !!}
                        </a>
                        <a href="{!! route("admin.lab-test.trash") !!}" class="btn btn-xs btn-danger">
                            <i class="fa fa-trash"></i> {!! trans('labels.general.buttons.trash') !!}
                        </a>
                    </div>

                </div>
                <div class="box-body">
                    @if(count($lab_tests))
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover table-condensed lab-test-table" id="lab-test-table">
                                <thead>
                                <tr>
                                    <th>SL.</th>
                                    <th>Test Name</th>
                                    <th>Code</th>
                                    <th>Test Category</th>
                                    <th>Methodology</th>
                                    <th>Cost</th>
                                    <th>Status</th>
                                    <th class="text-center" style="width: 120px;">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach( $lab_tests as $key => $lab_test)
                                    <tr>
                                        <td>
                                            {{ ++$key }}
                                        </td>
                                        <td>
                                            <a href="{{ route("admin.lab-test.show", $lab_test->id) }}" >
                                                {!! $lab_test->test_name !!}
                                            </a>
                                        </td>
                                        <td>
                                            {!! $lab_test->code !!}
                                        </td>
                                        <td>
                                            {!! $lab_test->test_category_name !!}
                                        </td>
                                        <td>
                                            {!! $lab_test->methodology !!}
                                        </td>
                                        <td>
                                            {!! $lab_test->currency !!}
                                            {!! $lab_test->cost !!}
                                        </td>
                                        <td>
                                            @if($lab_test->status && $lab_test->status == 1)
                                                {!! 'Active' !!}
                                            @else
                                                {!! 'Not Active' !!}
                                            @endif
                                        </td>
                                        <td style="width: 120px;">
                                            <a class="btn btn-xs btn-primary" data-toggle="tooltip" data-placement="top" title="Edit" href="{{ route("admin.lab-test.edit", $lab_test->id) }}">
                                                <i class="fa fa-pencil"></i>
                                                {!! 'Edit' !!}
                                            </a>
                                            <a class="btn btn-xs btn-info" data-toggle="tooltip" data-placement="top" title="Show" href="{{ route("admin.lab-test.show", $lab_test->id) }}">
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
                            <h1 style="opacity: 0.3">You don't have any lab test created yet.</h1>
                            <a href="{!! route('admin.lab-test.create') !!}" type="button" class="btn btn-default">
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
            $('#lab-test-table').DataTable();
        });
    </script>
@stop

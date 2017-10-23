@extends ('backend.layouts.app')

@section ('title', ucfirst($module_title) . ' ' . ucfirst($module_action))

@section('page-header')
    <h1>
        <i class="{{ $module_icon }}"></i> {{ ucfirst($module_title) }}
        <small>{{ ucfirst($module_action) }}</small>
    </h1>
@endsection

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <strong>{{ ucfirst($module_action) }}</strong>
            <div class="box-tools pull-right">
                <a href="{!! route('admin.medicine-type.create') !!}" class="btn btn-xs btn-success">
                    <i class="fa fa-plus"></i> {!! 'Create New' !!}
                </a>
                <a href="{!! route('admin.medicine-type.index') !!}" class="btn btn-xs btn-info">
                    <i class="fa fa-list"></i> {!! 'Back to List' !!}
                </a>
                <a href="{!! route("admin.medicine-type.trash") !!}" class="btn btn-xs btn-danger">
                    <i class="fa fa-trash"></i> {!! 'Trash List' !!}
                </a>
            </div>
        </div><!-- /.box-header -->
        <div class="box-body">

            {!! Form::model($medicine_type, ['method' => 'PUT', 'route' => ["admin.medicine-type.update", $medicine_type->id], 'class' => 'form', 'role' => 'form']) !!}

            @include("backend.admin.medicines.medicine-types.form")

            {!! Form::close() !!}

        </div><!-- /.box-body -->
    </div><!--box box-success-->
@endsection

@section('after-scripts-end')
    <script>

        $('.form').validator();

    </script>

@endsection
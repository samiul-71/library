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
        </div><!-- /.box-header -->
        <div class="box-body">

            {!! Form::open(['route' => ["admin.indications.store"], 'class' => 'form', 'role' => 'form']) !!}

            @include("backend.admin.medicines.indications.form")

            {!! Form::close() !!}

        </div><!-- /.box-body -->
    </div><!--box box-success-->
@endsection

@section('after-scripts')
    <script>

        $('.form').validator();

    </script>

@endsection
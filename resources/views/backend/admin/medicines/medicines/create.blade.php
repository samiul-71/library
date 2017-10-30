@extends ('backend.layouts.app')

@section ('title', ucfirst($module_title) . ' ' . ucfirst($module_action))

@section('page-header')
    <h1>
        <i class="{{ $module_icon }}"></i> {{ ucfirst($module_title) }}
        <small>{{ ucfirst($module_action) }}</small>
    </h1>
@endsection

@section('after-styles')
    <link rel="stylesheet" type="text/css" href="/public/plugins/MultiSelect/jquery.dropdown.css">
@endsection

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <strong>{{ ucfirst($module_action) }}</strong>
        </div><!-- /.box-header -->
        <div class="box-body">

            {!! Form::open(['route' => ["admin.medicine.store"], 'class' => 'form', 'role' => 'form']) !!}

            @include("backend.admin.medicines.medicines.form")

            {!! Form::close() !!}

        </div><!-- /.box-body -->
    </div><!--box box-success-->
@endsection

@section('after-scripts')
    {!! Html::script('plugins/MultiSelect/jquery.dropdown.js') !!}
    <script>

        $('.select2').select2();

//        $('.form').validator();

        $('.indications_keyword').dropdown({
            multipleMode: 'label',
            readOnly: false,
            limitCount: Infinity,
            searchable: true
        });

    </script>

@endsection
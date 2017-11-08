@extends ('backend.layouts.app')

@section ('title', ucfirst($module_title) . ' ' . ucfirst($module_action))

@section('page-header')
    <h1>
        <i class="{{ $module_icon }}"></i> {{ ucfirst($module_title) }}
        <small>{{ ucfirst($module_action) }}</small>
    </h1>
@endsection

@section('after-styles')
    <style>
        .form-group {
            min-height: 60px;
        }
    </style>
@endsection

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <strong>{{ ucfirst($module_action) }}</strong>
        </div><!-- /.box-header -->
        <div class="box-body">

            {!! Form::open(['route' => ["admin.$module_path.store"], 'class' => 'form', 'role' => 'form']) !!}

            @include("backend.admin.medicines.$module_path.form")

            {!! Form::close() !!}

        </div><!-- /.box-body -->
    </div><!--box box-success-->
@endsection

@section('after-scripts')
    <script>
            var count = 1;
            $('#parent_id').change(function (){
                var selectedVal = $('#parent_id').find(":selected").val();
                if (selectedVal !== ""){
                    count++;
                    $( ".append_temp" ).clone().appendTo( $(".mashb" )).removeClass('append_temp').attr('id', count);
                    $('#' + count).css('visibility', 'visible');
                    // $(".append_temp").css('visibility', 'visible');
                }
            });

    </script>

@endsection
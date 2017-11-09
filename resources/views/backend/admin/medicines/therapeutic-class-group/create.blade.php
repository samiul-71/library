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
        (function() {
            $('body').on('change', '.parent_id', function () {
                var selectedVal = $(this).find(":selected").val();
                var parent = $(this);
                if (selectedVal !== "") {
                    var URL = "{{ url('admin/therapeutic-class-group/getChildren') }}" + "/" + selectedVal;
                    $.ajax({
                        type: "GET",
                        url: URL,
                        success: function(data){
                            console.log(data);
                            if(data.length !== 0) {
                                parent.removeClass('parent_id').removeAttr('name').attr("disabled", true);
                                $(".append_temp")
                                    .clone()
                                    .appendTo($(".parent_therapeutic_class_group"))
                                    .removeClass('append_temp')
                                    .addClass('parent_id')
                                    .css('visibility', 'visible');
                                for (var key in data) {
                                    $(".parent_id").append($('<option>', {
                                        value: key,
                                        text : data[key]
                                    }));
                                }
                                $(".parent_id").attr('name', 'parent_id');

                            }
                        }
                    });
                }
            });
        })();

        function dadaReset() {
            $("#parent_id")
                .attr('class', 'form-control parent_id')
                .attr('name', 'parent_id')
                .removeAttr('disabled')
                .siblings()
                .not(':first')
                .remove();
        }
    </script>

@endsection
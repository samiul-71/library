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
            <div class="box-tools pull-right">
                <a href="{!! route("admin.$module_path.create") !!}" class="btn btn-xs btn-success">
                    <i class="fa fa-plus"></i> {!! 'Create New' !!}
                </a>
                <a href="{!! route("admin.$module_path.index") !!}" class="btn btn-xs btn-info">
                    <i class="fa fa-list"></i> {!! 'Back to List' !!}
                </a>
                <a href="{!! route("admin.$module_path.trash") !!}" class="btn btn-xs btn-danger">
                    <i class="fa fa-trash"></i> {!! 'Trash List' !!}
                </a>
            </div>
        </div><!-- /.box-header -->
        <div class="box-body">

            {!! Form::model($therapeutic_class_groups, ['method' => 'PUT', 'route' => ["admin.$module_path.update", $therapeutic_class_groups->id], 'class' => 'form', 'role' => 'form']) !!}

            @include("backend.admin.medicines.$module_path.form")

            {!! Form::close() !!}

        </div><!-- /.box-body -->
    </div><!--box box-success-->
@endsection

@section('after-scripts')
    <script>
        var parentElement = $('.parent_therapeutic_class_group');
        $(document).ready(function() {
            parentElement.detach();

            $('.clearParent').click(function () {
                $('.clearParent').remove();
                $('.previous_parent_id').remove();
                $('.mashb').append(parentElement);
            });

            // Delete a Record
            $('.record-destroy').on("click", function(ev){
                ev.preventDefault();
                var URL = $(this).attr('href');
                var redirectURL = "{{ route("admin.$module_path.index") }}";
                warnBeforeRedirect(URL, redirectURL);
            });

            // Warn before Delete Record and Redirect
            function warnBeforeRedirect(URL, redirectURL) {
                swal({
                    title: "Are you sure?",
                    text: "By clicking to confirm, You will delete the record.",
                    type: "info",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Yes, delete it!",
                    closeOnConfirm: false,
                    closeOnCancel: false,
                    showLoaderOnConfirm: true
                }, function(isConfirm) {
                    if (isConfirm) {
                        $.ajax({
                            type: "DELETE",
                            url: URL,
                            success: function(){
//                                console.log(data);
                                swal("Submitted!", "Selected record has been deleted successfully.", "success");
                                window.location.href = redirectURL;
                            }
                        })
                    } else {
                        swal("Cancelled", "Action Cancelled.", "error");
                    }
                });
            }
        });

        (function() {
            $('body').on('change', '.parent_id', function () {
                var selectedVal = $(this).find(":selected").val();
                var parent = $(this);
                if (selectedVal !== "no_parent") {
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

        function resetFields() {
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
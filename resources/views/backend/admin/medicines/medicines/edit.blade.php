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
                <a href="{!! route('admin.medicine.create') !!}" class="btn btn-xs btn-success">
                    <i class="fa fa-plus"></i> {!! 'Create New' !!}
                </a>
                <a href="{!! route('admin.medicine.index') !!}" class="btn btn-xs btn-info">
                    <i class="fa fa-list"></i> {!! 'Back to List' !!}
                </a>
                <a href="{!! route("admin.medicine.trash") !!}" class="btn btn-xs btn-danger">
                    <i class="fa fa-trash"></i> {!! 'Trash List' !!}
                </a>
            </div>
        </div><!-- /.box-header -->
        <div class="box-body">

            {!! Form::model($medicine, ['method' => 'PUT', 'route' => ["admin.medicine.update", $medicine->id], 'class' => 'form', 'role' => 'form']) !!}

            @include("backend.admin.medicines.medicines.form")

            {!! Form::close() !!}

        </div><!-- /.box-body -->
    </div><!--box box-success-->
@endsection

@section('after-scripts')
    <script>

        $('.select2').select2();

        $(document).ready(function() {

//            $('.form').validator();


            // Delete a Record
            $('.record-destroy').on("click", function(ev){
                ev.preventDefault();
                var URL = $(this).attr('href');
                var redirectURL = "{{ route('admin.medicine.index') }}";
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

    </script>

@endsection
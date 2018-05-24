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

    </style>
@endsection

@section('content')
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">{!! ucfirst($module_title) !!} {!! ucfirst($module_action) !!}</h3>
            <div class="box-tools pull-right">
                <a href="{!! route('admin.lab-test-category.create') !!}" class="btn btn-xs btn-success">
                    <i class="fa fa-plus"></i> {!! 'Create New' !!}
                </a>
                <a href="{!! route('admin.lab-test-category.index') !!}" class="btn btn-xs btn-info">
                    <i class="fa fa-list"></i> {!! 'Back to List' !!}
                </a>
                <a href="{!! route("admin.lab-test-category.trash") !!}" class="btn btn-xs btn-danger">
                    <i class="fa fa-trash"></i> {!! 'Trash List' !!}
                </a>
            </div>
        </div>
        <div class="box-body">

            <div class="row">
                <div class="col-sm-8">
                    <div class="table-responsive">
                        <table class="table ">
                            <tbody>
                            <tr>
                                <td>
                                    <strong>Name</strong>
                                </td>
                                <td> : </td>
                                <td>
                                    {{ $labTestCategory->name }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>Code</strong>
                                </td>
                                <td> : </td>
                                <td>
                                    {{ $labTestCategory->code }}
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <strong>Description</strong>
                                </td>
                                <td> : </td>
                                <td>
                                    {{ $labTestCategory->description }}
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <strong>Status</strong>
                                </td>
                                <td> : </td>
                                <td>
                                    @if($labTestCategory->status && $labTestCategory->status == 1)
                                        <span class="label label-primary">{!! 'Active' !!}</span>
                                    @else
                                        <span class="label label-warning">{!! 'Not Active' !!}</span>
                                    @endif
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="row text-center">
                <div class="col-sm-12 text-center">
                    <a href="{!! route('admin.lab-test-category.edit', $labTestCategory->id) !!}" class="btn btn-xs btn-primary">
                        <i class="fa fa-pencil"></i> {!! 'Edit/Update' !!}
                    </a>
                    <a href="{!! route('admin.lab-test-category.destroy', $labTestCategory->id) !!}" class="btn btn-xs btn-danger record-destroy" id="record-destroy" title="Move to Trash" data-toggle="tooltip" data-placement="top">
                        <i class="fa fa-trash"></i> {!! 'Move to Trash' !!}
                    </a>
                </div>
            </div>

        </div><!-- /.box-body -->
    </div><!--box box-success-->
@endsection

@section('after-scripts')
    <script>
        $(document).ready(function() {
            // Delete a Record
            $('.record-destroy').on("click", function(ev){
                ev.preventDefault();
                var URL = $(this).attr('href');
                var redirectURL = "{{ route('admin.lab-test-category.index') }}";
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
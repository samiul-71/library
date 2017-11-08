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
                        <a href="{!! route('admin.allergies.create') !!}" class="btn btn-xs btn-success">
                            <i class="fa fa-plus"></i> {!! trans('labels.general.buttons.allergies.create') !!}
                        </a>
                        <a href="{!! route('admin.allergies.index') !!}" class="btn btn-xs btn-info">
                            <i class="fa fa-list"></i> {!! 'Back to List' !!}
                        </a>
                    </div>

                </div>
                <div class="box-body">
                    @if(count($allergies))
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover table-condensed allergies-table" id="allergies-table">
                                <thead>
                                <tr>
                                    <th>SL.</th>
                                    <th>Code</th>
                                    <th>Allergy Cause Title</th>
                                    <th>Status</th>
                                    <th class="text-center" style="width: 120px;">Action</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach( $allergies as $key => $allergy)
                                    <tr>
                                        <td>
                                            {{ ++$key }}
                                        </td>
                                        <td>
                                            {!! $allergy->allergy_code !!}
                                        </td>
                                        <td>
                                            {!! $allergy->allergy_cause_title !!}
                                        </td>
                                        <td>
                                            @if($allergy->status && $allergy->status == 1)
                                                {!! 'Active' !!}
                                            @else
                                                {!! 'Not Active' !!}
                                            @endif
                                        </td>
                                        <td style="width: 140px;">
                                            <a class="btn btn-info btn-xs  record-restore" data-toggle="tooltip" data-placement="top" title="Restore" href="{{ route("admin.allergies.restore", $allergy->id) }}">
                                                <i class="fa fa-refresh"></i> Restore
                                            </a>
                                            <a class="btn btn-danger btn-xs record-delete" data-toggle="tooltip" data-placement="top" title="Delete" href="{{ route("admin.allergies.permanently-delete", $allergy->id) }}">
                                                <i class="fa fa-trash"></i> Delete
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="col-sm-12 text-center" style="padding: 150px 0;">
                            <h1 style="opacity: 0.3">You don't have any Deleted Allergy Information.</h1>
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
//            $('#medicine-type-table').DataTable();

            // delete a record
            $("body").on("click", ".record-delete", function(e) {
                e.preventDefault();
                var redirectURL = "{{ route('admin.allergies.trash') }}";
                var linkURL = $(this).attr("href");
                swal({
                    title: "{{ trans('strings.backend.general.are_you_sure') }}",
                    text: "{{ trans('strings.backend.general.alert_sms.delete_record_confirm') }}",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "{{ trans('strings.backend.general.continue') }}",
                    cancelButtonText: "{{ trans('buttons.general.cancel') }}",
                    closeOnConfirm: false
                }, function(isConfirmed) {
                    if (isConfirmed) {
                        $.ajax({
                            type: "DELETE",
                            url: linkURL,
                            success: function() {
                                swal("Submitted!", "Selected record has been permanently deleted successfully.", "success");
                                window.location.href = redirectURL;
                            }
                        })
                    } else {
                        swal("Cancelled", "Action Cancelled.", "error");
                    }
                });
            });

            // restore a record
            $("body").on("click", ".record-restore", function(e) {
                e.preventDefault();
                var redirectURL = "{{ route('admin.allergies.trash') }}";
                var linkURL = $(this).attr("href");

                swal({
                    title: "{{ trans('strings.backend.general.are_you_sure') }}",
                    text: "{{ trans('strings.backend.general.alert_sms.restore_record_confirm') }}",
                    type: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "{{ trans('strings.backend.general.continue') }}",
                    cancelButtonText: "{{ trans('buttons.general.cancel') }}",
                    closeOnConfirm: false
                }, function(isConfirmed){
                    if (isConfirmed){
                        $.ajax({
                            type: "PATCH",
                            url: linkURL,
                            success: function() {
                                swal("Submitted!", "Selected record has been restored successfully.", "success");
                                window.location.href = redirectURL;
                            }
                        })
                    } else {
                        swal("Cancelled", "Action Cancelled.", "error");
                    }
                });
            });



        });
    </script>
@stop

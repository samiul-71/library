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
        </div>
        <div class="box-body">

            <div class="row">
                <div class="col-sm-8">
                    <div class="table-responsive">
                        <table class="table">
                            <tbody>
                            <tr>
                                <td class="pull-right">
                                    <strong>Medicine Name</strong>
                                </td>
                                <td> : </td>
                                <td>
                                    {{ ucwords($medicine->name) }} {!! $medicine->strength !!} ({!! $medicine->medicine_type_name !!})
                                </td>
                            </tr>
                            <tr>
                                <td class="pull-right">
                                    <strong>Code</strong>
                                </td>
                                <td> : </td>
                                <td>
                                    {{ $medicine->code }}
                                </td>
                            </tr>
                            <tr>
                                <td class="pull-right">
                                    <strong>Generic Name</strong>
                                </td>
                                <td> : </td>
                                <td>
                                    {!! $medicine->generic_name !!}
                                </td>
                            </tr>
                            <tr>
                                <td class="pull-right">
                                    <strong>Description</strong>
                                </td>
                                <td> : </td>
                                <td>
                                    {{ $medicine->description }}
                                </td>
                            </tr>
                            <tr>
                                <td class="pull-right">
                                    <strong>Status</strong>
                                </td>
                                <td> : </td>
                                <td>
                                    @if($medicine->status && $medicine->status == 1)
                                        <span class="label label-primary">{!! 'Publish' !!}</span>
                                    @else
                                        <span class="label label-warning">{!! 'Not Publish' !!}</span>
                                    @endif
                                </td>
                            </tr>

                            <tr>
                                <td class="pull-right">
                                    <strong>Indications</strong>
                                </td>
                                <td> : </td>
                                <td>
                                    {{--{!! dd($medicine) !!}--}}
                                    {{--Multiple Keywords will be with Comma (,) Separator--}}
                                    @foreach($medicine->indications_keywords as $keyword)
                                        {{--{{ $keyword }},&nbsp;--}}
                                        <li><ol style="padding: 0; margin-bottom: 5px;">{{ $keyword }}</ol></li>
                                    @endforeach
                                    <br>
                                    <p> {{ $medicine->indications_details }} </p>
                                </td>
                            </tr>

                            <tr>
                                <td class="pull-right">
                                    <strong>Dosages</strong>
                                </td>
                                <td> : </td>
                                <td>
                                    Adult Dose : {{ $medicine->adult_dose }}<br>
                                    Child Dose : {{ $medicine->child_dose }}<br>
                                    Renal Dose: {{ $medicine->renal_dose }}
                                </td>
                            </tr>

                            <tr>
                                <td class="pull-right">
                                    <strong>Side Effect(s)</strong>
                                </td>
                                <td> : </td>
                                <td>
                                    {{ $medicine->side_effects }}
                                </td>
                            </tr>

                            <tr>
                                <td class="pull-right">
                                    <strong>Precautions</strong>
                                </td>
                                <td> : </td>
                                <td>
                                    {{ $medicine->precautions }}
                                </td>
                            </tr>

                            <tr>
                                <td class="pull-right">
                                    <strong>Administration</strong>
                                </td>
                                <td> : </td>
                                <td>
                                   {{ $medicine->administration }}
                                </td>
                            </tr>


                            <tr>
                                <td class="pull-right">
                                    <strong>Ingredients</strong>
                                </td>
                                <td> : </td>
                                <td>
                                    {{ $medicine->ingredients }}
                                </td>
                            </tr>


                            <tr>
                                <td class="pull-right">
                                    <strong>Contraindications</strong>
                                </td>
                                <td> : </td>
                                <td>
                                    {{ $medicine->contraindications }}
                                </td>
                            </tr>

                            <tr>
                                <td class="pull-right">
                                    <strong>Pregnancy Category</strong>
                                </td>
                                <td> : </td>
                                <td>
                                    {{ $medicine->pregnancy_category }}
                                </td>
                            </tr>

                            <tr>
                                <td class="pull-right">
                                    <strong>Therapeutic Class</strong>
                                </td>
                                <td> : </td>
                                <td>
                                    {{ $medicine->therapeutic_class }}
                                </td>
                            </tr>

                            <tr>
                                <td class="pull-right">
                                    <strong>Mode of Actions</strong>
                                </td>
                                <td> : </td>
                                <td>
                                    {{ $medicine->mode_of_actions }}
                                </td>
                            </tr>

                            <tr>
                                <td class="pull-right">
                                    <strong>Interactions</strong>
                                </td>
                                <td> : </td>
                                <td>
                                    {{ $medicine->interactions }}
                                </td>
                            </tr>
                            <tr>
                                <td class="pull-right">
                                    <strong>Pack Size</strong>
                                </td>
                                <td> : </td>
                                <td>
                                    {{ $medicine->pack_size }} units
                                </td>
                            </tr>
                            <tr>
                                <td class="pull-right">
                                    <strong>No. Per Unit</strong>
                                </td>
                                <td> : </td>
                                <td>
                                    {{ $medicine->no_per_unit }}
                                </td>
                            </tr>
                            <tr>
                                <td class="pull-right">
                                    <strong>Price</strong>
                                </td>
                                <td> : </td>
                                <td>
                                    {{ $medicine->currency }}
                                    {{ $medicine->unit_price }}
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="col-sm-4">
                    <img class="thumbnail" src="{!! 'http://placehold.it/300x300' !!}" alt="Medicine Image">
{{--                    <img class="thumbnail" src="{!! (isset($medicine) && $medicine->image !=null) ? url('/').medicineImagePath().$medicine->image : 'http://placehold.it/300x300' !!}" alt="Organization Image">--}}
                </div>
            </div>

            <div class="row text-center">
                <div class="col-sm-12 text-center">
                    <a href="{!! route('admin.medicine.edit', $medicine->id) !!}" class="btn btn-xs btn-primary">
                        <i class="fa fa-pencil"></i> {!! 'Edit/Update' !!}
                    </a>
                    <a href="{!! route('admin.medicine.destroy', $medicine->id) !!}" class="btn btn-xs btn-danger record-destroy" id="record-destroy" title="Move to Trash" data-toggle="tooltip" data-placement="top">
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
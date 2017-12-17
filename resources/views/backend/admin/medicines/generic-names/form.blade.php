
<div class="row">
    <div class="col-sm-12">
        <div class="form-group row">
            <div class="form-group col-sm-12">
                {!! Form::label('name', 'Generic Name', ['class' => 'col-sm-2 col-form-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('name', old('name'), ['id'=>'name', 'class' => 'form-control name', 'placeholder' => 'Generic Name', 'required' => 'required', 'data-error' => 'Name Must be Alphabetical']) !!}
                </div>
                <div class="col-sm-4">
                    {!! Form::text('code', old('code'), ['id'=>'code', 'class' => 'form-control code', 'placeholder' => 'Generic Name Code', 'required' => 'required']) !!}
                </div>
            </div>
            <div class="form-group col-sm-12">
                {!! Form::label('description', 'Description', ['class' => 'col-sm-2 col-form-label']) !!}
                <div class="col-sm-10">
                    {!! Form::textarea('description', old('description'), ['id'=>'description', 'class' => 'form-control description', 'placeholder' => 'Enter Description', 'rows' => 2]) !!}
                </div>
            </div>
            <div class="form-group col-sm-12">
                {!! Form::label('indications_ids', 'Choose Indication Keyword(s)', ['class' => 'col-sm-2 col-form-label']) !!}
                <div class="col-sm-10 indications_keyword">
                    {!! Form::select('indications_ids[]', $indications, old('indications_ids[]'), ['id'=>'indications_keyword', 'class' => 'form-control indications_keyword', 'multiple' => 'multiple']) !!}
                </div>
            </div>
            <div class="form-group col-sm-12">
                {!! Form::label('therapeutic_class_ids', 'Choose Therapeutic Classes', ['class' => 'col-sm-2 col-form-label']) !!}
                <div class="col-sm-8 therapeutic_classes">
                    {!! Form::select('therapeutic_class_ids[]', $therapeutic_classes, old('therapeutic_class_ids[]'), ['id'=>'therapeutic_class_names', 'class' => 'form-control therapeutic_class_names', 'multiple' => 'multiple']) !!}
                </div>
                <div class="col-sm-2">
                    {!! Form::label('', '', ['class' => 'col-form-label']) !!}<br>
                    @if(isset($generic_name))
                        {!! Form::radio('status', '1', (old('status') ==  '1'), array('id'=>'status')) !!} Active
                        {!! Form::radio('status', '0', (old('status') ==  '0'), array('id'=>'status')) !!} Not Active
                    @else
                        {{ Form::radio('status', 1, true) }} Active
                        {{ Form::radio('status', 0) }} Not Active
                    @endif
                </div>
            </div>
            {{--<div class="form-group col-sm-12">--}}
                {{--<div class="col-sm-4">--}}
                    {{--{!! Form::label('status', 'Status', ['class' => 'col-form-label']) !!}<br>--}}
                    {{--@if(isset($generic_name))--}}
                        {{--{!! Form::radio('status', '1', (old('status') ==  '1'), array('id'=>'status')) !!} Active--}}
                        {{--{!! Form::radio('status', '0', (old('status') ==  '0'), array('id'=>'status')) !!} Not Active--}}
                    {{--@else--}}
                        {{--{{ Form::radio('status', 1, true) }} Active--}}
                        {{--{{ Form::radio('status', 0) }} Not Active--}}
                    {{--@endif--}}
                {{--</div>--}}
            {{--</div>--}}
        </div>

        <div class="col-sm-12">
            <div class="form-group text-center">
                @if(isset($generic_name))
                    <button type="button" class="btn btn-xs btn-warning" onclick="history.back(-1)"><i class="fa fa-reply"></i> Cancel</button>
                    {!! Form::button("<i class='fa fa-plus'></i> Update", ['class' => 'btn btn-xs btn-success', 'type'=>'submit']) !!}
                    <a href="{!! route('admin.generic-name.destroy', $generic_name->id) !!}" class="btn btn-xs btn-danger record-destroy" id="record-destroy" title="Move to Trash" data-toggle="tooltip" data-placement="top">
                        <i class="fa fa-trash"></i> {!! 'Move to Trash' !!}
                    </a>
                @else
                    <button type="button" class="btn btn-xs btn-warning" onclick="history.back(-1)"><i class="fa fa-reply"></i> Cancel</button>
                    {!! Form::button("<i class='fa fa-plus'></i> Create", ['class' => 'btn btn-xs btn-success', 'type'=>'submit']) !!}
                    <button type="reset" class="btn btn-xs btn-info"><i class="fa fa-refresh"></i> Reset </button>
                @endif
            </div>
        </div>
    </div>
</div>
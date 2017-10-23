
<div class="row">
    <div class="col-sm-12">
        <div class="form-group row">
            <div class="form-group col-sm-12">
                {!! Form::label('name', 'Name', ['class' => 'col-sm-2 col-form-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('name', old('name'), ['id'=>'name', 'class' => 'form-control name', 'placeholder' => 'Medicine Type Name', 'required' => 'required', 'data-error' => 'Name Must be Alphabetical']) !!}
                </div>
                <div class="help-block with-errors"></div>
                <div class="col-sm-3">
                    {!! Form::text('code', old('code'), ['id'=>'code', 'class' => 'form-control code', 'placeholder' => 'Medicine Type Code']) !!}
                </div>
            </div>
            <div class="form-group col-sm-12">
                {!! Form::label('description', 'Description', ['class' => 'col-sm-2 col-form-label']) !!}
                <div class="col-sm-6">
                    {!! Form::textarea('description', old('description'), ['id'=>'description', 'class' => 'form-control description', 'placeholder' => 'Medicine Type Description', 'rows' => 2]) !!}
                </div>
                <div class="col-sm-4">
                    {!! Form::label('', '', ['class' => 'col-form-label']) !!}<br>
                    @if(isset($medicine_type))
                        {!! Form::radio('status', '1', (old('status') ==  '1'), array('id'=>'status')) !!} Active
                        {!! Form::radio('status', '0', (old('status') ==  '0'), array('id'=>'status')) !!} Not Active
                    @else
                        {{ Form::radio('status', 1, true) }} Active
                        {{ Form::radio('status', 0) }} Not Active
                    @endif
                </div>
            </div>
        </div>

        <div class="col-sm-12">
            <div class="form-group text-center">
                @if(isset($medicine_type))
                    <button type="button" class="btn btn-xs btn-warning" onclick="history.back(-1)"><i class="fa fa-reply"></i> Cancel</button>
                    {!! Form::button("<i class='fa fa-plus'></i> Update", ['class' => 'btn btn-xs btn-success', 'type'=>'submit']) !!}
                    <a href="{!! route('admin.medicine-type.destroy', $medicine_type->id) !!}" class="btn btn-xs btn-danger record-destroy" id="record-destroy" title="Move to Trash" data-toggle="tooltip" data-placement="top">
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
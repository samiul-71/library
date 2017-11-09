
<div class="form-row">
    <div class="form-group col-md-6">
        {!! Form::label('name', 'Therapeutic Class Group') !!}
        {!! Form::text('name', old('name'), ['id'=>'name', 'class' => 'form-control name', 'placeholder' => 'Therapeutic Class Group name', 'required' => 'required']) !!}
    </div>
    <div class="form-group col-md-6">
        {!! Form::label('status', 'Status', ['class' => 'col-form-label']) !!}<br>
        @if(isset($therapeutic_class_groups))
            {!! Form::radio('status', '1', (old('status') ==  '1'), array('id'=>'status')) !!} Active
            {!! Form::radio('status', '0', (old('status') ==  '0'), array('id'=>'status')) !!} Not Active
        @else
            {{ Form::radio('status', 1, true) }} Active
            {{ Form::radio('status', 0) }} Not Active
        @endif
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-6 parent_therapeutic_class_group">
        {!! Form::label('parent_id', 'Select Parent Therapeutic Class Group (If Any)') !!}
        {!! Form::select('parent_id', ['' => 'Choose Therapeutic Class Group'] + $therapeutic_class_group_parents, old('parent_id'), ['id' => 'parent_id', 'class' => 'form-control parent_id'])  !!}
    </div>
</div>
<div class="col-sm-12">
    <div class="form-group text-center">
        @if(isset($therapeutic_class_groups))
            <button type="button" class="btn btn-xs btn-warning" onclick="history.back(-1)"><i class="fa fa-reply"></i> Cancel</button>
            {!! Form::button("<i class='fa fa-plus'></i> Update", ['class' => 'btn btn-xs btn-success', 'type'=>'submit']) !!}
            <a href="{!! route("admin.$module_path.destroy", $therapeutic_class_groups->id) !!}" class="btn btn-xs btn-danger record-destroy" id="record-destroy" title="Move to Trash" data-toggle="tooltip" data-placement="top">
                <i class="fa fa-trash"></i> {!! 'Move to Trash' !!}
            </a>
        @else
            <button type="button" class="btn btn-xs btn-warning" onclick="history.back(-1)"><i class="fa fa-reply"></i> Cancel</button>
            {!! Form::button("<i class='fa fa-plus'></i> Create", ['class' => 'btn btn-xs btn-success', 'type'=>'submit']) !!}
            <button type="reset" class="btn btn-xs btn-info" onclick="dadaReset()"><i class="fa fa-refresh"></i> Reset </button>
        @endif
    </div>
</div>

<select class="form-control append_temp" style="visibility: hidden;">
    <option value="">Choose Therapeutic Class Group</option>
    {{--<option value="1">Test</option>--}}
</select>


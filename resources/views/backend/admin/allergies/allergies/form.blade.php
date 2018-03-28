<div class="form-row">
    <div class="form-group col-md-6">
        {!! Form::label('allergy_cause_title', 'Allergy Cause Title') !!}
        {!! Form::text('allergy_cause_title', old('allergy_cause_title'), ['id'=>'allergy_cause_title', 'class' => 'form-control allergy_cause_title', 'placeholder' => 'Cause of Allergy', 'required' => 'required']) !!}
    </div>
    <div class="form-group col-md-3">
        {!! Form::label('status', 'Status', ['class' => 'col-form-label']) !!}<br>
        @if(isset($allergies))
            {!! Form::radio('status', '1', (old('status') ==  '1'), array('id'=>'status')) !!} Active
            {!! Form::radio('status', '0', (old('status') ==  '0'), array('id'=>'status')) !!} Not Active
        @else
            {{ Form::radio('status', 1, true) }} Active
            {{ Form::radio('status', 0) }} Not Active
        @endif
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-12">
        {!! Form::label('description', 'Description') !!}
        {!! Form::textarea('description', old('description'), ['id'=>'description', 'class' => 'form-control description', 'placeholder' => 'Description', 'rows' => 3]) !!}
    </div>
</div>
<div class="col-sm-12">
    <div class="form-group text-center">
        @if(isset($allergies))
            <button type="button" class="btn btn-xs btn-warning" onclick="history.back(-1)"><i class="fa fa-reply"></i> Cancel</button>
            {!! Form::button("<i class='fa fa-plus'></i> Update", ['class' => 'btn btn-xs btn-success', 'type'=>'submit']) !!}
            <a href="{!! route('admin.allergies.destroy', $allergies->id) !!}" class="btn btn-xs btn-danger record-destroy" id="record-destroy" title="Move to Trash" data-toggle="tooltip" data-placement="top">
                <i class="fa fa-trash"></i> {!! 'Move to Trash' !!}
            </a>
        @else
            <button type="button" class="btn btn-xs btn-warning" onclick="history.back(-1)"><i class="fa fa-reply"></i> Cancel</button>
            {!! Form::button("<i class='fa fa-plus'></i> Create", ['class' => 'btn btn-xs btn-success', 'type'=>'submit']) !!}
            <button type="reset" class="btn btn-xs btn-info"><i class="fa fa-refresh"></i> Reset </button>
        @endif
    </div>
</div>


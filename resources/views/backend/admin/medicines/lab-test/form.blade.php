<div class="form-row">
    <div class="form-group col-md-6">
        {!! Form::label('test_name', 'Lab Test Name') !!}
        {!! Form::text('test_name', old('test_name'), ['id'=>'test_name', 'class' => 'form-control test_name', 'placeholder' => 'Name of the Lab Test', 'required' => 'required']) !!}
    </div>
    <div class="form-group col-md-6">
        {!! Form::label('test_category_id', 'Select Test Category') !!}
        {!! Form::select('test_category_id', ['' => 'Choose Test Category'] + $lab_test_categories, old('test_category_id'), ['id' => 'test_category_id', 'class' => 'form-control select2 test_category_id'])  !!}
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-12">
        {!! Form::label('description', 'Description') !!}
        {!! Form::textarea('description', old('description'), ['id'=>'description', 'class' => 'form-control description', 'placeholder' => 'Description', 'rows' => 3]) !!}
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-12">
        {!! Form::label('methodology', 'Methodology') !!}
        {!! Form::text('methodology', old('methodology'), ['id'=>'methodology', 'class' => 'form-control methodology', 'placeholder' => 'Methodology']) !!}
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-12">
        {!! Form::label('additional_information', 'Additional Information') !!}
        {!! Form::textarea('additional_information', old('additional_information'), ['id'=>'additional_information', 'class' => 'form-control additional_information', 'placeholder' => 'Additional Information (if any)', 'rows' => 2]) !!}
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-4">
        {!! Form::label('cost', 'Cost') !!}
        {!! Form::number('cost', old('cost'), ['id'=>'cost', 'class' => 'form-control cost', 'placeholder' => 'Cost']) !!}
    </div>
    <div class="form-group col-md-2">
        {!! Form::label('currency', 'Currency') !!}
        {!! Form::select('currency', ['BDT' => 'BDT', 'GBP' => 'GBP', 'USD' => 'USD'], old('currency'), ['id'=>'currency', 'class' => 'form-control'])  !!}
    </div>
    <div class="form-group col-md-6">
        {!! Form::label('status', 'Status', ['class' => 'col-form-label']) !!}<br>
        @if(isset($lab_tests))
            {!! Form::radio('status', '1', (old('status') ==  '1'), array('id'=>'status')) !!} Active
            {!! Form::radio('status', '0', (old('status') ==  '0'), array('id'=>'status')) !!} Not Active
        @else
            {{ Form::radio('status', 1, true) }} Active
            {{ Form::radio('status', 0) }} Not Active
        @endif
    </div>
</div>
<div class="col-sm-12">
    <div class="form-group text-center">
        @if(isset($lab_tests))
            <button type="button" class="btn btn-xs btn-warning" onclick="history.back(-1)"><i class="fa fa-reply"></i> Cancel</button>
            {!! Form::button("<i class='fa fa-plus'></i> Update", ['class' => 'btn btn-xs btn-success', 'type'=>'submit']) !!}
            <a href="{!! route('admin.lab-test.destroy', $lab_tests->id) !!}" class="btn btn-xs btn-danger record-destroy" id="record-destroy" title="Move to Trash" data-toggle="tooltip" data-placement="top">
                <i class="fa fa-trash"></i> {!! 'Move to Trash' !!}
            </a>
        @else
            <button type="button" class="btn btn-xs btn-warning" onclick="history.back(-1)"><i class="fa fa-reply"></i> Cancel</button>
            {!! Form::button("<i class='fa fa-plus'></i> Create", ['class' => 'btn btn-xs btn-success', 'type'=>'submit']) !!}
            <button type="reset" class="btn btn-xs btn-info"><i class="fa fa-refresh"></i> Reset </button>
        @endif
    </div>
</div>


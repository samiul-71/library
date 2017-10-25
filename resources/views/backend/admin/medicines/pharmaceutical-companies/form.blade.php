
<div class="form-row">
    <div class="form-group col-md-12">
        {!! Form::label('name', 'Name') !!}
        {!! Form::text('name', old('name'), ['id'=>'name', 'class' => 'form-control name', 'placeholder' => 'Name of the Pharmaceutical Company', 'required' => 'required']) !!}
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        {!! Form::label('registration_number', 'Registration Number') !!}
        {!! Form::text('registration_number', old('registration_number'), ['id'=>'registration_number', 'class' => 'form-control registration_number', 'placeholder' => 'Registration Number (if any)']) !!}
    </div>
    <div class="form-group col-md-6">
        {!! Form::label('phone', 'Phone no.') !!}
        {!! Form::text('phone', old('phone'), ['id'=>'phone', 'class' => 'form-control phone', 'placeholder' => 'Phone No.', 'required' => 'required']) !!}
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        {!! Form::label('address', 'Address') !!}
        {!! Form::text('address', old('address'), ['id'=>'address', 'class' => 'form-control address', 'placeholder' => 'Address of the company']) !!}
    </div>
    <div class="form-group col-md-6">
        {!! Form::label('company_type', 'Company type') !!}
        {!! Form::select('company_type', ['local' => 'Local', 'international' => 'International'], old('company_type'), ['class' => 'form-control']) !!}
    </div>
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        {!! Form::label('email', 'E-mail') !!}
        {!! Form::text('email', old('email'), ['id'=>'email', 'class' => 'form-control email', 'placeholder' => 'E-mail address', 'required' => 'required']) !!}
    </div>
    @if(!isset($pharmaceutical_companies))
        <div class="form-group col-md-6">
            {!! Form::label('password', 'Password') !!}
            {!! Form::password('password', ['id'=>'password', 'class' => 'form-control password', 'placeholder' => 'Password', 'required' => 'required']) !!}
        </div>
    @endif
</div>
<div class="form-row">
    <div class="form-group col-md-6">
        {!! Form::label('registration_status', 'Registration Status') !!}
        {!! Form::select('registration_status', ['applied' => 'Applied', 'approved' => 'Approved', 'pending' => 'Pending'], old('registration_status'), ['class' => 'form-control']) !!}
    </div>
    <div class="form-group col-md-6">
        {!! Form::label('status', 'Status', ['class' => 'col-form-label']) !!}<br>
        @if(isset($pharmaceutical_companies))
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
        @if(isset($pharmaceutical_companies))
            <button type="button" class="btn btn-xs btn-warning" onclick="history.back(-1)"><i class="fa fa-reply"></i> Cancel</button>
            {!! Form::button("<i class='fa fa-plus'></i> Update", ['class' => 'btn btn-xs btn-success', 'type'=>'submit']) !!}
            <a href="{!! route('admin.pharmaceutical-companies.destroy', $pharmaceutical_companies->id) !!}" class="btn btn-xs btn-danger record-destroy" id="record-destroy" title="Move to Trash" data-toggle="tooltip" data-placement="top">
                <i class="fa fa-trash"></i> {!! 'Move to Trash' !!}
            </a>
        @else
            <button type="button" class="btn btn-xs btn-warning" onclick="history.back(-1)"><i class="fa fa-reply"></i> Cancel</button>
            {!! Form::button("<i class='fa fa-plus'></i> Create", ['class' => 'btn btn-xs btn-success', 'type'=>'submit']) !!}
            <button type="reset" class="btn btn-xs btn-info"><i class="fa fa-refresh"></i> Reset </button>
        @endif
    </div>
</div>


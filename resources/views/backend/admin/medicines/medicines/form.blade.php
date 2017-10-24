<div class="row">
    <div class="col-sm-12">
        <div class="form-row">
            <div class="form-group col-md-3">
                {!! Form::label('name', 'Medicine Name') !!}
                {!! Form::text('name', old('name'), ['id'=>'name', 'class' => 'form-control name', 'placeholder' => 'Medicine Name', 'required' => 'required']) !!}
            </div>
            <div class="form-group col-md-3">
                {!! Form::label('strength', 'Strength') !!}
                {!! Form::text('strength', old('strength'), ['id'=>'strength', 'class' => 'form-control strength', 'placeholder' => 'Medicine Strength']) !!}
            </div>
            <div class="form-group col-md-3">
                {!! Form::label('name', 'Medicine Name') !!}
                {!! Form::text('name', old('name'), ['id'=>'name', 'class' => 'form-control name', 'placeholder' => 'Medicine Name', 'required' => 'required']) !!}
            </div>
            <div class="form-group col-md-3">
                {!! Form::label('strength', 'Strength') !!}
                {!! Form::text('strength', old('strength'), ['id'=>'strength', 'class' => 'form-control strength', 'placeholder' => 'Medicine Strength']) !!}
            </div>
        </div>



        <div class="form-group">
            <label for="inputAddress">Address</label>
            <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St">
        </div>
        <div class="form-group">
            <label for="inputAddress2">Address 2</label>
            <input type="text" class="form-control" id="inputAddress2" placeholder="Apartment, studio, or floor">
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="inputCity">City</label>
                <input type="text" class="form-control" id="inputCity">
            </div>
            <div class="form-group col-md-4">
                <label for="inputState">State</label>
                <select id="inputState" class="form-control">
                    <option selected>Choose...</option>
                    <option>...</option>
                </select>
            </div>
            <div class="form-group col-md-2">
                <label for="inputZip">Zip</label>
                <input type="text" class="form-control" id="inputZip">
            </div>
        </div>
        <div class="form-group">
            <div class="form-check">
                <label class="form-check-label">
                    <input class="form-check-input" type="checkbox"> Check me out
                </label>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Sign in</button>





        <div class="form-group row">
            <div class="form-group col-sm-12">
                {!! Form::label('name', 'Medicine Name', ['class' => 'col-sm-2 col-form-label']) !!}
                <div class="col-sm-6">
                    {!! Form::text('name', old('name'), ['id'=>'name', 'class' => 'form-control name', 'placeholder' => 'Medicine Name', 'required' => 'required']) !!}
                </div>
                <div class="col-sm-3">
                    {!! Form::text('code', old('code'), ['id'=>'code', 'class' => 'form-control code', 'placeholder' => 'Medicine Code']) !!}
                </div>
            </div>
            <div class="form-group col-sm-12">
                {!! Form::label('description', 'Description', ['class' => 'col-sm-2 col-form-label']) !!}
                <div class="col-sm-6">
                    {!! Form::textarea('description', old('description'), ['id'=>'description', 'class' => 'form-control description', 'placeholder' => 'Medicine Description', 'rows' => 2]) !!}
                </div>




                <div class="col-sm-4">
                    {!! Form::label('', '', ['class' => 'col-form-label']) !!}<br>
                    @if(isset($medicine))
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
                @if(isset($medicine))
                    <button type="button" class="btn btn-xs btn-warning" onclick="history.back(-1)"><i class="fa fa-reply"></i> Cancel</button>
                    {!! Form::button("<i class='fa fa-plus'></i> Update", ['class' => 'btn btn-xs btn-success', 'type'=>'submit']) !!}
                    <a href="{!! route('admin.generic-name.destroy', $medicine->id) !!}" class="btn btn-xs btn-danger record-destroy" id="record-destroy" title="Move to Trash" data-toggle="tooltip" data-placement="top">
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
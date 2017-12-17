
<div class="row">
    <div class="col-sm-12">
        <div class="form-group row">
            <div class="form-group col-sm-12">
                {!! Form::label('code', 'Indication Code', ['class' => 'col-sm-2 col-form-label']) !!}
                <div class="col-sm-3">
                    {!! Form::text('code', old('code'), ['id'=>'code', 'class' => 'form-control code', 'placeholder' => 'Indication Code', 'required' => 'required']) !!}
                </div>
                <div class="col-sm-4">
                    {!! Form::label('', '', ['class' => 'col-form-label']) !!}<br>
                    @if(isset($indications))
                        {!! Form::radio('status', '1', (old('status') ==  '1'), array('id'=>'status')) !!} Publish
                        {!! Form::radio('status', '0', (old('status') ==  '0'), array('id'=>'status')) !!} Do not Publish
                    @else
                        {{ Form::radio('status', 1, true) }} Publish
                        {{ Form::radio('status', 0) }} Do not Publish
                    @endif
                </div>
            </div>
            <div class="form-group col-sm-12">
                {!! Form::label('key_word', 'Key Word(s)', ['class' => 'col-sm-2 col-form-label']) !!}
                <div class="col-sm-6">
                    {!! Form::textarea('key_word', old('key_word'), ['id'=>'key_word', 'class' => 'form-control key_word', 'placeholder' => 'Key words to describe an Indication', 'required' => 'required', 'rows' => 2]) !!}
                </div>
            </div>
        </div>

        <div class="col-sm-12">
            <div class="form-group text-center">
                @if(isset($indications))
                    <button type="button" class="btn btn-xs btn-warning" onclick="history.back(-1)"><i class="fa fa-reply"></i> Cancel</button>
                    {!! Form::button("<i class='fa fa-plus'></i> Update", ['class' => 'btn btn-xs btn-success', 'type'=>'submit']) !!}
                    <a href="{!! route('admin.indications.destroy', $indications->id) !!}" class="btn btn-xs btn-danger record-destroy" id="record-destroy" title="Move to Trash" data-toggle="tooltip" data-placement="top">
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
<div class="row">
    <div class="col-sm-12">
        <div class="form-row">
            <div class="form-group col-md-3">
                {!! Form::label('name', 'Medicine Name') !!}
                {!! Form::text('name', old('name'), ['id'=>'name', 'class' => 'form-control name', 'placeholder' => 'Medicine Name', 'required' => 'required']) !!}
            </div>

            <div class="form-group col-md-3">
                {!! Form::label('strength', 'Strength') !!}
                {!! Form::text('strength', old('strength'), ['id'=>'strength', 'class' => 'form-control strength', 'placeholder' => 'Example : 500mg']) !!}
            </div>
            <div class="form-group col-md-2">
                {!! Form::label('pack_size', 'Pack Size') !!}
                {!! Form::text('pack_size', old('pack_size'), ['id'=>'pack_size', 'class' => 'form-control pack_size', 'placeholder' => 'Pack Size']) !!}
            </div>
            <div class="form-group col-md-2">
                {!! Form::label('unit_price', 'Unit Price') !!}
                {!! Form::text('unit_price', old('unit_price'), ['id'=>'unit_price', 'class' => 'form-control unit_price', 'placeholder' => 'Unit Price']) !!}
            </div>
            <div class="form-group col-md-2">
                {!! Form::label('currency', 'Currency') !!}
                {!! Form::select('currency', ['BDT' => 'BTD', 'USD' => 'USD'], old('currency'), ['id'=>'medicine_type', 'class' => 'form-control'])  !!}
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-3">
                {!! Form::label('medicine_type_id', 'Select Medicine Type') !!}
                {!! Form::select('medicine_type_id', ['' => 'Choose Medicine Type'] + $medicine_types, old('medicine_type_id'), ['id' => 'medicine_type', 'class' => 'form-control select2 medicine_type', 'required' => 'required'])  !!}
            </div>
            <div class="form-group col-md-3">
                {!! Form::label('generic_name_id', 'Select Generic Name') !!}
                {!! Form::select('generic_name_id', ['' => 'Choose Generic Name'] + $generic_names, old('generic_name_id'), ['id'=>'generic_name', 'class' => 'form-control select2 generic_name']) !!}
            </div>
            <div class="form-group col-md-3">
                {!! Form::label('pharma_id', 'Select Pharmaceuticals') !!}
                {!! Form::select('pharma_id', ['' => 'Choose Pharmaceuticals'] + $pharmaceuticals, old('pharma_id'), ['id'=>'pharmaceutical', 'class' => 'form-control select2 pharmaceutical']) !!}
            </div>
            <div class="form-group col-md-3">
            {!! Form::label('medicine_class_id', 'Select Medicine Class') !!}
            {!! Form::select('medicine_class_id', ['' => 'Choose Medicine Class'] + $medicine_classes, old('medicine_class_id'), ['id'=>'medicine_class', 'class' => 'form-control select2 medicine_class']) !!}
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-12">
                {!! Form::label('description', 'Medicine Description') !!}
                {!! Form::textarea('description', old('description'), ['id'=>'description', 'class' => 'form-control description', 'placeholder' => 'Medicine Description', 'rows' => 2]) !!}
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-4">
                {!! Form::label('side_effects', 'Side Effects') !!}
                {!! Form::textarea('side_effects', old('side_effects'), ['id'=>'side_effects', 'class' => 'form-control side_effects', 'placeholder' => 'Side Effects of Medicine', 'rows' => 2]) !!}
            </div>
            <div class="form-group col-md-4">
                {!! Form::label('precautions', 'Medicine Precautions') !!}
                {!! Form::textarea('precautions', old('precautions'), ['id'=>'precautions', 'class' => 'form-control precautions', 'placeholder' => 'Medicine Precautions', 'rows' => 2]) !!}
            </div>
            <div class="form-group col-md-4">
                {!! Form::label('pregnancy_category', 'Pregnancy Category') !!}
                {!! Form::textarea('pregnancy_category', old('pregnancy_category'), ['id'=>'pregnancy_category', 'class' => 'form-control pregnancy_category', 'placeholder' => 'Pregnancy Category', 'rows' => 2]) !!}
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-12">
                {!! Form::label('indications_id', 'Choose Indications Keyword(s)') !!}
                {!! Form::select('indications_id', $indications, old('indications_keyword'), ['id'=>'indications_keyword', 'class' => 'form-control indications_keyword select2']) !!}
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-12">
                {!! Form::label('indications_details', 'Indications Details') !!}
                {!! Form::textarea('indications_details', old('indications_details'), ['id'=>'indications_details', 'class' => 'form-control indications_details', 'placeholder' => 'Indication Details', 'rows' => 2]) !!}
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-4">
                {!! Form::label('adult_dose', 'Adult Dosages') !!}
                {!! Form::textarea('adult_dose', old('adult_dose'), ['id'=>'adult_dose', 'class' => 'form-control adult_dose', 'placeholder' => 'Adult Dosages', 'rows' => 2]) !!}
            </div>
            <div class="form-group col-md-4">
                {!! Form::label('child_dose', 'Child Dosages') !!}
                {!! Form::textarea('child_dose', old('child_dose'), ['id'=>'child_dose', 'class' => 'form-control child_dose', 'placeholder' => 'Child Dosages', 'rows' => 2]) !!}
            </div>
            <div class="form-group col-md-4">
                {!! Form::label('renal_dose', 'Renal Dosages') !!}
                {!! Form::textarea('renal_dose', old('renal_dose'), ['id'=>'renal_dose', 'class' => 'form-control renal_dose', 'placeholder' => 'Renal Dosages', 'rows' => 2]) !!}
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-4">
                {!! Form::label('administration', ' Administration') !!}
                {!! Form::textarea('administration', old('administration'), ['id'=>'administration', 'class' => 'form-control administration', 'placeholder' => 'Administration', 'rows' => 2]) !!}
            </div>
            <div class="form-group col-md-4">
                {!! Form::label('ingredients', 'Ingredients') !!}
                {!! Form::textarea('ingredients', old('ingredients'), ['id'=>'ingredients', 'class' => 'form-control ingredients', 'placeholder' => 'Medicine Ingredients', 'rows' => 2]) !!}
            </div>
            <div class="form-group col-md-4">
                {!! Form::label('contraindications', 'Medicine Contraindications') !!}
                {!! Form::textarea('contraindications', old('contraindications'), ['id'=>'contraindications', 'class' => 'form-control contraindications', 'placeholder' => 'Medicine Contraindications', 'rows' => 2]) !!}
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-4">
                {!! Form::label('therapeutic_class', 'Therapeutic Class') !!}
                {!! Form::textarea('therapeutic_class', old('therapeutic_class'), ['id'=>'therapeutic_class', 'class' => 'form-control therapeutic_class', 'placeholder' => 'Therapeutic Class', 'rows' => 2]) !!}
            </div>
            <div class="form-group col-md-4">
                {!! Form::label('mode_of_actions', 'Mode of Actions') !!}
                {!! Form::textarea('mode_of_actions', old('mode_of_actions'), ['id'=>'mode_of_actions', 'class' => 'form-control mode_of_actions', 'placeholder' => 'Mode of Actions', 'rows' => 2]) !!}
            </div>
            <div class="form-group col-md-4">
                {!! Form::label('interactions', 'Medicine Interactions') !!}
                {!! Form::textarea('interactions', old('interactions'), ['id'=>'interactions', 'class' => 'form-control interactions', 'placeholder' => 'Medicine Interactions', 'rows' => 2]) !!}
            </div>
        </div>

        {{--<div class="col-sm-4">--}}
            {{--{!! Form::label('', '', ['class' => 'col-form-label']) !!}<br>--}}
            {{--@if(isset($medicine))--}}
                {{--{!! Form::radio('status', '1', (old('status') ==  '1'), array('id'=>'status')) !!} Active--}}
                {{--{!! Form::radio('status', '0', (old('status') ==  '0'), array('id'=>'status')) !!} Not Active--}}
            {{--@else--}}
                {{--{{ Form::radio('status', 1, true) }} Active--}}
                {{--{{ Form::radio('status', 0) }} Not Active--}}
            {{--@endif--}}
        {{--</div>--}}

        <div class="col-sm-12">
            <div class="form-group text-center">
                @if(isset($medicine))
                    <button type="button" class="btn btn-xs btn-warning" onclick="history.back(-1)"><i class="fa fa-reply"></i> Cancel</button>
                    {!! Form::button("<i class='fa fa-plus'></i> Update", ['class' => 'btn btn-xs btn-success', 'type'=>'submit']) !!}
                    <a href="{!! route('admin.medicine.destroy', $medicine->id) !!}" class="btn btn-xs btn-danger record-destroy" id="record-destroy" title="Move to Trash" data-toggle="tooltip" data-placement="top">
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
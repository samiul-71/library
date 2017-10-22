
<div class="row">
    <div class="col-sm-12">

        {{--<div class="form-row">--}}
            {{--<div class="form-group col-sm-8">--}}
                {{--<label for="inputTypeName">Medicine Type Name</label>--}}
                {{--<input name="name" type="text" class="form-control" id="inputTypeName" placeholder="Medicine Type Name">--}}
            {{--</div>--}}
            {{--<div class="form-group col-sm-4">--}}
                {{--<label for="inputCode">Type Code</label>--}}
                {{--<input name="code" type="text" class="form-control" id="inputCode" placeholder="Type Code">--}}
            {{--</div>--}}
            {{--<div class="form-group col-sm-8">--}}
                {{--<label for="inputDescription">Description</label>--}}
                {{--<textarea name="description" class="form-control" id="inputDescription" placeholder="Description" rows="2"></textarea>--}}
            {{--</div>--}}
            {{--<div class="form-radio col-sm-4">--}}
                {{--<label for="inputStatus">Status</label><br>--}}
                {{--<input type="radio" class="form-radio-input" id="inputStatus" name="status" value="1"> Active--}}
                {{--<input type="radio" class="form-radio-input" id="inputStatus" name="status" value="0"> Not Active--}}
            {{--</div>--}}
        {{--</div>--}}

        <div class="form-group row">
            <div class="form-group col-sm-12">
                <label for="inputTypeName" class="col-sm-2 col-form-label">Medicine Type Name</label>
                <div class="col-sm-6">
                    <input type="text" name="name" class="form-control" id="inputTypeName" placeholder="Medicine Type Name" required>
                </div>
                <div class="col-sm-3">
                    <input type="text" name="code" class="form-control" id="inputTypeCode" placeholder="Medicine Type Code">
                </div>
            </div>
            <div class="form-group col-sm-12">
                <label for="inputDescription" class="col-sm-2 col-form-label">Description</label>
                <div class="col-sm-6">
                    <textarea name="description" class="form-control" id="inputDescription" placeholder="Description" rows="2"></textarea>
                </div>
                <div class="col-sm-4">
                    <label for="inputStatus" class="col-form-label"></label><br>
                    <input type="radio" class="form-radio-input" id="inputStatus" name="status" value="1" checked> Active
                    <input type="radio" class="form-radio-input" id="inputStatus" name="status" value="0"> Not Active
                </div>
            </div>
        </div>

        <div class="col-sm-12">
            <div class="form-group text-center">
                <button type="button" class="btn btn-xs btn-warning" onclick="history.back(-1)"><i class="fa fa-reply"></i> Cancel</button>
                {!! Form::button("<i class='fa fa-plus'></i> Create", ['class' => 'btn btn-xs btn-success', 'type'=>'submit']) !!}
                <button type="reset" class="btn btn-xs btn-info"><i class="fa fa-refresh"></i> Reset </button>
            </div>
        </div>
    </div>
</div>
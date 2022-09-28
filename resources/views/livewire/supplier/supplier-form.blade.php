<div class="row">
    <div class="col-lg-8 offset-lg-2">
        <div class="card" style="margin-bottom: 10px">
            <div class="card-body">
                <div class="form-group col-12 {{($errors->first('name')?'has-error':'')}}">
                    <label for="name" class="col-form-label">Name *</label>
                    <div class="input-group">
                        {!! Form::text('name', null, ['class' => 'form-control'.($errors->first('name')?' form-control-danger':''), 'required' => 'required', 'wire:model'=>'name']) !!}
                    </div>
                    @if($errors->first('name'))
                        <div class="form-control-feedback text-danger mt-2">{{$errors->first('name')}}</div>
                    @endif
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-2 offset-10">
                <button type="button" wire:click="submit" class="btn btn-success btn-block btn-lg"><i
                        class="fa fa-save"></i> Save
                </button>
            </div>
        </div>
    </div>
</div>

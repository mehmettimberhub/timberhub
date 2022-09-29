<div class="row">
    <div class="col-lg-8 offset-lg-2">
        <div class="card" style="margin-bottom: 10px">
            <div class="card-body">
                <div class="row">
                    <div class="form-group col-6 {{($errors->first('species')?'has-error':'')}}">
                        <label for="species-select" class="col-form-label text-left">Species *</label>
                        <select class="custom-select"
                                style="height: 31px; border: 1px solid #ced4da; border-radius: 3px; display: inline-block; width: 100%;"
                                wire:model="species" id="species-select">
                            <option value="0" selected>Choose...</option>
                            @foreach(\Timberhub\Product\Domain\Enums\ProductSpecies::cases() as $s)
                                <option value="{{$s->value}}">{{$s->getValue()}}</option>
                            @endforeach
                        </select>
                        @if($errors->first('species'))
                            <div class="form-control-feedback text-danger mt-2">{{$errors->first('species')}}</div>
                        @endif
                    </div>
                    <div class="form-group col-6 {{($errors->first('gradingSystem')?'has-error':'')}}">
                        <label for="gradingSystem-select" class="col-form-label text-left">Grading System *</label>
                        <select class="custom-select"
                                style="height: 31px; border: 1px solid #ced4da; border-radius: 3px; display: inline-block; width: 100%;"
                                wire:model="gradingSystem" id="gradingSystem-select">
                            <option value="0" selected>Choose...</option>
                            @foreach(\Timberhub\Product\Domain\Enums\GradingSystem::cases() as $s)
                                <option value="{{$s->value}}">{{$s->getValue()}}</option>
                            @endforeach
                        </select>
                        @if($errors->first('gradingSystem'))
                            <div
                                class="form-control-feedback text-danger mt-2">{{$errors->first('gradingSystem')}}</div>
                        @endif
                    </div>
                    @php
                        if($gradingSystem === \Timberhub\Product\Domain\Enums\GradingSystem::NORDIC_BLUE->value){
                            $grades = \Timberhub\Product\Domain\Enums\NordicBlueGrade::cases();
                        }else{
                            $grades = \Timberhub\Product\Domain\Enums\TegernseerGrade::cases();
                        }
                    @endphp
                    <div class="form-group col-6 {{($errors->first('grade')?'has-error':'')}}">
                        <label for="grade-select" class="col-form-label text-left">Grade *</label>
                        <select class="custom-select"
                                style="height: 31px; border: 1px solid #ced4da; border-radius: 3px; display: inline-block; width: 100%;"
                                wire:model="grade" id="grade-select">
                            <option value="0" selected>Choose...</option>
                            @foreach($grades as $s)
                                <option value="{{$s->value}}">{{$s->getValue()}}</option>
                            @endforeach
                        </select>
                        @if($errors->first('grade'))
                            <div class="form-control-feedback text-danger mt-2">{{$errors->first('grade')}}</div>
                        @endif
                    </div>
                    <div class="form-group col-6 {{($errors->first('dyingMethod')?'has-error':'')}}">
                        <label for="dyingMethod-select" class="col-form-label text-left">Dying Method *</label>
                        <select class="custom-select"
                                style="height: 31px; border: 1px solid #ced4da; border-radius: 3px; display: inline-block; width: 100%;"
                                wire:model="dyingMethod" id="dyingMethod-select">
                            <option value="0" selected>Choose...</option>
                            @foreach(\Timberhub\Product\Domain\Enums\DyingMethod::cases() as $s)
                                <option value="{{$s->value}}">{{$s->getValue()}}</option>
                            @endforeach
                        </select>
                        @if($errors->first('dyingMethod'))
                            <div class="form-control-feedback text-danger mt-2">{{$errors->first('dyingMethod')}}</div>
                        @endif
                    </div>
                    <div class="form-group col-6 {{($errors->first('treatment')?'has-error':'')}}">
                        <label for="treatment-select" class="col-form-label text-left">Treatment</label>
                        <select class="custom-select"
                                style="height: 31px; border: 1px solid #ced4da; border-radius: 3px; display: inline-block; width: 100%;"
                                wire:model="treatment" id="treatment-select">
                            <option value="0" selected>Choose...</option>
                            @foreach(\Timberhub\Product\Domain\Enums\Treatment::cases() as $s)
                                <option value="{{$s->value}}">{{$s->getValue()}}</option>
                            @endforeach
                        </select>
                        @if($errors->first('treatment'))
                            <div class="form-control-feedback text-danger mt-2">{{$errors->first('treatment')}}</div>
                        @endif
                    </div>
                    <div class="form-group col-2 {{($errors->first('thickness')?'has-error':'')}}">
                        <label for="thickness-select" class="col-form-label text-left">Thickness *</label>
                        <div class="input-group">
                            {!! Form::number('thickness', null, ['class' => 'form-control'.($errors->first('thickness')?' form-control-danger':''), 'required' => 'required', 'wire:model'=>'thickness']) !!}
                        </div>
                        @if($errors->first('thickness'))
                            <div class="form-control-feedback text-danger mt-2">{{$errors->first('thickness')}}</div>
                        @endif
                    </div>
                    <div class="form-group col-2 {{($errors->first('width')?'has-error':'')}}">
                        <label for="width-select" class="col-form-label text-left">Width *</label>
                        <div class="input-group">
                            {!! Form::number('width', null, ['class' => 'form-control'.($errors->first('width')?' form-control-danger':''), 'required' => 'required', 'wire:model'=>'width']) !!}
                        </div>
                        @if($errors->first('width'))
                            <div class="form-control-feedback text-danger mt-2">{{$errors->first('width')}}</div>
                        @endif
                    </div>
                    <div class="form-group col-2 {{($errors->first('length')?'has-error':'')}}">
                        <label for="length-select" class="col-form-label text-left">Height *</label>
                        <div class="input-group">
                            {!! Form::number('length', null, ['class' => 'form-control'.($errors->first('length')?' form-control-danger':''), 'required' => 'required', 'wire:model'=>'length']) !!}
                        </div>
                        @if($errors->first('length'))
                            <div class="form-control-feedback text-danger mt-2">{{$errors->first('length')}}</div>
                        @endif
                    </div>

                    <div class="form-group col-6 {{($errors->first('suppliers')?'has-error':'')}}">
                        <label for="supplier-select" class="col-form-label text-left">Treatment</label>
                        <select class="custom-select" multiple
                                style="height: 31px; border: 1px solid #ced4da; border-radius: 3px; display: inline-block; width: 100%;"
                                wire:model="suppliers" id="supplier-select">
                            <option value="0" selected>Choose...</option>
                            @foreach(\Timberhub\Supplier\Domain\Models\Supplier::all() as $s)
                                <option {{$suppliers && in_array($s->id, $suppliers, true) ? 'selected' : ''}} value="{{$s->id}}">{{$s->name}}</option>
                            @endforeach
                        </select>
                        @if($errors->first('supplier'))
                            <div class="form-control-feedback text-danger mt-2">{{$errors->first('supplier')}}</div>
                        @endif
                    </div>
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

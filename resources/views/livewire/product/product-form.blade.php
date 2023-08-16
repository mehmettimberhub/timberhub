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
                            @foreach(\App\Enums\Products\ProductSpecies::cases() as $s)
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
                            @foreach(\App\Enums\Products\GradingSystem::cases() as $s)
                                <option value="{{$s->value}}">{{$s->getValue()}}</option>
                            @endforeach
                        </select>
                        @if($errors->first('gradingSystem'))
                            <div
                                class="form-control-feedback text-danger mt-2">{{$errors->first('gradingSystem')}}</div>
                        @endif
                    </div>
                    @php
                        if($gradingSystem === \App\Enums\Products\GradingSystem::NORDIC_BLUE->value){
                            $grades = \App\Enums\Products\Grade::cases();
                        }else{
                            $grades = \App\Enums\Products\Grade::cases();
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
                            @foreach(\App\Enums\Products\DyingMethod::cases() as $s)
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
                            @foreach(\App\Enums\Products\Treatment::cases() as $s)
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
                        <label for="length-select" class="col-form-label text-left">Length *</label>
                        <div class="input-group">
                            {!! Form::number('length', null, ['class' => 'form-control'.($errors->first('length')?' form-control-danger':''), 'required' => 'required', 'wire:model'=>'length']) !!}
                        </div>
                        @if($errors->first('length'))
                            <div class="form-control-feedback text-danger mt-2">{{$errors->first('length')}}</div>
                        @endif
                    </div>
                </div>
                <hr>
                <x-datatable :records="$records">
                    <x-slot name="createButton"></x-slot>
                    <x-slot name="thead">
                        <tr>
                            <th>Thickness</th>
                            <th>Width</th>
                            <th>Length</th>
                            <th>Action</th>
                        </tr>
                    </x-slot>
                    <x-slot name="tbody">
                        @foreach($records as $record)
                            <tr>
                                <td>{{ $record->thickness }}</td>
                                <td>{{ $record->width }}</td>
                                <td>{{ $record->length }}</td>

                                <td>
                                    <button type="button" wire:click="deleteVariation({{$record->id}})" class="btn btn-danger btn-xs"><i
                                            class="fa fa-trash"></i>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </x-slot>
                </x-datatable>

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

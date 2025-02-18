<div>
    {{$createButton}}
    <div wire:loading.delay>
        <div
            style="display: flex; justify-content: center; align-items: center; background-color: black; position: fixed; top: 0px; left: 0px; z-index: 9999; width: 100%; height: 100%; opacity: .75;">
            <div style="width: 100px; height: 100px; top: 50%; left: 50%;" class="spinner-border search-spinner"></div>
        </div>
    </div>
    <div class="col-sm-12 col-md-12">
        <div class="row">
            <div class="form-group col-md-3">
                <label for="product_id" class="col-form-label text-left">Search</label>
                <div class="input-group">
                    <input style="display: inline-block; width: auto;" type="search"
                           wire:model.defer="searchTerm" class="form-control form-control-sm" placeholder=""
                           aria-controls="sorting-datatable" tabindex="5">
                </div>
            </div>
            <div class="col-md-1">
                <button wire:click="search" type="button" style="margin-top: 2.3rem"
                        class="btn btn-outline-dark btn-sm"><i class="fas fa-search"></i></button>
            </div>
        </div>
    </div>
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
            {{$thead}}
            </thead>
            <tbody>
            {{$tbody}}
            @if(!count($records))
                <tr>
                    No records.
                </tr>
            @endif
            </tbody>
        </table>
    </div>
    Total {{ $records->total() }} records
    <div class="col-sm-12">
        {{$records->links('vendor.livewire.bootstrap')}}
    </div>
</div>


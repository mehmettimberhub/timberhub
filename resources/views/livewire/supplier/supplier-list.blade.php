<x-datatable :records="$records">
    <x-slot name="createButton">
        <a class="btn btn-primary" href="{{route('suppliers.create')}}">
            New Supplier
        </a>
    </x-slot>
    <x-slot name="extra_criterias">

    </x-slot>
    <x-slot name="thead">
        <tr>
            <th>Name</th>
            <th>Action</th>
        </tr>
    </x-slot>
    <x-slot name="tbody">
        @foreach($records as $record)
            <tr>
                <td>{{ $record->name }}</td>

                <td>
                    <a href="{{route('suppliers.edit', ['supplier' => $record->id])}}"
                       class="btn btn-xs btn-primary">
                        <i class="fa fa-sm fa-edit"></i>
                    </a>

                    <button type="button" wire:click="delete({{$record->id}})" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i>
                    </button>
                </td>
            </tr>
        @endforeach
    </x-slot>
</x-datatable>

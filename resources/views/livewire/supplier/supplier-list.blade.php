<a class="btn btn-primary" href="{{route('suppliers.create')}}">
    New Supplier
</a>
<x-datatable :records="$records">
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
                    <a href="{{route('suppliers.destroy', ['supplier' => $record->id])}}"
                           class="btn btn-xs btn-danger">
                        <i class="fa fa-sm fa-trash"></i>
                    </a>
                </td>
            </tr>
        @endforeach
    </x-slot>
</x-datatable>

<div>
    <a href="{{ route('dashboard.students.bills.index', $id) }}" class="btn btn-primary">Tagihan</a>
    <x-datatable::shared.edit-action-button href="{{ route('dashboard.students.edit', $id) }}" />
    <x-datatable::shared.delete-action-button href="{{ route('dashboard.students.destroy', $id) }}" />
</div>

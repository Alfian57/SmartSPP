<div class="d-flex align-items-center">
    <a href="{{ route('dashboard.students.bills.index', $id) }}" class="btn btn-primary btn-sm mx-1">Tagihan</a>
    <a href="{{ route('dashboard.students.export', $id) }}" class="btn btn-secondary btn-sm mx-1">Download Tagihan</a>
    <x-datatable::shared.edit-action-button href="{{ route('dashboard.students.edit', $id) }}" />
    <x-datatable::shared.delete-action-button href="{{ route('dashboard.students.destroy', $id) }}" />
</div>

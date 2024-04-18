<div class="d-flex align-items-center">
    <x-datatable::shared.edit-action-button href="{{ route('dashboard.classrooms.edit', $id) }}" />
    <x-datatable::shared.delete-action-button href="{{ route('dashboard.classrooms.destroy', $id) }}" />
</div>

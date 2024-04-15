<div>
    <x-datatable::shared.edit-action-button href="{{ route('dashboard.admins.edit', $id) }}" />
    <x-datatable::shared.delete-action-button href="{{ route('dashboard.admins.destroy', $id) }}" />
</div>

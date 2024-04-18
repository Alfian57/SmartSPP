<div class="d-flex align-items-center justify-content-center">
    @if (auth()->user()->accountable->id == $id)
        <span class="text-info">Akun Anda</span>
    @else
        <x-datatable::shared.edit-action-button href="{{ route('dashboard.admins.edit', $id) }}" />
        <x-datatable::shared.delete-action-button href="{{ route('dashboard.admins.destroy', $id) }}" />
    @endif
</div>

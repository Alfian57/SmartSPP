@section('title')
    Profil
@endsection

<x-dashboard-layouts::main>
    <x-dashboard::ui.page-header title="Profil" desc="Profil anda">
        <x-dashboard::ui.page-header.item label="Profil" active />
    </x-dashboard::ui.page-header>

    <div class="row">
        <div class="col-lg-4 col-md-5">
            <div class="card">
                <div class="card-body">
                    <div class="text-center">
                        @if (auth()->user()->profile_pic)
                            <img src="{{ asset('storage/' . auth()->user()->profile_pic) }}" class="rounded-circle"
                                width="150" />
                        @else
                            <img src="/dashboard/img/avatar.png" class="rounded-circle" width="150" />
                        @endif
                        <h4 class="card-title mt-10">{{ auth()->user()->accountable->name }}</h4>
                        <p class="card-subtitle">Bergabung pada {{ auth()->user()->created_at }}</p>
                    </div>
                </div>
                <hr class="mb-0">
                <div class="card-body">
                    <small class="text-muted d-block">Email address </small>
                    <h6>{{ auth()->user()->email }}</h6>

                    @if (auth()->user()->role() !== \App\Enums\Role::ADMIN->value)
                        <small class="text-muted d-block pt-10">Phone</small>
                        <h6>{{ auth()->user()->accountable->phone_number }}</h6>
                    @endif

                    @if (auth()->user()->role() === \App\Enums\Role::STUDENT->value)
                        <small class="text-muted d-block pt-10">Address</small>
                        <h6>{{ auth()->user()->accountable->address }}</h6>
                    @endif
                </div>
            </div>
        </div>
        <div class="col-lg-8 col-md-7">
            <div class="card">
                <ul class="nav nav-pills custom-pills" id="pills-tab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" id="pills-profile-tab" data-toggle="pill" href="#password"
                            role="tab" aria-controls="pills-profile" aria-selected="false">Ganti Password</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" id="pills-profile-tab" data-toggle="pill" href="#profile-pic" role="tab"
                            aria-controls="pills-profile" aria-selected="false">Ganti Foto Profil</a>
                    </li>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="password" role="tabpanel"
                        aria-labelledby="pills-profile-tab">
                        <div class="card-body">
                            <form action="{{ route('dashboard.change-password') }}" method="post">
                                @csrf
                                <x-dashboard::ui.input type="password" label="Password Lama"
                                    placeholder="Masukan password lama" name="old_password" required />
                                <x-dashboard::ui.input type="password" label="Password Baru"
                                    placeholder="Masukan password baru" name="new_password" required />
                                <x-dashboard::ui.input type="password" label="Konfirmasi Password Baru"
                                    placeholder="Masukan konfirmasi password baru" name="new_password_confirmation"
                                    required />

                                <button class="btn btn-success" type="submit">Ganti Password</button>
                            </form>
                        </div>
                    </div>
                    <div class="tab-pane fade" id="profile-pic" role="tabpanel" aria-labelledby="pills-profile-tab">
                        <div class="card-body">
                            <form action="{{ route('dashboard.change-profile') }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                <x-dashboard::ui.input label="Masukan Foto" type="file" name="profile_pic"
                                    required />
                                <button class="btn btn-success"" type="submit">Ganti Foto</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-dashboard-layouts::main>

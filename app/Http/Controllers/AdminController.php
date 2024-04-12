<?php

namespace App\Http\Controllers;

use App\Events\OnAccountCreated;
use App\Http\Requests\StoreAdminRequest;
use App\Http\Requests\UpdateAdminRequest;
use App\Models\Admin;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        $admins = Admin::query()
            ->with('account')
            ->latest()
            ->paginate(25);

        return view('dashboard.pages.admins.index', [
            'title' => 'Manajemen Admin',
            'admins' => $admins,
        ]);
    }

    public function create()
    {
        return view('dashboard.pages.admins.create', [
            'title' => 'Tambah Admin',
        ]);
    }

    public function store(StoreAdminRequest $request)
    {
        DB::transaction(function () use ($request) {
            $admin = Admin::create($request->except('email'));
            OnAccountCreated::dispatch($request->name, $request->email, $admin);
        });

        toast('Admin berhasil dibuat', 'success');

        return redirect()->route('dashboard.admins.index');
    }

    public function edit(Admin $admin)
    {
        return view('dashboard.pages.admins.edit', [
            'title' => 'Edit Admin',
            'admin' => $admin,
        ]);
    }

    public function update(UpdateAdminRequest $request, Admin $admin)
    {
        $admin->update($request->validated());

        toast('Admin berhasil diperbarui', 'success');

        return redirect()->route('dashboard.admins.index');
    }

    public function destroy(Admin $admin)
    {
        $admin->delete();

        toast('Admin berhasil dihapus', 'success');

        return redirect()->route('dashboard.admins.index');
    }
}
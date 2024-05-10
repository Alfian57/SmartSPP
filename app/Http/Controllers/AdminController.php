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
        return view('dashboard.pages.admins.index');
    }

    public function create()
    {
        return view('dashboard.pages.admins.create');
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

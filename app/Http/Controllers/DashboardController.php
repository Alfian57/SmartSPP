<?php

namespace App\Http\Controllers;

use App\Enums\BillStatus;
use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\ChangeProfileRequest;
use App\Models\Bill;
use App\Models\Classroom;
use App\Models\Student;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class DashboardController extends Controller
{
    public function index()
    {
        $studentCount = Student::count();
        $classroomCount = Classroom::count();
        $billCount = Bill::where('status', BillStatus::PAID_OFF->value)->count();

        return view('dashboard.pages.dashboard.index', [
            'studentCount' => $studentCount,
            'classroomCount' => $classroomCount,
            'billCount' => $billCount,
        ]);
    }

    public function profile()
    {
        return view('dashboard.pages.dashboard.profile');
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        /** @var \App\Models\Account $user * */
        $user = Auth::user();

        if (Hash::check($request->old_password, $user->password)) {
            $user->update([
                'password' => Hash::make($request->new_password),
            ]);

            toast('Password telah diupdate', 'success');

            return redirect()->route('dashboard.index');
        }

        toast('Password lama salah', 'error');

        return redirect()->route('dashboard.profile');
    }

    public function changeProfile(ChangeProfileRequest $request)
    {
        /** @var \App\Models\Account $user * */
        $user = Auth::user();

        $user->update([
            'profile_pic' => $request->file('profile_pic')->store('user_profile_pics'),
        ]);

        toast('Profil telah diupdate', 'success');

        return redirect()->route('dashboard.profile');
    }
}

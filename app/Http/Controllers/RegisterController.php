<?php

namespace App\Http\Controllers;

use App\Model\Patient;
use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * Подтверждение регистрации
     */

    public function rConfirm(Request $request)
    {

        try {
            $user = new User();
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->role = 'patient';
            $user->name = $request->name;
            $user->save();
            $patient = new Patient();
            $patient->name = $request->name;
            $patient->surname = $request->surname;
            $user = User::where('email', $request->email)->first();
            $patient->u_id = $user->id;
            $patient->save();
            $name = $request->name;
            $id = $request->id;
            return redirect(route('Home'));
        } catch (\HttpRequestException $exception){
            return redirect()->back()->with('message','false');
        }

    }
}

<?php

namespace App\Http\Controllers;

use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * Авторизация
     */
    public function loginCheck(Request $request)
    {
        try {
            $user = User::where('email', $request->email)->first();
            if(empty($user)){
                return redirect()->back()->with('error', 'Пользователь не найден');
            }
            if(Hash::check($request->password, $user->password)){
                Session::put('id',$user->id);
                $id = $user->id;
                $name = $user->name;
                    return redirect(route('Home', compact('id', 'name')));
            } else {
                return redirect()->back()->with('error', 'Пользователь не найден');
            }
        } catch (\HttpRequestException $exception){
            return redirect()->back()->with('error', 'Пользователь не найден');
        }
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     * Выход из системы
     */
    public function logout()
    {
        Session::forget('id');
        return redirect(route('Home'));
    }
}

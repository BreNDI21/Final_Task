<?php

namespace App\Http\Controllers;

use App\Model\Doctor;
use App\Model\Patient;
use App\Model\Seance;
use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * Главная страница
     */
    public function index()
    {
        if (Session::has('id')){
            $id = Session::get('id');
            $user = User::findorfail($id);
            $name = $user->name;
            return view('welcome', compact('name', 'id'));
        }
        return view('welcome');
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * Список врачей
     */
    public function doctors()
    {
        $doctors = Doctor::all();
        return view('allDoctors', compact('doctors'));
    }

    /**
     * @param Request $request
     * Запись на прием к врачу
     */
    public function appointment(Request $request)
    {
        if (!Session::has('id'))
        {
            return redirect(route('login'));
        }
        $id = $request->d_id;
       $doctor = Doctor::findorfail($id);
        return  view('timeCheck', compact('doctor'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * Подтверждение регистрации\запись в БД
     */
    public function submitApp(Request $request)
    {

        $p_id = Session::get('id');
        $d_id = $request->d_id;
        $seance = new Seance();
        $seance->d_id = $d_id;
        $seance->p_id = $p_id;
        $seance->time = $request->time;
        $seance->date = $request->date;
        $seance->save();
        return redirect()->back()->with('key', 'success');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * Личный кабинет пользователя
     */
    public function personalArea($id)
    {
        $user = User::findorfail($id);
        if($user->role == 'patient') {
            $seance = Seance::where('p_id', $id)->get();
            if($seance->isEmpty()){
                return redirect()->back()->with('seance',0);
            }
            foreach ($seance as $s){
                $date[] = $s->date;
                $time[] = $this->getTime($s->time);
                $ids[] = $s->id;
            }
            $data = compact('date', 'time', 'ids');

            $num = count($data['time']);

            return view('mySeances', compact('data', 'num'));
        } elseif ($user->role = 'doctor') {
            $seance = Seance::where('d_id', $id)->get();
            if($seance->isEmpty()){
                return redirect()->back()->with('seance', 1);
            }
            foreach ($seance as $s){
                $date[] = $s->date;
                $time[] = $this->getTime($s->time);
                $ids[] = $s->id;
            }
            $data = compact('date', 'time', 'ids');

            $num = count($data['time']);
                return  view('doctor.seances', compact('data', 'num'));
        }

    }

    /**
     * @param $val
     * @return string
     * Перевод получаемого значения в аналогичное по времениу
     */
    public function getTime($val)
    {
        if($val == 1){
            $time = '10:00-11:00';
        } elseif (($val == 2)){
            $time = '11:00-12:00';
        } elseif ($val == 3){
            $time = '12:00-13:00';
        } elseif ($val == 4){
            $time = '13:00-14:00';
        } elseif ($val == 5){
            $time = '14:00-15:00';
        } elseif ($val == 6){
            $time = '15:00-16:00';
        } elseif ($val == 7){
            $time = '16:00-17:00';
        } elseif ($val == 8){
            $time = '17:00-18:00';
        }
        return $time;
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     * Шаблон талона
     */
    public function findSeance(Request $request, $id)
    {

       $seance =  Seance::findorfail($request->id);
        $doctor = Doctor::where('u_id', $seance->d_id)->first();


        $patient = Patient::where('u_id',$seance->p_id)->first();
        $time = $this->getTime($seance->time);
        $seance->time = $time;
        return view('template', compact('seance', 'doctor','patient'));
    }

}

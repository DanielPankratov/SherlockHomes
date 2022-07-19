<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Properties;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as AuthUser;
use Illuminate\Support\Facades\Auth;

// use App\Http\Controllers\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function dashboard(){ 
        $numProperties = count(Properties::all());
        $numUsers = count(User::all());
        // $recentProperties = Properties::whereBetween('created_at', [Carbon::now()->subWeek()->startOfWeek(), Carbon::now()->subWeek()->endOfWeek()])
                                        // ->get();
        $now = Carbon::now();
        $recentProperties = Properties::whereBetween("created_at", [
                                        $now->startOfWeek()->format('Y-m-d'),
                                        $now->endOfWeek()->format('Y-m-d')])
                                        ->orderBy('created_at', "desc")
                                        ->get();

        if (Auth::user()->hasRole('admin') || Auth::user()->hasRole('superadmin')) {
            return view('admin.dashboard', compact('numProperties', 'numUsers', 'recentProperties'));
        }else{
            return redirect(url()->previous());
        }    
    }
    
    
    public function users(){

        if (Auth::user()->hasRole('admin') || Auth::user()->hasRole('superadmin')) {
            $users = User::all();
            return view('admin.users', compact('users'));
        }else{
            return redirect(url()->previous());
        }    
    }
    public function addAdmin(User $user){
        $user->attachRole('admin');
        return redirect(url()->previous())->with('message', 'Adicionado aos administradores!');
    }
    public function removeAdmin(User $user){
        $user->detachRole('admin');
        return redirect(url()->previous())->with('message', 'Removido dos administradores!');
    }
    public function deleteUser(User $user){
        $user->delete();
        // dd($user);
        return redirect(url()->previous())->with('message', 'Conta Apagada!');
    }
}

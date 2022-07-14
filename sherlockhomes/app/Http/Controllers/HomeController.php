<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Properties;
use App\Models\User;
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
        $recentProperties = Properties::orderBy('created_at', 'desc')->take(200)->get();
        
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
        return redirect(url()->previous())->with('message', 'Conta Apagada!');
    }
}

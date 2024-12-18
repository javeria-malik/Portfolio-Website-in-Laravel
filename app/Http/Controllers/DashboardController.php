<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        if(Auth::id())
        {

            $usertype = Auth()->user()->usertype;
            if($usertype=='user')
            {
                return view('dashboard');
            }
        
        
            if($usertype=='admin')
        {
                return view('admin.index');
            
        }
            else
        {
            return redirect()->back();
        }
    }
    
}
}
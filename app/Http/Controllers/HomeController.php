<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;

use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        if(Auth::id())
        {
            $usertype = Auth()->user()->usertype;

            if($usertype == 'user')
            {
                return view('dashboard');
            }
            else if($usertype == 'admin')
            {
                return view('admin.adminhome');
            }
            else if($usertype == 'employee')
            {
                return view('employee.employeehome');
            }
            else
            {
                return redirect()->back();
            }
        }
    }

    public function tazasindex()
    {
        if(Auth::id())
        {
            return view('tazas');
        }
        else
        {
            return redirect()->back();
        }
    }

    public function bannersindex()
    {
        if(Auth::id())
        {
            return view('banners');
        }
        else
        {
            return redirect()->back();
        }
    }

    public function camisasindex()
    {
        if(Auth::id())
        {
            return view('camisas');
        }
        else
        {
            return redirect()->back();
        }
    }

}

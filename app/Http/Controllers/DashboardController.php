<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return redirect('/dashboard/users/'.\Auth::user()->slug.'/'.\Auth::user()->id);
    }
}

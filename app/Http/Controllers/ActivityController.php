<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function my_activities(){
        return view('dashboard');
    }

    public function manage_activties(){
        return view('manage-activities');
    }

    public function new_activity(){
        return view('new-activity');
    }

    public function manage_account(){
        return view('manage-account');
    }
}

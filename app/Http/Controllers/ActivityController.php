<?php

namespace App\Http\Controllers;

use App\Models\Activities;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

    public function create_activity(Request $request){
        $data= $request->validate([
            'name' => 'required|min:3',
            'date' => 'required|after:yesterday',
            'description' => ''
        ]);

        $user_id = Auth::id();

        $activity = new Activities();
        $activity->name =  $data['name'];
        $activity->date =  $data['date'];
        $activity->description =  $data['description'];
        $activity->admin_id = $user_id;

        $activity->save();

        return 'done';
    }

    public function manage_account(){
        return view('manage-account');
    }


}

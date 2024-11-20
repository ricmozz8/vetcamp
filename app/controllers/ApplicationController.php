<?php
require_once 'Controller.php';

class ApplicationController extends Controller
{

    /**
     * This renders the index view.
     *
     *
     * @return void
     */
    public static function editApplication($user_id)
    {
        if ($user_id == null) {
            redirect('/admin/requests');
        }
        // your index view here
        $user = User::find($user_id);
        $application = $user->application();
        
        render_view('profile', 
            ['user' => $user, 
            'application' => $application,
            'postal_address' => $user->postal_address(),
            'physical_address' => $user->physical_address(),
            'school_address' => $user->school_address(),
            'preferred_session' => $application->preferred_session(true),
        ], 'Aplicación');

    }

    // define your other methods here
}

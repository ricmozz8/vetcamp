<?php

//require_once '../../../app/models/User.php';
//require_once '../../../kernel/auth.php';


set_include_path('..' . PATH_SEPARATOR . '../database/connector.php');
require_once '../app/helpers/helpers.php';
require_once '../kernel/auth.php';
require_once '../bootstrap/exceptions.php';


// Run your tests here


class AuthTest extends Unit

{
    
    public function testLoginSuccess()
    {
        // Mock user data
        $userData = [
            'email' => 'test@example.com',
            'password' => 'password123'
        ];

        //dd(CONFIG);

        // Mock user object
        $user = new User($userData,[]);

        // Call login method
        Auth::login($user);

        // Assert that user is logged in
        $this->assert_true(Auth::check());
    }

    public function testLoginFailure()
    {
        // Mock user data
        $userData = [
            'email' => 'test@example.com',
            'password' => 'wrongpassword',
        ];

         // Mock user object
         $user = new User($userData, []);

         // Set up Auth class
         $auth = new Auth();
 
         // Call login method
         $auth->login($user);
 
         // Assert that user is not logged in
         $this->assert_false($auth->check());
    }

    public function testLogout()
    {
       // Mock user data
       $userData = [
        'email' => 'test@example.com',
        'password' => 'password123',
    ];

    // Mock user object
    $user = new User($userData, []);

    // Set up Auth class
    $auth = new Auth();

    // Call login method
    $auth->login($user);

    // Call logout method
    $auth->logout();

    // Assert that user is not logged in
    $this->assert_false($auth->check());
    }
} 
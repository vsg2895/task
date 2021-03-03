<?php

namespace App\Http\Controllers;

use App\Mail\CommentEmail;
use App\Mail\SignupEmail;
use App\Mail\UserEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{

    public static function sendSignupEmail($name, $lastname, $email, $verifycation_code)
    {

        $data = [

            'name' => $name,
            'lastname' => $lastname,
            'verifycation_code' => $verifycation_code,

        ];

        Mail::to($email)->send(new SignupEmail($data));


    }

    public static function sendCommentEmail($name, $lastname, $email, $topic, $status,$reason="")
    {

        $data = [

            'name' => $name,
            'lastname' => $lastname,
            'topic' => $topic,
            'status' => $status,
            'reason' => $reason

        ];

        Mail::to($email)->send(new CommentEmail($data));


    }

    public static function sendUserEmail($name, $lastname, $email, $status)
    {

        $data = [

            'name' => $name,
            'lastname' => $lastname,
            'status' => $status,

        ];

        Mail::to($email)->send(new UserEmail($data));


    }

}

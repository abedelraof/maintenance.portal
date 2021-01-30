<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AppController extends Controller
{


    public function actionCheckLogin()
    {
        return redirect()->route("auth.login");
    }

    public function actionLogout()
    {
        return redirect()->route("auth.login");
    }

    public function actionLogin()
    {
        return view("app.login");
    }

    public function actionLoginSubmit()
    {
        return redirect()->route("auth.verify");
    }

    public function actionVerify()
    {
        return view("app.verify");
    }

    public function actionVerifySubmit()
    {
        return redirect()->route("tickets.create");
    }

    public function actionCreateTicket()
    {
        return view("app.create_ticket");
    }

    public function actionStoreTicket()
    {

    }


}

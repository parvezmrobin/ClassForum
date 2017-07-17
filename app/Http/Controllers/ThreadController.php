<?php
/**
 * Created by PhpStorm.
 * User: alami
 * Date: 17-Jul-17
 * Time: 11:21 PM
 */

namespace App\Http\Controllers;


use Illuminate\Support\Facades\DB;


class ThreadController extends Controller
{
    public function getThread()
    {

        return view('home');

    }

    public function Show_Thread()
    {
        $threads = DB::table('threads')->get();

        return view('views.home', ['threads' => $threads]);

    }

}
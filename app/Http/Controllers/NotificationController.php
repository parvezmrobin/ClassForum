<?php
/**
 * Created by PhpStorm.
 * User: alami
 * Date: 24-Jul-17
 * Time: 3:04 PM
 */

namespace App\Http\Controllers;


class NotificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

}
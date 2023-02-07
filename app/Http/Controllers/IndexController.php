<?php

namespace App\Http\Controllers;

use App\Models\Stroller;
use Illuminate\Http\Request;

class IndexController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $strollers = Stroller::select()->get();

        return view('index')->with(['strollers' => $strollers]);
    }
}

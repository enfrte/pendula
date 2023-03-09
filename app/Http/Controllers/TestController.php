<?php

namespace App\Http\Controllers;

class TestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		
        return view('test');
    }

	public function fragmentTest()
	{
		return view('fragmentTest');
	}



}

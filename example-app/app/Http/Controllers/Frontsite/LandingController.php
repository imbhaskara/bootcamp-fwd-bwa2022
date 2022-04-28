<?php

namespace App\Http\Controllers\Frontsite;

use App\Http\Controllers\Controller;

//Input library used for landing page
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\DB;

//Input library use yang singkat
//use Gate;
use Auth;

//Input our model here
use App\Models\User;
use App\Models\Operational\Doctor;
use App\Models\MasterData\Specialist;

//Input third party package here

class LandingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Panggil kebutuhan frontsite yang berasal dari Database (Kasus ini data doctor dan specialist)
        $specialist = Specialist::orderBy('name', 'desc')->limit(5)->get();
        $doctor = Doctor::orderBy('created_at', 'desc')->limit(4)->get();
        return view('pages.frontsite.landing-page.index', compact('doctor', 'specialist'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return abort(404);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

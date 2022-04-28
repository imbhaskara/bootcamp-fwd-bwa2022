<?php

namespace App\Http\Controllers\Frontsite;

use App\Http\Controllers\Controller;

//Input library used for landing page
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

//Input library use yang singkat
//use Gate;
use Auth;

//Input our model here
use App\Models\User;
use App\Models\Operational\Doctor;
use App\Models\Operational\Appointment;
use App\Models\MasterData\Specialist;
use App\Models\MasterData\Consultation;

//Input third party package here

class AppointmentController extends Controller
{
    //Construct digunakan untuk mengamankan aplikasi kita dari edit-edit yang tidak diharapkan
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return abort(404);
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
        $data = $request->all();

        $appointment = new Appointment;
        $appointment->doctor_id = $data['doctor_id'];
        $appointment->user_id = Auth::user()->id;
        $appointment->consultation_id = $data['consultation_id'];
        $appointment->level = $data['level_id'];
        $appointment->date = $data['date'];
        $appointment->time = $data['time'];
        $appointment->status = 2; // set to waiting payment
        $appointment->save();

        return redirect()->route('payment.appointment', $appointment->id);
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
        return abort(404);
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
        return abort(404);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return abort(404);
    }

    // Custom function for index
    public function appointment($id)
    {
        $doctor = Doctor::where('id', $id)->first();
        $consultation = Consultation::orderBy('name', 'asc')->get();

        return view('pages.frontsite.appointment.index', compact('doctor', 'consultation'));
    }
}

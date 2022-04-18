<?php

namespace App\Http\Controllers\Backsite;

use App\Http\Controllers\Controller;

//Input library
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

// Input request

//Input library use yang singkat
//use Gate;
use Auth;

//Input our model here
use App\Models\Operational\Appointment;
use App\Models\User;
use App\Models\Operational\Doctor;
use App\Models\MasterData\Consultation;

class AppointmentBacksiteController extends Controller
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
        // for table  grid view
        $appointment = Appointment::orderBy('created_at', 'desc')->get();

        // $doctor = Doctor::orderBy('name', 'asc')->get();

        $consultation = Consultation::orderBy('name', 'asc')->get();

        $user = User::orderBy('name', 'asc')->get();

        return view('pages.backsite.operational.appointment.index', compact('appointment'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return abort('404');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        return abort('404');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Appointment $appointment)
    {
        return abort('404');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return abort('404');
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
        return abort('404');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Appointment $appointment)
    {
        abort_if(Gate::denies('appointment_backsite_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $appointment->forceDelete($appointment);

        // Tambahkan alert success delete data
        alert()->success('Berhasil', 'Data Appointment berhasil dihapus!');
        return redirect()->route('backsite.appointment.index');
    }
}

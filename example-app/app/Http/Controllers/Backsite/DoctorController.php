<?php

namespace App\Http\Controllers\Backsite;

use App\Http\Controllers\Controller;

//Input library
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

// Input request
use App\Http\Requests\Specialist\StoreDoctorRequest;
use App\Http\Requests\Specialist\UpdateDoctorRequest;

//Input library use yang singkat
use Gate;
use Auth;

//Input our model here
use App\Models\MasterData\Specialist;
use App\Models\Operational\Doctor;

class DoctorController extends Controller
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
        $doctor = Doctor::orderBy('created_at', 'desc')->get();

        // for select2 from specialist -> a-z nama biar mudah pencarian
        $specialist = Specialist::orderBy('name', 'asc')->get();

        return view('pages.backsite.operational.doctor.index', compact('doctor', 'specialist'));
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
    public function store(StoreDoctorRequest $request)
    {
        // Kita gunakan data untuk menampung semua request (get all request from frontsite)
        $data = $request->all();

        // Lalu datanya di store ke database
        $doctor = Doctor::create($data);

        alert()->success('Berhasil', 'Data Dokter berhasil disimpan!');
        return redirect()->route('backsite.doctor.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Doctor $doctor)
    {
        abort_if(Gate::denies('doctor_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('pages.backsite.operational.doctor.show', compact('doctor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Doctor $doctor)
    {
        abort_if(Gate::denies('doctor_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        // for select2 from specialist -> a-z nama biar mudah pencarian
        $specialist = Specialist::orderBy('name', 'asc')->get();

        return view('pages.backsite.operational.doctor.edit', compact('doctor', 'specialist'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDoctorRequest $request, Doctor $doctor)
    {
        // Kita gunakan data untuk menampung semua request (get all request from frontsite)
        $data = $request->all();

        // Lalu datanya di store ke database
        $doctor->update($data);

        alert()->success('Berhasil', 'Data Dokter berhasil diupdate!');
        return redirect()->route('backsite.doctor.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Doctor $doctor)
    {
        abort_if(Gate::denies('doctor_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $doctor->forceDelete($doctor);

        alert()->success('Berhasil', 'Data Dokter berhasil dihapus!');
        return redirect()->route('backsite.doctor.index');
    }
}

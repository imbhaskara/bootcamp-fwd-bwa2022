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
use App\Models\User;
use App\Models\MasterData\Specialist;
use App\Models\MasterData\ConfigPayment;
use App\Models\MasterData\Consultation;
use App\Models\Operational\Appointment;
use App\Models\Operational\Doctor;
use Apps\Models\Operational\Transaction;

class HospitalPatientController extends Controller
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
        // for table grid pasien rumah sakit berdasarkan data user dan tipe usernya
        $hospital_patient = User::whereHas('detail_user', function (Builder $query) {
            $query->where('type_user_id', 3); // Only load data dengan tipe user id = 3
        })->orderBy('created_at', 'desc')->get();

        return view('pages.backsite.operational.hospital_patient.index', compact('hospital_patient'));
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
}

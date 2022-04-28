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
use App\Models\Operational\Transaction;
use App\Models\MasterData\Consultation;
use App\Models\MasterData\ConfigPayment;
use App\Models\MasterData\Specialist;

//Input third party package here
class PaymentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
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
        // Tampilkan dulu semua datanya dengan request
        $data = $request->all();

        //Ambil data appointment dan config payment sesuai appointment_id
        $appointment = Appointment::where('id', $data['appointment_id'])->first();
        $config_payment = ConfigPayment::first();

        // Set transaction data lainnya
        $specialist_fee = $appointment->doctor->specialist->price;
        $doctor_fee = $appointment->doctor->fee;
        $hospital_fee = $config_payment->fee;
        $hospital_vat = $config_payment->vat;

        // Kita jumlahkan sub total semua fee
        $total = $specialist_fee + $doctor_fee + $hospital_fee;

        // Kita tambahkan nilai setelah kena pajak (vat)
        $total_with_vat = ($total * $hospital_vat) / 100;
        // Grand total = total + total_with_vat
        $grand_total = $total + $total_with_vat;

        // Save data kedalam database
        $transaction = new Transaction;
        $transaction->appointment_id = $appointment['id'];
        $transaction->fee_doctor = $doctor_fee;
        $transaction->fee_specialist = $specialist_fee;
        $transaction->fee_hospital = $hospital_fee;
        $transaction->sub_total = $total;
        $transaction->vat = $total_with_vat;
        $transaction->total = $grand_total;

        // Simpan data
        $transaction->save();

        //Update Status appointment
        $appointment = Appointment::find($appointment->id);
        $appointment->status = 1; // Update status ke completed payment
        // Simpan updated data appointment
        $appointment->save();
        
        return redirect()->route('payment.success');
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

    // Bikin custom function payment yang berhubungan dengan ID
    public function payment($id)
    {
        $appointment = Appointment::where('id', $id)->first();
        $config_payment = ConfigPayment::first();

        // set value
        $specialist_fee = $appointment->doctor->specialist->price;
        $doctor_fee = $appointment->doctor->fee;
        $hospital_fee = $config_payment->fee;
        $hospital_vat = $config_payment->vat;

        $total = $specialist_fee + $doctor_fee + $hospital_fee;

        $total_with_vat = ($total * $hospital_vat) / 100;
        $grand_total = $total + $total_with_vat;

        return view('pages.frontsite.payment.index', compact('appointment', 'config_payment', 'total_with_vat', 'grand_total', 'id'));
    }

    public function success()
    {
        return view('pages.frontsite.success.payment-success');
    }
}

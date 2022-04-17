<?php

namespace App\Http\Controllers\Backsite;

use App\Http\Controllers\Controller;

//Input library
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

// Input request
use App\Http\Requests\Specialist\UpdateConfigPaymentRequest;

//Input library use yang singkat
//use Gate;
use Auth;

//Input our model here
use App\Models\MasterData\ConfigPayment;

class ConfigPaymentController extends Controller
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
        // Fir table grid view
        $configPayment = ConfigPayment::all();

        return view('pages.backsite.master-data.config-payment.index');
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
    public function show(ConfigPayment $config_payment)
    {
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(ConfigPayment $configPayment)
    {
        return view('pages.backsite.master-data.config-payment.edit', compact('configPayment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ConfigPayment $configPayment)
    {
        $configPayment->update($request->all());

        alert()->success('Berhasil', 'Data Config Payment berhasil diupdate!');
        return redirect()->route('backsite.config_payment.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ConfigPayment $configPayment)
    {
        $configPayment->delete();

        alert()->success('Berhasil', 'Data Config Payment berhasil dihapus!');
        return redirect()->route('backsite.config_payment.index');
    }
}

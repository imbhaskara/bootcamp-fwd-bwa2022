<?php

namespace App\Http\Controllers\Backsite;

use App\Http\Controllers\Controller;

//Input library
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

// Input request
use App\Http\Requests\ConfigPayment\UpdateConfigPaymentRequest;

//Input library use yang singkat
use Gate;
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
        // Pasang Gate untuk menolak akses ketika tidak punya permissions
        abort_if(Gate::denies('config_payment_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        // Fir table grid view
        $config_payment = ConfigPayment::all();

        return view('pages.backsite.master-data.config-payment.index', compact('config_payment'));
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
    public function edit(ConfigPayment $config_payment)
    {
        // pasang gate untuk menolak akses ketika tidak punya permissions
        abort_if(Gate::denies('config_payment_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        return view('pages.backsite.master-data.config-payment.edit', compact('config_payment'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateConfigPaymentRequest $request, ConfigPayment $config_payment)
    {
        // Get all request data from fromsite
        $data = $request->all();

        // Re Format before push to tables
        $data['fee'] = str_replace(',', '', $data['fee']);
        $data['fee'] = str_replace('IDR ', '', $data['fee']);
        $data['vat'] = str_replace(',', '', $data['vat']);

        // Update data to database
        $config_payment->update($data);

        alert()->success('Berhasil', 'Data Config Payment berhasil diupdate!');
        return redirect()->route('backsite.config_payment.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(ConfigPayment $config_payment)
    {
        // pasang gate untuk menolak akses ketika tidak punya permissions
        abort_if(Gate::denies('config__payment_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $config_payment->forceDelete();

        alert()->success('Berhasil', 'Data Config Payment berhasil dihapus!');
        return redirect()->route('backsite.config_payment.index');
    }
}

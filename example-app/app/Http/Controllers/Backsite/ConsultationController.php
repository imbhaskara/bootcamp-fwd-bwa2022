<?php

namespace App\Http\Controllers\Backsite;

use App\Http\Controllers\Controller;

//Input library
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

// Input request
use App\Http\Requests\Specialist\StoreConsultationRequest;
use App\Http\Requests\Specialist\UpdateConsultationRequest;

//Input library use yang singkat
//use Gate;
use Auth;

//Input our model here
use App\Models\MasterData\Consultation;

class ConsultationController extends Controller
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
        $consultation = Consultation::orderBy('created_at', 'desc')->get();

        return view('pages.backsite.master-data.consultation.index');
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
    public function store(StoreConsultationRequest $request)
    {
        // Kita gunakan data untuk menampung semua request (get all request from frontsite)
        $data = $request->all();

        // Lalu datanya di store ke database
        $consultation = Consultation::create($data);
        
        //Tampilkan alert sukses menambahkan data
        alert()->success('Success', 'Data Consultation berhasil ditambahkan!');
        return redirect()->route('backsite.consultation.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Consultation $consultation)
    {
        return view('pages.backsite.master-data.consultation.show', compact('consultation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Consultation $consultation)
    {
        return view('pages.backsite.master-data.consultation.edit', compact('consultation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateConsultationRequest $request, Consultation $consultation)
    {
        // Kita gunakan data untuk menampung semua request (get all request from frontsite)
        $data = $request->all();

        // Lalu datanya di store ke database
        $consultation->update($data);
        
        //Tampilkan alert sukses update data
        alert()->success('Success', 'Data Consultation berhasil diupdate!');
        return redirect()->route('backsite.consultation.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Consultation $consultation)
    {
        $consultation->forceDelete();

        // Tambahkan notifikasi berhasil dihapus
        alert()->success('Success', 'Data Consultation berhasil dihapus!');
        return redirect()->route('backsite.consultation.index');
    }
}

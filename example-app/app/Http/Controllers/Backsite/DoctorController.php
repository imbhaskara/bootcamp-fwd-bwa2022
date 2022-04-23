<?php

namespace App\Http\Controllers\Backsite;

use App\Http\Controllers\Controller;

//Input library
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

// Input request
use App\Http\Requests\Specialist\StoreDoctorRequest;
use App\Http\Requests\Specialist\UpdateDoctorRequest;

//Input library use yang singkat
use Gate;
use Auth;
use File;

//Input our model here
use App\Models\Operational\Doctor;
use App\Models\MasterData\Specialist;

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
        // Pasang Gate untuk menolak akses ketika tidak punya permissions
        abort_if(Gate::denies('doctor_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
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

        // re format before push to table
        $data['fee'] = str_replace(',', '', $data['fee']);
        $data['fee'] = str_replace('IDR ', '', $data['fee']);

          // upload process here
          $path = public_path('app/public/assets/file-doctor');
          if(!File::isDirectory($path)){
              $response = Storage::makeDirectory('public/assets/file-doctor');
          }
  
          // change file locations
          if(isset($data['photo'])){
              $data['photo'] = $request->file('photo')->store(
                  'assets/file-doctor', 'public'
              );
          }else{
              $data['photo'] = "";
          }
  
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
        // pasang gate untuk menolak akses ketika tidak punya permissions
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
        //pasang gate untuk menolak akses ketika tidak punya permissions
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

        // re format before push to table
        $data['fee'] = str_replace(',', '', $data['fee']);
        $data['fee'] = str_replace('IDR ', '', $data['fee']);

        // Lalu datanya di store ke database
        $doctor->update($data);

         // change file locations
         $data['photo'] = $request->file('photo')->store(
            'assets/file-doctor', 'public'
        );

        // delete old photo from storage
        $data_old = 'storage/'.$get_item;
        if (File::exists($data_old)) {
            File::delete($data_old);
        }else{
            File::delete('storage/app/public/'.$get_item);
        }

        // Update to database
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
        // pasang gate untuk menolak akses ketika tidak punya permissions
        abort_if(Gate::denies('doctor_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        // Kebutuhan untuk menghapus foto profil dokter
        // first checking old file to delete from storage
        $get_item = $doctor['photo'];

        $data = 'storage/'.$get_item;
        if (File::exists($data)) {
            File::delete($data);
        }else{
            File::delete('storage/app/public/'.$get_item);
        }
        
        $doctor->forceDelete($doctor);

        alert()->success('Berhasil', 'Data Dokter berhasil dihapus!');
        return redirect()->route('backsite.doctor.index');
    }
}

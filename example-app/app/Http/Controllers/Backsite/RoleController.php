<?php

namespace App\Http\Controllers\Backsite;

use App\Http\Controllers\Controller;

//Input library
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

// Input request
use App\Http\Requests\Specialist\StoreRoleRequest;
use App\Http\Requests\Specialist\UpdateRoleRequest;

//Input library use yang singkat
//use Gate;
use Auth;

//Input our model here
use App\Models\ManagementAccess\Role;
use App\Models\ManagementAccess\RoleUser;
use App\Models\ManagementAccess\Permission;
use App\Models\ManagementAccess\PermissionRole;

class RoleController extends Controller
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
        $role = Role::orderBy('created_at', 'desc')->get();

        return view('pages.backsite.management-access.role.index');
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
    public function store(StoreRoleRequest $request)
    {
        // Kita gunakan data untuk menampung semua request (get all request from frontsite)
        $data = $request->all();

        // Lalu datanya di store ke database
        $role = Role::create($data);

        // Bikin Alert Sukses disimpan
        alert()->success('Berhasil', 'Data Role berhasil disimpan!');
        return redirect()->route('backsite.role.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        $role->load('permission');

        return view('pages.backsite.management-access.role.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $permission = Permission::all();
        $role->load('permission');
        return view('pages.backsite.management-access.role.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        // Kita gunakan data untuk menampung semua request (get all request from frontsite)
        $data = $request->all();

        // Lalu datanya di store ke database
        $role->update($data);
        $role->permission()->sync($request->input('permission',[]));

        // Tambahkan alert sukses update data
        alert()->success('Berhasil', 'Data Role berhasil diupdate!');
        return redirect()->route('backsite.role.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->forceDelete();
        // Bikin alert sukses delete data
        alert()->success('Berhasil', 'Data Role berhasil dihapus!');
        return redirect()->route('backsite.role.index');
    }
}

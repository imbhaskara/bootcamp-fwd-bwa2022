<?php

namespace App\Http\Controllers\Backsite;

use App\Http\Controllers\Controller;

// use library here
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

// request
use App\Http\Requests\User\StoreUserRequest;
use App\Http\Requests\User\UpdateUserRequest;

// use everything here
use Gate;
use Auth;

// use model here
use App\Models\User;
use App\Models\ManagementAccess\DetailUser;
use App\Models\ManagementAccess\Permission;
use App\Models\ManagementAccess\Role;
use App\Models\MasterData\TypeUser;

// thirdparty package


class UserController extends Controller
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
        abort_if(Gate::denies('user_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        $user = User::orderBy('created_at', 'desc')->get();
        $type_user = TypeUser::orderBy('name', 'asc')->get();
        $roles = Role::all()->pluck('title', 'id');

        return view('pages.backsite.management-access.user.index', compact('user', 'type_user', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return abort (404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserRequest $request)
    {
        // get all data request from frontsite
        $data = $request->all();

        // hash password
        $data['password'] = Hash::make($data['password']);

        // Store to Database
        $user = User::create($data);

        // Sync role by users select
        $user->role()->sync($request->input('role', []));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        // Pasang Gate untuk menolak akses ketika tidak punya permissions
        abort_if(Gate::denies('user_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $user->load('role');
        return view('pages.backsite.management-access.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        // Pasang Gate untuk menolak akses ketika tidak punya permissions
        abort_if(Gate::denies('user_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $role = Role::all()->pluck('title', 'id');
        $type_user = TypeUser::orderBy('name', 'asc')->get();
        $user->load('role');

        return view('pages.backsite.management-access.user.edit', compact('user', 'type_user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        // get all data request from frontsite
        $data = $request->all();

        // Update to database
        $user->update($data);

        // Update roles
        $user->role()->sync($request->input('role', []));

        // Save to detail user, to set type user
        $detail_user = DetailUser::find($user['id']);
        $detail_user->type_user_id = $request->input('type_user_id');
        $detail_user->save();

        // Pasang alert sukses update data
        alert()->success('Berhasil', 'Data User berhasil diupdate');
        return redirect()->route('backsite.user.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Pasang Gate untuk menolak akses ketika tidak punya permissions
        abort_if(Gate::denies('user_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
        
        $user->forceDelete();
        alert()->success('Berhasil', 'Data User berhasil dihapus');
        return redirect()->route('backsite.user.index');
    }
}

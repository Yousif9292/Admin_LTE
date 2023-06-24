<?php

namespace App\Http\Controllers;

use App\Models\User;
use DataTables;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use DB;
use Hash;
use Illuminate\Support\Arr;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     *
     */
    function __construct()
    {
         $this->middleware('permission:view-users|', ['only' => ['index','show']]);
         $this->middleware('permission:create-users', ['only' => ['create','store']]);
         $this->middleware('permission:edit-users', ['only' => ['edit','update']]);
         $this->middleware('permission:destroy-users', ['only' => ['destroy']]);
    }



    public function index(Request $request)
    {
        // $users= user::all();
        // return view('users.index' , compact('users'));

        if ($request->ajax()) {
            $data = User::select('id', 'name', 'email', 'subscribed_plans')->get();
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '<a href="' . route('users.edit', $row->id) . '"  class="edit btn btn-primary btn-sm ">Edit</a>';

                    $btn = $btn.  '  <form action="' .route('users.destroy', $row->id) . '" method="POST" style="display: inline;">
                    ' . csrf_field() . '
                    ' . method_field('DELETE') . '

                    <button type="submit" style="background-color:#cf1010" class="btn btn-danger btn-sm delete" onclick="deleteUser(event, '.$row->id.')">Delete</button>
                </form>';

                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('/users.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $roles = Role::pluck('name','name' ,  'deleteable', 1)->all();
        return view('users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'roles' => 'required'

        ]);

        $user = new User;
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));

        $roles = $request->input('roles');
        $user->assignRole($roles);
        $user->save();

        return redirect('/users');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view('users.index',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $users = user::find($id);
        $roles = Role::pluck('name','name')->all();
        $userRole = $users->roles->pluck('name','name')->all();
        return view('users.edit', compact('users','roles','userRole'));
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
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'roles' => 'required'


        ]);
        $users = User::find($id);

        $users->name = $request->input('name');
        $users->email = $request->input('email');

        DB::table('model_has_roles')->where('model_id',$id)->delete();

        $users->assignRole($request->input('roles'));


        $users->save();
        return redirect('/users');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        DB::table("users")->where('id',$id)->delete();
        return redirect()->route('users.index')
                        ->with('success','user deleted successfully');

        // $users = user::find($id);
        // $users->delete();
        // return redirect()->back();
    }
}

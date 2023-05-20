<?php

namespace App\Http\Controllers;

use App\Models\User;

use Illuminate\Http\Response;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;
use DB;
Class UserController extends Controller {
    use ApiResponser;
    private $request;
    public function __construct(Request $request) {
    $this->request = $request;
    }
    public function getUsers(){
        $users = DB::connection('mysql')
    ->select("Select * from tblstudent");
    return $this->successResponse($users);
    }

    public function index() 
    {
        $users = User::all();
        return $this->successResponse($users);
    }

    // view student records
    public function getallstud()
    {
        $users = User::all();
        return $this->successResponse($users);
    }

    // insert new record

    public function addstud(Request $request ){
    $rules = [
        'lastname' => 'required|alpha|max:50', 
        'firstname' => 'required|alpha|max:50',
        'middlename' => 'required|alpha|max:50',
        'bday' => 'required|date',
        'age' => 'required|numeric|max:49',
    ];
    $this->validate($request,$rules);
    $user = User::create($request->all());
    return $this->successResponse($user,Response::HTTP_CREATED);
    }



    //search student by studid
        public function getstudid($id)
    {
        $users = User::findOrFail($id);
        return response()->json(['data'=> $users], 200);
        
    //       $user = User::where('studid',$id)->first(); if($user){
    //       return $this->successResponse($user);
    // }
    // {
    //        return $this->errorResponse('user ID Does Not Exists', Response::HTTP_NOT_FOUND);
    // }
    }


    //update student record by studid
        public function updatestudid(Request $request,$id)
    {
    $rules = [
        'lastname' => 'required|max:50', 
        'firstname' => 'required|max:50',
        'middlename' => 'required|max:50',
        'bday' => 'required|date',
        'age' => 'required|max:49',
    ];
    $this->validate($request, $rules);
    $user = User::findOrFail($id);
    $user->fill($request->all());

    //alt
            if ($user->isClean()) {
                return $this->errorResponse('At least one value must change', Response::HTTP_UNPROCESSABLE_ENTITY);
    }
            $user->save();
            return $this->successResponse($user);

    }

    //delete student record by studid
            public function deletestudid($id)
    {
            $user = User::findOrFail($id);
            $user->delete();

    return $this->successResponse($user);
    }
}
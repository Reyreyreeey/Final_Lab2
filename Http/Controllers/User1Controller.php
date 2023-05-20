<?php

namespace App\Http\Controllers;

//use App\User;
// use App\Models\User;  // <-- your model is located insired Models Folder
use Illuminate\Http\Response; // Response Components
use App\Traits\ApiResponser;  // <-- use to standardized our code for api response
use Illuminate\Http\Request;  // <-- handling http request in lumen
use DB; // <-- if your not using lumen eloquent you can use DB component in lumen
use App\Services\User1Service; // user1 Services
use App\Services\User2Service; // user1 Services


Class User1Controller extends Controller {
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



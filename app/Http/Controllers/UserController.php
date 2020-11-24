<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $users = User::where('name','LIKE','%'.$request->search.'%')
            ->orWhere('lastname','LIKE','%'.$request->search.'%')
            ->orWhere('email','LIKE','%'.$request->search.'%')
            ->orderBy($request->orderBy)            
            ->paginate((int)$request->pageSize);
       
        return response()->json(compact(['users']));
    }

}

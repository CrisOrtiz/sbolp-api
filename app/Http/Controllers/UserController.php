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
    public function index($pageSize, $currentPage, $search, $orderBy)
    {
        $users = User::where('name','LIKE','%'.$search.'%')
            ->orWhere('lastname','LIKE','%'.$search.'%')
            ->orWhere('email','LIKE','%'.$search.'%')
            ->orderBy($orderBy)
            ->paginate((int)$pageSize)
            ->skip((int)$currentPage * (int)$pageSize)
            ->get();

        $totalItem = $users->count();
        $totalPage = $currentPage;
       
        return response()->json(compact(['users','totalItem', 'totalPage']));
    }

}

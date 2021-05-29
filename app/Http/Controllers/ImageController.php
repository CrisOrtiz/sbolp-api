<?php

namespace App\Http\Controllers;

use File;
use App\Models\User;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ImageController extends Controller
{

    public function store(Request $request){   
    
        if ($request->hasFile('file')) {
            if($request->rel_type == 'case'){
                $item = ClinicCase::findOrFail($request->id);                
                $destinationPath = public_path('/img/posts');
            }elseif ($request->rel_type == 'profile') {
                $item = User::findOrFail($request->id);
                $destinationPath = public_path('/img/users');
            }else{
                $message = 'unknown rel_type';
                return response()->json(compact('message'), 400);    
            }           
            $image = $request->file('file');
            $name = 'img-'.$request->rel_type.'-'.$request->id.'.jpg';
            $image->move($destinationPath, $name);
            $message = 'image uploaded successfully';
            
            $item->image_name = $name;
            $item->save();
        }         
    
        return response()->json(compact('name'), 200);    
    }

    public function delete(Request $request){  

            if($request->rel_type == 'article'){
                $item = Article::findOrFail($request->id);  
                $image_name = $item->image_name;              
                $filePath = public_path('/img/posts/'.$image_name);
            }elseif ($request->rel_type == 'user') {
                $item = User::findOrFail($request->id);
                $image_name = $item->image_name;
                $filePath = public_path('/img/users/'.$image_name);
            }else{
                $message = 'invalid rel type';
                return response()->json(compact('message'), 400);    
            }           
                     
            if(File::exists($filePath)){
                File::delete($filePath);
                $message = 'Image removed successfully';
                $item->image_name = null;
                $item->save(); 
            }                
    
        return response()->json(compact('message'), 200);    
    }

    public function getImageUrl($id)
    {
        $filePath = public_path().'/uploads/images/'.$id.'.jpg';

        return response()->json(compact('filePath'), 200);
    }
}


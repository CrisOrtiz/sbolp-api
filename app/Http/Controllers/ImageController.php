<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\File;
use App\Models\User;
use App\Models\ClinicCase;
use App\Models\Comment;
use App\Models\Image;
use App\Transformers\ImageTransformer;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image as InterventionImage;
use Illuminate\Support\Facades\Response;

class ImageController extends Controller
{

    public function store(Request $request)
    {
        if ($request->hasFile('file')) {

            $image = $request->file('file');
            if ($image->getSize() > 5000000) {
                $message = 'Imagen muy grande, max 5Mb.';
                return response()->json(compact('message'), 400);
            }

            if ($request->rel_type == 'case') {
                $item = ClinicCase::findOrFail($request->id);
                if (!File::isDirectory(public_path('/img/cases/') . $request->id . '/')) {
                    File::makeDirectory(public_path('/img/cases/') . $request->id . '/', 0777, true, true);
                }
                $destinationPath = public_path('/img/cases/' . $request->id . '/');
                $name = 'img-' . $request->rel_type . '-' . $request->id . '-' . $request->image_name;
                $image_url = 'img/cases/' . $request->id . '/' . $name;
            } elseif ($request->rel_type == 'profile') {
                if (!File::isDirectory(public_path('/img/users/') . $request->id . '/')) {
                    File::makeDirectory(public_path('/img/users/') . $request->id . '/', 0777, true, true);
                }
                $item = User::findOrFail($request->id);
                $destinationPath = public_path('/img/users/' . $request->id . '/');
                $name = 'img-' . $request->rel_type . '-' . $request->id . '.jpg';
                $image_url = 'img/users/' . $request->id . '/' . $name;
                $item->image_url = $image_url;
                $item->save();

                Comment::where('user_id', $request->id)
                    ->update(['thumb_url' => $image_url]);
            } else {
                $message = 'Unknown relation type.';
                return response()->json(compact('message'), 400);
            }

            InterventionImage::make($image)
                ->resize(null, 720, function ($constraint) {
                    $constraint->aspectRatio();
                })->save($destinationPath . $name);

            $imageExists = Image::where('image_name', $name)->first();

            if (!$imageExists) {
                $imageRecord = new Image();
                $imageRecord->rel_type = $request->rel_type;
                $imageRecord->rel_id = $request->id;
                $imageRecord->image_url = $image_url;
                $imageRecord->section = substr($request->image_name, 0, -6);;
                $imageRecord->image_name = $name;
                $imageRecord->save();
            } else {
                $imageRecord = $imageExists;
            }

            $message = 'Image uploaded successfully';
            return $this->item($imageRecord, new ImageTransformer);
        } else {
            $message = 'No file was sent';
            return response()->json(compact('message'), 404);
        }
    }

    public function delete(Request $request)
    {
        $message = 'invalid rel type';
        $imageUrl = explode('?',$request->img_url)[0];
        if ($request->rel_type == 'case') {
            if (File::exists(public_path($imageUrl))) {
                if (Image::where('image_url', $imageUrl)->delete()) {
                    File::delete(public_path($imageUrl));
                } else {
                    $message = 'error on delete file';
                    return response()->json(compact('message'), 400);
                }
            }
        } elseif ($request->rel_type == 'user') {
            $id = $request->user_id;
            $user = User::findOrFail($id);
            if (File::exists(public_path($imageUrl))) {
                if (Image::where('image_url', $imageUrl)->delete()) {
                    File::delete(public_path($imageUrl));
                } else {
                    $message = 'error on delete file';
                    return response()->json(compact('message'), 400);
                }
                $user->image_url = 'img/users/default-user.jpg';
                $user->save();
            }
        } else {
            $message = 'invalid rel type';
            return response()->json(compact('message'), 400);
        }

        return response()->json(compact('message'), 200);
    }

    public function getImageUrl($id)
    {
        $filePath = public_path() . '/uploads/images/' . $id . '.jpg';

        return response()->json(compact('filePath'), 200);
    }
}

<?php

namespace App\Http\Controllers;

use File;
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
            $avoidOverride = true;
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
                } else {
                    $avoidOverride = false;
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

            if ($avoidOverride) {
                $imageRecord = new Image();
                $imageRecord->rel_type = $request->rel_type;
                $imageRecord->rel_id = $request->id;
                $imageRecord->image_url = $image_url;
                $imageRecord->image_name = $name;
                $imageRecord->save();
            } else {
                $imageRecord = Image::where('image_name', $request->image_name)->first();
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

        if ($request->rel_type == 'article') {
            $item = Article::findOrFail($request->id);
            $image_name = $item->image_name;
            $filePath = public_path('/img/posts/' . $image_name);
        } elseif ($request->rel_type == 'user') {
            $item = User::findOrFail($request->id);
            $image_name = $item->image_name;
            $filePath = public_path('/img/users/' . $image_name);
        } else {
            $message = 'invalid rel type';
            return response()->json(compact('message'), 400);
        }

        if (File::exists($filePath)) {
            File::delete($filePath);
            $message = 'Image removed successfully';
            $item->image_name = null;
            $item->save();
        }

        return response()->json(compact('message'), 200);
    }

    public function getImageUrl($id)
    {
        $filePath = public_path() . '/uploads/images/' . $id . '.jpg';

        return response()->json(compact('filePath'), 200);
    }
}

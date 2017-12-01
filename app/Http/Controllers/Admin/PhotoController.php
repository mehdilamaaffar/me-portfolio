<?php

namespace App\Http\Controllers\Admin;

use App\Photo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\PhotoRepository;

class PhotoController extends Controller
{
    protected $photoRepository;

    public function __construct(PhotoRepository $photoRepository)
    {
        $this->photoRepository = $photoRepository;
    }

    public function upload(Request $request)
    {
        return $this->photoRepository->upload($request);
    }

    public function delete($photoId)
    {
        $photo = Photo::findOrFail($photoId);

        unlink($photo->file_path);
        unlink($photo->thumbnail_path);

        $photo->delete();

        // TODO: change to json format
        // return response()->json(['status', 'the photo was deleted successfuly']);

        return redirect()->back();
    }
}

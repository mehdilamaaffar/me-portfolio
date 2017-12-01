<?php

namespace App\Repositories;

use App\Photo;
use App\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 * photo Repository
 */
class PhotoRepository
{
    use BaseRepository;

    protected $model;

    public function __construct(Photo $photo)
    {
        $this->model = $photo;
    }

    public function upload(Request $request)
    {
        $this->model
             ->setThumbnailWidth(400)
             ->setThumbnailHeight(300)
             ->move($request->file('file'));

        $gallery = Gallery::findOrFail($request->input('gallery_id'));

        $photo = $gallery->photos()->create([
            'gallery_id' => $request->input('gallery_id'),
            'file_name' => $this->model->fileName(),
            'file_size' => $request->file->getClientSize(),
            'file_mime' => $request->file->getClientMimeType(),
            'file_path' => $this->model->imagePath(),
            'user_id' => Auth::user()->id,
            'thumbnail_path' => $this->model->thumbnailPath(),
        ]);

        return $photo;
    }

    public function latestPhotos($number = 30)
    {
        return $this->model
                    ->take($number)
                    ->latest()
                    ->get();
    }

    public function getPhoto($id)
    {
        return $this
                    ->model
                    ->with('gallery')
                    ->find($id);
    }
}

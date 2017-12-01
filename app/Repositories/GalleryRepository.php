<?php

namespace App\Repositories;

use App\Gallery;
use Illuminate\Support\Facades\Auth;

/**
 * Comment Repository
 */
class GalleryRepository
{
    use BaseRepository;

    protected $model;

    public function __construct(Gallery $gallery)
    {
        $this->model = $gallery;
    }

    public function add($request)
    {
        return $this->store([
            'name'      => $request->input('gallery_name'),
            'name_slug' => str_slug($request->input('gallery_name')),
            'user_id'   => Auth::user()->id,
            'published' => 1,
        ]);
    }

    public function galleryPhotos($name_slug)
    {
        return $this
                    ->model
                    ->where('name_slug', $name_slug)
                    ->with('photos')
                    ->first();
    }

    public function getLatest()
    {
        return $this
                    ->model
                    ->latest()
                    ->get();
    }

    public function getGalleriesWithLatestPhoto()
    {
        return $this
                    ->model
                    ->categories()
                    ->get();
    }

    public function get($galleryId)
    {
        return $this
                    ->model
                    ->findOrFail($galleryId);
    }

    public function getPhoto($id)
    {
        return $this
                ->model
                ->getphoto($id);
    }

    public function deleteWithPhotos($galleryId)
    {
        $currentGallery = $this
                                ->model
                                ->findOrFail($galleryId);

        if ($currentGallery->user_id != Auth::user()->id) {
            abort('403', 'You don\'t have privilage to delete this gallery');
        }

        foreach ($currentGallery->photos as $photo) {
            @unlink(public_path($photo->file_path));
            @unlink(public_path($photo->thumbnail_path));
        }

        $currentGallery->photos()->delete();

        $currentGallery->delete();
    }
}

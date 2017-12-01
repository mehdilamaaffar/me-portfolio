<?php

namespace App\Http\Controllers;

use App\Photo;
use App\Gallery;
use Illuminate\Http\Request;
use App\Repositories\PhotoRepository;
use App\Repositories\GalleryRepository;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(PhotoRepository $photo)
    {
        $photos = $photo->latestPhotos();

        return view('home', compact('photos'));
    }

    /**
     * Show the photos by thiere categories.
     *
     * @return \Illuminate\Http\Response
     */
    public function categories(GalleryRepository $galleryRepo)
    {
        $categories = $galleryRepo->getGalleriesWithLatestPhoto();

        return view('gallery.categories', compact('categories'));
    }

    /**
     * show gallery and all photos associate with
     *
     * @param  string $name
     */
    public function show(Gallery $gallery)
    {
        return view('gallery.photos', compact('gallery'));
    }

    /**
     * show a single gallery photo
     *
     * @param  int $id
     */
    public function photo(Photo $photo)
    {
        return view('gallery.photo', compact('photo'));
    }
}

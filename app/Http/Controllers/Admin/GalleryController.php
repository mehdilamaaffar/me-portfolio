<?php

namespace App\Http\Controllers\Admin;

use App\Photo;
use App\Gallery;
use App\Http\Flash;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use App\Repositories\GalleryRepository;

class GalleryController extends Controller
{
    private $galleryRepository;

    public function __construct(GalleryRepository $galleryRepository)
    {
        $this->galleryRepository = $galleryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $galleries = $this->galleryRepository->getLatest();

        return view('admin.gallery.index', compact('galleries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'gallery_name' => 'required|min:3|max:20'
        ]);

        $this->galleryRepository->add($request);

        return Flash::success('the gallery has been added !')->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($galleryId)
    {
        $gallery = $this->galleryRepository->get($galleryId);

        return view('admin.gallery.upload', compact('gallery'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($galleryId)
    {
        $this->galleryRepository->deleteWithPhotos($galleryId);

        return Flash::success('the gallery and their photo has been deleted !')->back();
    }

    public function categories()
    {
        $categories = Gallery::categories();

        return view('categories', compact($categories));
    }

    public function truncateDatabase()
    {
        if(! Auth::check()) {
            abort(404);
        }

        Gallery::truncate();
        Photo::truncate();

        $paths = [
            public_path('repository/photos'),
            public_path('repository/photos/thumbnails')
        ];

        foreach ($paths as $path) {
            File::cleanDirectory($path);
        }

        return redirect()->route('home');
    }

    public function deleteUnusedPhotos()
    {
        // get the list of all photo from database
        $model = Photo::select(['file_path', 'thumbnail_path'])->get();

        // get the list of all photo from disk
        $disk_photos = File::files(public_path(config('portfolio.photos_path')));
        $disk_thumbnails = File::files(public_path(config('portfolio.thumbnails_path')));

        // combine them into one array and delete unpresent items
        $photos_path = $model->all();

        $photos_diff = array_diff($disk_photos, $photos_path);

        foreach ($photos_diff as $photo) {
            @unlink($photo->getPathName());
        }

        // combine them into one array and delete unpresent items
        $thumbnails_path = $model->pluck('thumbnail_full_path')->all();
        $thumbnails_diff = array_diff($disk_thumbnails, $thumbnails_path);

        foreach ($thumbnails_diff as $thumbnail) {
            @unlink($thumbnail->getPathName());
        }

        return redirect()->route('home');
    }
}

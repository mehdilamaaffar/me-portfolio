<?php

namespace App;

use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    protected $guarded = [];

    protected $uploadedFile;

    protected $width;

    protected $height;

    public function gallery()
    {
        return $this->belongsTo(Gallery::class);
    }

    public function fileName()
    {
        $fileName = sha1($this->uploadedFile->getClientOriginalName());

        $extension = $this->uploadedFile->getClientOriginalExtension();

        return "{$fileName}.{$extension}";
    }

    public function basePath()
    {
        return 'repository'. DIRECTORY_SEPARATOR .'photos' . DIRECTORY_SEPARATOR;
    }

    public function imagePath()
    {
        return $this->basePath() . $this->fileName();
    }

    public function thumbnailPath()
    {
        $thumbnailPath = $this->basePath() . 'thumbnails' . DIRECTORY_SEPARATOR;

        if (! file_exists($thumbnailPath)) {
            mkdir($thumbnailPath, 0777, true);
        }

        return $thumbnailPath . $this->fileName();
    }

    public function setThumbnailWidth($width)
    {
        $this->width = $width;

        return $this;
    }

    public function setThumbnailHeight($height)
    {
        $this->height = $height;

        return $this;
    }

    public function resize()
    {
        Image::make($this->imagePath())
             ->fit($this->width, $this->height, function ($contraint) {
                $contraint->aspectRatio();
             })
             ->save($this->thumbnailPath());
    }

    public function move(UploadedFile $uploadedFile)
    {
        $this->uploadedFile = $uploadedFile;

        $this->uploadedFile->move($this->basePath(), $this->fileName());

        $this->resize();
    }

    public function getPhotoFullPathAttribute()
    {
        return public_path($this->file_path);
    }

    public function getThumbnailFullPathAttribute()
    {
        return public_path($this->thumbnail_path);
    }
}

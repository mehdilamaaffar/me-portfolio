<?php

Route::auth();

// home route
Route::redirect('/', '/home');
Route::get('/home', 'HomeController@index')->name('home');

// Show Gallery by Categories with the one latest image
Route::get('/categories', 'HomeController@categories');

Route::get('/contact', 'ContactController@index');
Route::post('/contact', 'ContactController@store');

// admin dashboard
Route::group(['namespace' => 'admin', 'prefix' => 'admin', 'middleware' => 'auth'], function () {
    Route::get('/', 'GalleryController@index')->name('admin');
    Route::resource('gallery', 'GalleryController');

    Route::get('/gallery/delete/{id}', 'GalleryController@destroy')->name('gallery.delete');

    Route::post('/photo/upload', 'PhotoController@upload')->name('photo.upload');

    // delete single photo
    Route::get('/photo/delete/{id}', 'PhotoController@delete')->name('photo.delete');

    // truncate database and local photo
    Route::get('/truncate-database', 'GalleryController@truncateDatabase');

    // delete unused photos
    Route::get('/clean', 'GalleryController@deleteUnusedPhotos');
});

// get gallery and their latest image thumbnail
Route::get('/gallery/{gallery}', 'HomeController@show')->name('gallery.photos');

// show a single image with form
Route::get('/photo/{photo}', 'HomeController@photo')->name('photo.show');

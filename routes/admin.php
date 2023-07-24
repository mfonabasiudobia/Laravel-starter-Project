<?php

use Illuminate\Support\Facades\Route;

Route::group(['namespace' => "App\Http\Livewire\Admin", "as" => "admin."],function () {


    Route::get('logout', "Auth\Login@logout")->name('logout');

    Route::group(['middleware'=> ['AdminAuth']], function() {

        Route::get('/',"Auth\Login")->name('login');
        Route::get('dashboard',"Dashboard\Home")->name('dashboard');

        Route::group(['prefix'=> 'video'], function() {
            Route::get('create',"Video\Create")->name('video.create');
            Route::get('{id}/edit',"Video\Edit")->name('video.edit');
        });

        Route::get('calendar-view',"Calendar\Home")->name('calendar');

    });
    
    
});

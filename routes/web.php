<?php



Route::get('/{any}', 'SinglePageController@index')->name('main')->where('any', '.*');


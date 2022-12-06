<?php
	
	Route::group(['namespace'=>'Kashana\Contact\Http\Controllers'],function(){
		Route::get('/contact','ContactController@index')->name('contact_index'); 
		Route::post('/contact','ContactController@store')->name('contact_store');
	});

	
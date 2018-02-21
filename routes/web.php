<?php

//pilih menu
Route::get('/', function () {
    return view('index');
});
//foto grayscale :
Route::get('/fotograyscale', function () {
    return view('FotoGrayscale');
});
Route::post('/fotograyscale', 'direktoriController@proses');

//fungsi penghitung berapa foto yg still missing
Route::get('/matcher','direktoriController@matcherIndex');
Route::post('/matcher', 'direktoriController@matcher');

//langsung grayscale foto dalam suatu direktori
Route::get('/proses', 'direktoriController@proseslangsung');

//Getter Data nama, tanggal lulus dari dbf
Route::get('/datadbf', 'DBFController@getIndex');
Route::post('/datadbf', 'DBFController@Cari');

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

Route::get('pengaturan', 'direktoriController@GetPengaturan');
Route::put('pengaturan', 'direktoriController@UpdatePengaturan');

Route::get('transpose', 'DBFController@GetTranspose');
Route::get('ssdownloader', 'SSController@GetSSDownloader');
Route::post('ssdownloader', 'SSController@ProsesDownload');

Route::get('csv', 'SSController@getCsv');
Route::post('csv', 'SSController@import');

Route::get('tes', function(){
  $output = shell_exec('scp -P 143 student@studentsite.gunadarma.ac.id:/home/student/foto/11115442.jpg ./foto2013');
  return "<pre>$output</pre>";
});

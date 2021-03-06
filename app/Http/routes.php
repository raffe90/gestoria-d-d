<?php

Route::get('/', 'PagesController@index');

Route::get('/juridico', 'PagesController@juridico');

Route::get('/empleadas-hogar', 'PagesController@empleadas_hogar');

Route::get('/herencia', 'PagesController@herencia');

Route::post('/contacto', 'PagesController@contacto');

Route::get('/terms-and-conditions', 'PagesController@terms_and_conditions');

Route::get('/legal', 'PagesController@legal');


Route::group(['prefix' => 'empresas'], function () {
  Route::get('autonomos', 'BusinessController@autonomos');
  Route::get('sociedades', 'BusinessController@sociedades');
  Route::get('laboral', 'BusinessController@laboral');
  Route::get('otras-organizaciones', 'BusinessController@otras_organizaciones');
});

Route::group(['prefix' => 'traficos'], function () {
  Route::get('transferencia-de-vehiculos', 'TrafficsController@transferencia_de_vehiculos');
  Route::get('informe-trafico', 'TrafficsController@informe_trafico');
  Route::get('otras-gestiones', 'TrafficsController@otras_gestiones');
  Route::get('documentacion', 'TrafficsController@documentacion');
});

Route::group(['prefix' => 'tramites'], function () {
  Route::get('declaracion-renta', 'ProceduresController@declaracion_renta');
  Route::get('alquiler-ivima', 'ProceduresController@alquiler_ivima');
  Route::get('informe-trafico', 'ProceduresController@certificados');
  Route::get('creacion-web', 'ProceduresController@creacion_web');
  Route::get('creacion-marcas', 'ProceduresController@creacion_marcas');
});


Route::group(['prefix' => 'pdf'], function () {
  Route::get('show/{filename}', 'PDFsController@show');
});

Route::group(['prefix' => 'dashboard', 'middleware' => 'auth'], function () {
  Route::get('/', 'DashboardController@index');

  Route::get('/users', 'UsersController@index');
  Route::put('/users/{slug}/{id}', 'UsersController@update');
  Route::delete('/users/{slug}/{id}', 'UsersController@destroy');

  Route::delete('/files/{id}', 'FilesController@destroy');
  Route::put('/files/{id}', 'FilesController@update');

  Route::delete('/folders/{id}', 'FoldersController@destroy');
  Route::put('/folders/{id}', 'FoldersController@update');

  Route::group(['prefix' => 'users/{slug}/{id}'], function () {

    Route::get('/', 'UsersController@show');
    Route::post('/files', 'FilesController@store');
    Route::post('/folders', 'FoldersController@store');

    Route::group(['prefix' => '/files/{file_slug}/{file_id}'], function () {
      Route::get('/', 'FilesController@show');
    });

    Route::group(['prefix' => '/folders/{folder_slug}/{folder_id}'], function () {
      Route::get('/', 'FoldersController@show');
    });

  });

});

// Authentication routes...
Route::get('auth/login', 'Auth\AuthController@getLogin');
Route::post('auth/login', 'Auth\AuthController@postLogin');
Route::get('auth/logout', 'Auth\AuthController@getLogout');

// Registration routes...
Route::get('auth/register', 'Auth\AuthController@getRegister');
Route::post('auth/register', 'Auth\AuthController@postRegister');

// Password reset link request routes...
Route::get('password/email', 'Auth\PasswordController@getEmail');
Route::post('password/email', 'Auth\PasswordController@postEmail');

// Password reset routes...
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset', 'Auth\PasswordController@postReset');


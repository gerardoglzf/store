<?php

Route::get('/', function () {
    return view('index');
});

Route::get('/registros',function(){
    return view('registros.usuarios');
});

Route::get('/perfil_Usuario',function(){
    return view('perfil_Usuario.perfil');
});
Route::get('/show_Producto',function(){
   return view('show_Producto.show'); 
});
Route::post('img'.'productosController@img');

Route::resource('usuarios','usuariosController');

Route::resource('log','LogController');

Route::get('/', 'productosController@index');

Route::get('perfil_Usuario','productosController@perfil');


Route::get('producto/{parameters}','productosController@edit');

Route::get('producto/{parameters}/editar','productosController@edit');

Route::get('producto/{parameters}/borrar','productosController@destroy');

Route::get('producto/{parameters}/ofrecer','productosController@ofrecer');

Route::resource('producto','productosController');


Route::resource('imagen','imagenController');
//Ruta para la edicion de usuario
Route::get('editar/{id_usaurio}','usuariosController@edit');

Route::post('search','productosController@search')->name('search');

Route::get('cerrar_sesion','LogController@logout');
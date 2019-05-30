<?php

namespace TecStore\Http\Controllers;

use Auth;
use Session;
use Redirect;   
use TecStore\imagen;
use TecStore\productos;
use TecStore\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class productosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index()
    {
        $data = DB::table('users')
        ->join(
            'productos',
            'productos.id_usuario',
            'users.id')
        ->join(
            'imagen',
            'productos.id',
            'imagen.id_producto')
        ->where(
            'productos.status',
            '=',
            '1')
        ->select(
        'users.nombre',
        'users.apellido',
        'users.avatar',
        'users.num_cel',
        'users.facebook',
        'users.correo',
        'productos.precio',
        'productos.cantidad',
        'productos.id',
        'productos.descripcion',
        'imagen.alt',
        'imagen.url')
        ->get();

        
        return view('index',['data'=>$data]);
        
    }
    public function perfil(){
        
         $item=DB::table('productos')->join('imagen','productos.id','imagen.id_producto')->where('productos.id_usuario','=',auth::user()->id)->where('productos.status','=','1')->select('productos.*','imagen.*')->get();
         $itemSold=DB::table('productos')->join('imagen','productos.id','imagen.id_producto')->where('productos.id_usuario','=',auth::user()->id)->where('productos.status','=','0')->select('productos.*','imagen.*')->get();
        
   
        return view('perfil_Usuario.perfil',['item'=>$item,'itemSold'=>$itemSold]);

    }

    public function showImg(){
        $show = imagen::where('id_producto');
    }
    /**
     * Show the form for creating a new resource.   
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
          
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //return view('index');
       $producto = productos::create([
           'nombre' => $request['nom_producto'],
           'descripcion' => $request['descripcion'],
           'cantidad' => $request['cantidad'],
           'precio' => $request['precio'],
           'status' => '1',
           'id_usuario' => Auth::id(),
        ]);
        
        $this->img($request,$producto->id);
        return redirect('/perfil_Usuario')->with('message','store');
    }

    public function img(Request $request,$id){
        $nombre="";
        $archivo="";
    
        if($request->hasFile('file')){
            $archivo = $request->file('file');
            $nombre = time().$archivo->getClientOriginalName();
            $archivo->move(public_path().'/productos/',$nombre);
        }

        imagen::create([
            'id_producto' => $id,
            'url' => $nombre,
            'alt' => $request['nom_producto'],
        ]);

        
    }

    /* 
     * 
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $nombre_p = productos::where('nombre','=',$nombre);
        return view('perfil_Usuario.update',compact('nombre_p'));
    }

    /** 
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {        
    //Este causa el problema

    $producto = productos::where('id',$id)->get();
    $item=DB::table('productos')->join('imagen','productos.id','imagen.id_producto')->where('productos.id_usuario','=',auth::user()->id)->select('productos.*','imagen.*')->get();
    //return $item;
    return view('perfil_Usuario.update',['producto'=>$producto,'item'=>$item]);   
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $editar=productos::find($id);
        $editar->nombre = $request->get('nom_producto');
        $editar->descripcion = $request->get('descripcion');
        $editar->cantidad = $request->get('cantidad');
        $editar->precio = $request->get('precio');
        $editar->save();
        return Redirect::to('perfil_Usuario');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $editar=productos::find($id);
        $editar->status='0';
        $editar->save();
        return Redirect::to('perfil_Usuario');
    }
    public function ofrecer($id){
        $editar=productos::find($id);
        $editar->status='1';
        $editar->save();
        return Redirect::to('perfil_Usuario');
    }
    public function search(Request $request){
        $buscar=$request->get('search');
        $data = DB::table('users')
        ->join(
            'productos',
            'productos.id_usuario',
            'users.id')
        ->join(
            'imagen',
            'productos.id',
            'imagen.id_producto')
        ->where(
            'productos.status',
            '=',
            '1'
            )
        ->where(
            'productos.nombre',
            'like',
            '%' . $buscar . '%'
            )
        ->select(
            'users.nombre',
            'users.apellido',
            'users.avatar',
            'users.num_cel',
            'users.facebook',
            'users.correo',
            'productos.precio',
            'productos.cantidad',
            'productos.id',
            'productos.descripcion',
            'imagen.alt',
            'imagen.url')
        ->get();
        return view('index',['data'=>$data]);
    }
}

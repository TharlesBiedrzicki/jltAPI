<?php

namespace App\Http\Controllers;

use App\Models\UsuarioAPI;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioAPIController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!$request->isJson()) return response() -> json(['error' => 'os dados devem ser enviados no formato JSON'], 415);
        if(!$request->json()->has('email') || !$request->json()->has('email')) {
            return response()->json(['error' => 'campos email e senha são obrigatórios'], 400);
        }
        $dados = $request->json()->all();
        $usuarioAPI=new UsuarioAPI();
        $usuarioAPI->email = $dados['email'];
        $usuarioAPI->senha = sha1($dados['senha']);
        $usuarioAPI->token = Hash::make($dados['senha']);
        if($usuarioAPI->save()){
            return response()->json(['token' => $usuarioAPI->token], 201);
        }
        return response()->json(['error'=>'algum problema na API'], 500);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UsuarioAPI  $usuarioAPI
     * @return \Illuminate\Http\Response
     */
    public function show(UsuarioAPI $usuarioAPI)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UsuarioAPI  $usuarioAPI
     * @return \Illuminate\Http\Response
     */
    public function edit(UsuarioAPI $usuarioAPI)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UsuarioAPI  $usuarioAPI
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UsuarioAPI $usuarioAPI)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UsuarioAPI  $usuarioAPI
     * @return \Illuminate\Http\Response
     */
    public function destroy(UsuarioAPI $usuarioAPI)
    {
        //
    }
}

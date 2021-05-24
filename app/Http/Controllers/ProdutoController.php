<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{

    public function __construct()
    {
        $this->middleware('apicheck');
    }

    public function all()
    {
        $produtos = Produto::all();
        return response() -> json($produtos, 200);
    }

    public function getOne($id = null)
    {
        if($id == null) return response() -> json(['error' => 'ID mal informado'], 400);
        $produto = Produto::find($id);
        if($produto == null) return response() -> json(['error' => 'Entidade referida pelo id é inexistente'], 404);
        return response() -> json($produto, 200);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!$request->isJson()) return response()->json(['error' => 'Os dados devem ser enviados no formato JSON'], 415);
        //dd($request->all());
        if(!$request->json()->has('nome')) return response()->json(['error' => 'Entrada inválida, campo obrigatório não enviado'], 400);
        //$dados = $request ->json()->all();
        $produto = Produto::create($request ->json()->all());
        return response()->json($produto, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if($id == null) return response()->json(['error' => 'id na URL é obrigatório'], 400);
        $produto = Produto::find($id);
        if($produto == null) return response()->json(['error' => 'não encontrou a entidade desejada para atualizar'], 404);
        $dados = $request->json()->all();
        if($request->json()->has('nome')) $produto->nome = $dados['nome'];
        if($request->json()->has('cor')) $produto->cor = $dados['cor'];
        if($request->json()->has('valor')) $produto->valor = $dados['valor'];
        if($request->json()->has('descricao')) $produto->descricao = $dados['descricao'];
        if($produto->save()) return response()->json($produto, 200); 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($id == null) return response()->json(['error' => 'id na URL é obrigatório'], 400);
        $produto = Produto::find($id);
        if($produto == null) return response()->json(['error' => 'não encontrou a entidade desejada para remover'], 404);
        if($produto -> delete()) return response()->json(['a entidade foi atualizada'], 200);
    }
}

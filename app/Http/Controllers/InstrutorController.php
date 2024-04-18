<?php

namespace App\Http\Controllers;

use App\Models\Instrutor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InstrutorController extends Controller
{

    public $instrutor;

    public function __construct(Instrutor $instrutores){
        $this->instrutor = $instrutores;
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $instrutor = $this->instrutor->all();

        return response()->json($instrutor, 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function create()
    // {
    //     //
    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate($this->instrutor->Regras(), $this->instrutor->Feedback());

        if ($request->hasFile('foto')) {
            $imagem = $request->file('foto');

            $imagem_url = $imagem->store('imagem/instrutores','public');
        }else {
            $imagem_url = null; //Caso seja vazia, continua nulo o campo.
        }

        $instrutores = $this->instrutor->create([
            'nome'      => $request->nome,
            'email'     => $request->email,
            'foto'      => $imagem_url,
        ]);

        return response()->json($instrutores, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */

     //Colocamos o parametro de ID no metodo show, em cima do Integer que utilizamos, dizendo que se trata de um número inteiro qualquer, porém, fazendo ligação com os ID's da tabela instrutor
    public function show($id)
    {
        $instrutores = $this->instrutor->find($id);

        if($instrutores === null){
            return response()->json(["erro","Não existe dados para este instrutor"], 400);
        }

        return response()->json($instrutores, 200);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Instrutor  $instrutor
     * @return \Illuminate\Http\Response
     */
    public function edit(Instrutor $instrutor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Integer
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Instrutor  $instrutor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $instrutores = $this->instrutor->find($id); //Pegando o ID
        

        //verificando se o instrutor existe
        if($instrutores === null){
            return response()->json(["erro" => "Não foi possível dar um update pois esse instrutor não existe!"], 400);
        }


        //verificando o metodo.
        if($request->method() === "PATCH"){

            $dadosDinamico = [];

            foreach($instrutores->Regras() as $input => $regra){
                if(array_key_exists($input,$request->all())){
                    $dadosDinamico[$input] = $regra;
                }
            }
            $request->validate($dadosDinamico, $this->instrutor->Regras());

        }else {
            $request->validate($this->instrutor->Regras(), $this->instrutor->Feedback());
        }

        if($request->file('foto') == true){
            Storage::disk('public')->delete($instrutores->foto);
        }

        $imagem = $request->file('foto');

        $imagem_url = $imagem->store('imagem/instrutores', 'public');

        $instrutores->update([
            'nome'  => $request->nome,
            'foto'  => $imagem_url,
            'email' => $request->email
        ]); 

        return response()->json($instrutores, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Instrutor  $instrutor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $instrutores = $this->instrutor->find($id);

        if($instrutores === null){
            return response()->json(["erro" => "Não foi possível deletar o instrutor, pois ele não existe."], 400);
        }

        Storage::disk('public')->delete($instrutores->foto);

        $instrutores->delete();
        
        return response()->json(['msg' => 'O registro foi removido com sucesso'], 200);
    }
}

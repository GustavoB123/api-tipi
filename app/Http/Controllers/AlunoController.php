<?php

namespace App\Http\Controllers;

use App\Models\Aluno;
use App\Models\Matricula;
use App\Models\Plano;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AlunoController extends Controller
{
    public $aluno;

    public function __construct(Aluno $alunos){
        $this->aluno = $alunos;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $aluno = Aluno::all();

        $aluno = $this->aluno->all();

        return response()->json($aluno, 200);
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
        
        
        // $aluno = Aluno::create($request->all());

        $request->validate($this->aluno->Regras(), $this->aluno->Feedback());

        $imagem = $request -> file('foto');
 
        $imagem_url = $imagem -> store('imagem', 'public');
 
        // dd($imagem_url);
 
        $alunos = $this->aluno->create([
            'nome' => $request-> nome,
            'data_nascimento' => $request-> data_nascimento,
            'sexo' => $request-> sexo,
            'cpf' => $request-> cpf,
            'rg' => $request-> rg,
            'endereco' => $request-> endereco,
            'cidade' => $request-> cidade,
            'cep' => $request-> cep,
            'telefone' => $request-> telefone,
            'email' => $request-> email,
            'profissao' => $request-> profissao,
            'estado_civil' => $request-> estado_civil,
            'altura' => $request-> altura,
            'peso' => $request-> peso,
            'tipo_sanguineo' => $request-> tipo_sanguineo,
            'alergias' => $request-> alergias,
            'medicamentos_uso' => $request-> medicamentos_uso,
            'cirurgias_previas' => $request-> cirurgias_previas,
            'lesoes_previas' => $request-> lesoes_previas,
            'objetivo' => $request-> objetivo,
            'frequencia_semanal' => $request-> frequencia_semanal,
            'horario_preferencial' => $request-> horario_preferencial,
            'data_matricula' => $request-> data_matricula,
            'tipo_plano' => $request-> tipo_plano,
            'status' => $request-> status,
            'foto' => $imagem_url
        ]);
 
        return response()->json($alunos, 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  Integer
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $alunos = $this->aluno->find($id);

        if($alunos === null){
            return response()->json(["erro"=> "Não existe dados para esse aluno."],404);
        }

        return response()->json($alunos, 200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Aluno  $aluno
     * @return \Illuminate\Http\Response
     */
    public function edit(Aluno $aluno)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Aluno  $aluno
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $alunos = $this->aluno->find($id);

        if($alunos === null){
            return response()->json(["erro"=> "Impossível realizar a atualização. O aluno não existe."],404);
        }

        if($request->method() === "PATCH"){

            $dadosDinamico = [];

            foreach($alunos->Regras() as $input => $regra){
                if(array_key_exists($input, $request->all())){
                    $dadosDinamico[$input] = $regra;
                }
            }
            $request->validate($dadosDinamico, $this->aluno->Feedback());
        
        }else{
            
            $request->validate($this->aluno->Regras(), $this->aluno->Feedback());
            
        }
        
    if($request->file('foto') == true) {
            Storage::disk('public')->delete($alunos->foto);
        }
 
        $imagem = $request -> file('foto');
 
        $imagem_url = $imagem -> store('imagem', 'public');
 
       $alunos -> update([
            'nome' => $request->nome,
            'foto' => $imagem_url
       ]); // update dos novos dados
 
       return response()->json($alunos, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Aluno  $aluno
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // return 'DELETADO';

        $alunos = $this->aluno->find($id);

        if($alunos === null){
            return response()->json(["erro"=> "Impossível deletar o registro. O aluno não existe!"],404);
        } 

        Storage::disk('public')->delete($alunos->foto);

        $alunos->delete();
        return response()->json(['msg' => 'O registro foi removido com sucesso'], 200);
    }


    public function getMatricula($idAluno){
        $matricula = Matricula::where('idAluno', $idAluno)->first();

        if ($matricula === null){
            return response()->json(['message'=> 'Matrícula não encontrada'],404);
        }

        return response()->json(['$matricula' => $matricula],200);
    }


    public function getPlano($idAluno){
        $matricula = Matricula::where('idAluno', $idAluno)->first();

        if (!$matricula) {
            return response()->json(['message'=> 'Matrícula não encontrada'],404);
        }

        $plano = Plano::find($matricula->idPlano);

        if (!$plano) {
            return response()->json(['message'=> 'Plano não encontrado'],404);
        }

        return response()->json(['$plano' => $plano], 200);
    }
}

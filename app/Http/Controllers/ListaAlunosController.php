<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUpdateAluno;
use App\Models\Aluno;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ListaAlunosController extends Controller
{
    protected $request;
    private $repository;

    public function __construct(Request $request, Aluno $aluno)
    {
        $this->request    = $request;
        $this->repository = $aluno;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listaAlunos = $this->repository->paginate();
        return view('admin.pages.alunos.lista', ['lista' => $listaAlunos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('admin.pages.alunos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateAluno $request)
    {
        $data = $request->all();

        if ($request->hasFile('imagem') && $request->imagem->isValid()) 
        {            
            $nomeArquivo  = $request->nome . '.' . $request->imagem->extension();  
            $noneAjustado = preg_replace('/[ -]+/' , '_' , $nomeArquivo);            
            $imagePath    = $request->imagem->storeAs('fotosAlunos', $noneAjustado, 'public');
                        
            $data['imagem'] = $imagePath;                
        }

        Aluno::create($data);
        return redirect()->route('lista.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $dados = Aluno::find($id);

        if(!$dados)
        {
            redirect()->back();
        }
        else
        {
            return view('admin.pages.alunos.show', ['aluno' => $dados]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $aluno = Aluno::find($id);        
        return view('admin.pages.alunos.edit',['aluno' => $aluno]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateAluno $request, $id)
    {
        $aluno = Aluno::find($id);
        $disk  = Storage::disk('public');

        if (!$aluno) {
            return redirect()->back();
        }
        $data = $request->all();
        
        if ($request->hasFile('imagem') && $request->imagem->isValid()) 
        {

            if ($aluno->imagem && $disk->exists($aluno->imagem)) //Storage::exists($produto->image))
            {
                $disk->delete($aluno->image);
            }
            
            $nomeArquivo    = $request->nome . '.' . $request->imagem->extension();
            $noneAjustado   = preg_replace('/[ -]+/' , '_' , $nomeArquivo);            
            $imagePath      = $request->imagem->storeAs('fotosAlunos', $noneAjustado, 'public');
            $data['imagem'] = $imagePath;                
        }
        
        $aluno->update($data);
        return redirect()->route('lista.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $aluno = Aluno::find($id);
        $disk  = Storage::disk('public');

        if (!$aluno) {
            return redirect()->back();
        }

        if ($aluno->imagem && $disk->exists($aluno->imagem))
        {
            $disk->delete($aluno->imagem);
        }

        Aluno::destroy($id);
        return redirect()->route('lista.index');
    }

    public function search(Request $request)
    {            
        
        $filters  = $request->except(['_token']);
        $aluno = $this->repository->search($request->filter);
        //dd($request->all());

        return view('admin.pages.alunos.lista', ['lista' => $aluno, 'filters' => $filters]);
    }
}

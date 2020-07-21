<?php

namespace App\Http\Controllers;

use App\Models\Materia;
use Illuminate\Http\Request;

class MateriaController extends Controller
{
    Protected $request;
    private $repository;
    
    public function __construct(Request $request, Materia $materia)
    {
        $this->request = $request;        
        $this->repository = $materia;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $materias = $this->repository->paginate();
        return view('admin.pages.materias.lista', ['lista' => $materias]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.materias.create');
    }

    /**
     * Store a newly created resource in storage.
     *  
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $materia = $this->request->all();
        Materia::create($materia);

        return redirect()->route('materia.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $materia = Materia::find($id);
        return view('admin.pages.materias.edit', ['materia' => $materia]);
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
        $materia = Materia::find($id);
        $data    = $request->all();

        $materia->update($data);
        return redirect()->route('materia.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Materia::destroy($id);        
        return redirect()->route('materia.index');
    }

    public function search(Request $request)
    {            
        
        $filters  = $request->except(['_token']);
        $materia = $this->repository->search($request->filter);
        //dd($request->all());

        return view('admin.pages.materias.lista', ['lista' => $materia, 'filters' => $filters]);
    }
}

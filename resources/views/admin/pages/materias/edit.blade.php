@extends('admin.layouts.app')
@section('content')   
    {{-- @include('admin.includes.alerts') --}}
    <h1>Editando Materia: "{{ $materia->nomeMateria }}"</h1>   
    <form action="{{ route('materia.update', [$materia->id]) }}" method="post" class="form" enctype="multipart/form-data">
        @csrf
        @method('PUT')         
        <hr>
        <div class="form-row">
            <div class="col-md-2 mb-3">
                <label for="validationDefault01">Código Matéria</label>
                <input type="number" class="form-control" name="idCodigoMateria" placeholder="Código" value="{{ $materia->idCodigoMateria ?? old('idCodigoMateria') }}" required>
            </div> 
            <div class="col-md-6 mb-3">
                <label for="validationDefault01">Nome da Matéria</label>
                <input type="text" class="form-control" name="nomeMateria" placeholder="Nome da Máteria" value="{{ $materia->nomeMateria ?? old('nomeMateria') }}" required>
            </div>      
        </div>    
        <hr>
        <div class="form-group">
            <a class="btn btn-primary btn-sm" href="{{ route('materia.index') }}">Voltar</a>
            <button class="btn btn-success btn-sm" type="submit">Confirmar</button>
        </div>           
    </form>    
@endsection
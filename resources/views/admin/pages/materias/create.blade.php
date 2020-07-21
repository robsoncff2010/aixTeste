@extends('admin.layouts.app')
@section('content')
    <h1>Cadastrar nova Matéria</h1>
    {{-- @include('admin.includes.alerts') --}}
    <form action="{{ route('materia.store') }}" method="post" enctype="multipart/form-data" class = "form">
        @csrf
        <hr>        
        <div class="form-row">
            <div class="col-md-2 mb-3">
                <label for="validationDefault01">Código Matéria</label>
                <input type="number" class="form-control" name="idCodigoMateria" placeholder="Código" value="{{ old('idCodigoMateria') }}" required>
            </div> 
            <div class="col-md-6 mb-3">
                <label for="validationDefault01">Nome da Matéria</label>
                <input type="text" class="form-control" name="nomeMateria" placeholder="Nome da Máteria" value="{{ old('nomeMateria') }}" required>
            </div>      
        </div>    
        <hr>
        <div class="form-group">
            <a class="btn btn-primary btn-sm" href="{{ route('materia.index') }}">Voltar</a>
            <button class="btn btn-success btn-sm" type="submit">Confirmar</button>
        </div>   
    </form>
@endsection
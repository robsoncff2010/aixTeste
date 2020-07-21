@extends('admin.layouts.app')
@section('content')
    <h1>Importar XML de Matérias</h1>
    <hr>
    <h3>Infelizmente não consegui executar essa função para ler o documento XML e importar, queria agradecer a todos pela atenção</h3>
    {{-- @include('admin.includes.alerts') --}}
    {{-- <form action="xml.create" method="post" enctype="multipart/form-data" class = "form"> --}}
        @csrf
        <hr>
        <div class="form-group">
            <input type="file" class="form-control-file" name="xml">    
        </div>
        <hr>
        <div class="form-group">
            <a class="btn btn-primary btn-sm" href="{{ route('lista.index') }}">Voltar</a>
            <button class="btn btn-success btn-sm" type="submit">Confirmar</button>
        </div>   
    {{-- </form> --}}
   
@endsection
@extends('admin.layouts.app')
@section('content')   
    {{-- @include('admin.includes.alerts') --}}
    <h1>Editando Cadastro: "{{ $aluno->nome }}"</h1>   
    <form action="{{ route('lista.update', [$aluno->id]) }}" method="post" class="form" enctype="multipart/form-data">
        @csrf
        @method('PUT') 
        @include('admin.pages.alunos._partials.form')   
    </form>    
@endsection
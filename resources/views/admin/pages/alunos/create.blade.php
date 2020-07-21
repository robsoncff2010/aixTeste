@extends('admin.layouts.app')
@section('content')
    <h1>Cadastrar novo(a) Aluno(a)</h1>
    @include('admin.includes.alerts')
    <form action="{{ route('lista.store') }}" method="post" enctype="multipart/form-data" class = "form">
        @csrf
        @include('admin.pages.alunos._partials.form')
    </form>
@endsection
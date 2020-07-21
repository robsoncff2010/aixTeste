@extends('admin.layouts.app')
@section('content')
<td >
    @if ($aluno->imagem)
    <img src=" {{ url("storage/$aluno->imagem") }} " class="rounded mx-auto d-block" style="max-width: 300px; max-height: 300px;">                  
    @else
    <svg class="rounded mx-auto d-block" focusable="false"><rect width="400px" height="400px" fill="#868e96"></rect><text x="35%" y="50%" fill="#dee2e6">Sem Imagem</text></svg>            
    @endif
</td>
<hr>
<h1 class="text-center">{{ $aluno->nome }}</h1>   
<table class="table table-striped">
    <tbody>
      <tr>
        <th scope="row">Matricula:</th>
        <td>{{$aluno->id}}</td>
      </tr>
      <tr>
        <th scope="row">Data Matricula:</th>
        <td>{{ date('d-m-Y', strtotime($aluno->dataMatricula)) }}</td>
      </tr>      
      <tr>
        <th scope="row">Curso:</th>
        <td>{{$aluno->curso}}</td>
      </tr>
      <tr>
        <th scope="row">Turma:</th>
        <td>{{$aluno->turma}}</td>
      </tr>
      <tr>
        <th scope="row">Ativo:</th>
        @if ($aluno->situacao == 0)
            <td>Inativo</td>             
        @else
            <td>Ativo</td>             
        @endif        
      </tr>      
      <tr>
        <th scope="row">Endereço:</th>
        @if ($aluno->complemento)
          <td>{{"$aluno->rua, $aluno->numero, $aluno->complemento - $aluno->bairro - $aluno->cidade/$aluno->estado - $aluno->CEP"}}</td>  
        @else
          <td>{{"$aluno->rua, $aluno->numero - $aluno->bairro - $aluno->cidade/$aluno->estado - $aluno->CEP"}}</td>  
        @endif        
      </tr>      
    </tbody>
  </table>  

  <div class="form-group">
    <form action="{{ route('lista.destroy', [$aluno->id]) }}" method="POST" class="form">
      @csrf
      @method('DELETE')        
        <a href="{{ route('lista.index') }}" class="btn btn-success btn-sm">Voltar</a>           
        <a href="{{ route('lista.edit', $aluno->id) }}" class="btn btn-primary btn-sm">Editar</a>
        <button class="btn btn-danger btn-sm" type="submit" >Deletar</button>
    </form>
  </div>  
@endsection
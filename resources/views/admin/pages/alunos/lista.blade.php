@extends('admin/layouts.app')

@section('content')
<h1 class="text-center" Style="margin-bottom: 5px;">Lista de Alunos</h1>  
  <hr>
  <a href="{{ route('lista.create') }}">
    <button type="submit" class="btn btn-success btn-sm" style="float: left;">Cadastrar Aluno(a)</button>
  </a> 
  <form action="{{ route('lista.search') }}" method="POST" class="form form-inline" style="margin-bottom: 1rem; float: right;">  
    @csrf    
    <input type="text" name="filter" placeholder="Pesquisar por Matricula" class="form-control form-control-sm" style="margin-right: 10px;" value="{{ $filters['filter'] ?? '' }}">
    <button type="submit" class="btn btn-info btn-sm">Pesquisar</button>
  </form>
  <table class="table table-striped">
    <thead>
        <tr>
          <th>Matricula:      </th>
          <th>Data Matricula: </th>
          <th>Foto:           </th>
          <th>Nome:           </th>
          <th>Ativo:          </th>
          <th>Detalhes:       </th>          
          <th>Opções:         </th>          
        </tr>
      </thead>
      <tbody>   

          @foreach ($lista as $aluno)
            <tr>
              <td>{{$aluno->id}}</td>
              <td>{{ date('d-m-Y', strtotime($aluno->dataMatricula)) }}</td>
              <td>
                  @if ($aluno->imagem)
                    <img src=" {{ url("storage/$aluno->imagem") }} " class="rounded" alt="" style="max-width: 30px; max-height: 30px;">    
                  @else                      
                  @endif
                </td>
              <td>{{$aluno->nome}}</td>

              @if ($aluno->situacao == 0)
                <td style="color:green">Ativo</td> 
              @else
                <td style="color:red">Inativo</td>                     
              @endif
              <td>
                <a href="{{ route('lista.show', $aluno->id) }}" class="btn btn-info btn-sm">Detalhes</a>                    
              </td>
              <td>                       
                <form action="{{ route('lista.destroy', $aluno->id) }}" class="form" method="POST">
                  @csrf
                  @method('DELETE')
                  <a href="{{ route('lista.edit', $aluno->id) }}" class="btn btn-primary btn-sm">Editar</a>
                  <button type="submit" class="btn btn-danger btn-sm">Excluir</button>                    
                </form>
              </td>                
            </tr>
          @endforeach

      </tbody>
  </table>
  
  @if (isset($filters))
    {!! $lista->appends($filters)->links() !!}  
  @else
    {!! $lista->links() !!}    
  @endif
  
@endsection

@push('styles')

    {{-- <style>
      .ultimo {color: brown;}
    </style> --}}
@endpush

@push('scripts')
    
    {{-- <script>
      document.body.style.background = '#a2e5ff'
    </script> --}}
@endpush

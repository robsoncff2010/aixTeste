@extends('admin/layouts.app')

@section('content')
<h1 class="text-center" Style="margin-bottom: 5px;">Lista de Matérias</h1>  
  <hr>
  <a href="{{ route('materia.create') }}">
    <button type="submit" class="btn btn-success btn-sm" style="float: left;">Cadastrar Matéria</button>
  </a> 
  <form action="{{ route('materia.search') }}" method="POST" class="form form-inline" style="margin-bottom: 1rem; float: right;">  
    @csrf    
    <input type="text" name="filter" placeholder="Pesquisar por Nome" class="form-control form-control-sm" style="margin-right: 10px;" value="{{ $filters['filter'] ?? '' }}">
    <button type="submit" class="btn btn-info btn-sm">Pesquisar</button>
  </form>
  <table class="table table-striped">
    <thead>
        <tr>
          <th>Codigo:          </th>
          <th>Nome da Materia: </th>
          <th>Opções:          </th>                    
        </tr>
      </thead>
      <tbody>   

          @foreach ($lista as $materias)
            <tr>
              <td>{{$materias->idCodigoMateria}}</td>              
              <td>{{$materias->nomeMateria}}</td>                             
              <td>                       
                <form action="{{ route('materia.destroy', $materias->id) }}" class="form" method="POST">
                  @csrf
                  @method('DELETE')
                  <a href="{{ route('materia.edit', $materias->id) }}" class="btn btn-primary btn-sm">Editar</a>
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

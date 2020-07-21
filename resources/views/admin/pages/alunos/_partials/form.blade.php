<hr>
<div class="form-row">
    <div class="col-md-6 mb-3">
        <label for="validationDefault01">Nome</label>
        <input type="text" class="form-control" name="nome" placeholder="Nome Completo" value="{{ $aluno->nome ?? old('nome') }}">
    </div> 
    <div class="col-md-2 mb-3">
        <label for="validationDefault03">Data Matricula</label>
        <input type="date" class="form-control" name="dataMatricula" value="{{ $aluno->dataMatricula ?? old('dataMatricula') }}">
    </div>        
</div>

<div class="form-row">
    <div class="col-md-3 mb-3">
        <label for="validationDefault02">Curso</label>
        <input type="text" class="form-control" name="curso" placeholder="curso" value="{{ $aluno->curso ?? old('curso') }}">
    </div>
    <div class="col-md-3 mb-3">
        <label for="validationDefault03">Turma</label>
        <input type="text" class="form-control" name="turma" placeholder="turma" value="{{ $aluno->turma ?? old('turma') }}">
    </div> 
    <div class="col-md-2 mb-3">
        <label for="validationDefault04">Ativo</label>

        @if (isset($aluno->situacao))

            @if ($aluno->situacao==1)

            <select class="custom-select" id="validationDefault04" name="situacao">                
                <option value="0">Ativo</option>
                <option value="1" selected="selected">Inativo</option>
            </select>
                
            @else

            <select class="custom-select" id="validationDefault04" name="situacao">                
                <option value="0">Ativo</option>
                <option value="1">Inativo</option>
            </select>

            @endif
            
        @else

        <select class="custom-select" id="validationDefault04" name="situacao">                
            <option value="0">Ativo</option>
            <option value="1">Inativo</option>
        </select>
            
        @endif        
    </div>
</div>

<div class="form-row">
    <div class="col-md-3 mb-3">
        <label for="validationDefault05">CEP (Pesquisa feita na troca de campo)</label>
        <input type="text" class="form-control" name="CEP" placeholder="CEP" value="{{ $aluno->CEP ?? old('CEP') }}" onblur="pesquisacep(this.value);" id="cep">
    </div>
    <div class="col-md-3 mb-3">
        <label for="validationDefault06">Rua</label>
        <input type="text" class="form-control" name="rua" placeholder="rua" value="{{ $aluno->rua ?? old('rua') }}" id="rua">
    </div>
    <div class="col-md-2 mb-3">
        <label for="validationDefault07">Número</label>
        <input type="number" class="form-control" name="numero" placeholder="numero" value="{{ $aluno->numero ?? old('numero') }}">
    </div>    
</div>

<div class="form-row">
    <div class="col-md-3 mb-3">
        <label for="validationDefault08">Complemento</label>
        <input type="text" class="form-control" name="complemento" placeholder="complemento" value="{{ $aluno->complemento ?? old('complemento') }}">
    </div>        
    <div class="col-md-3 mb-3">
        <label for="validationDefault09">Bairro</label>
        <input type="text" class="form-control" name="bairro" placeholder="bairro" value="{{ $aluno->bairro ?? old('bairro') }}" id="bairro">
    </div>
    <div class="col-md-3 mb-3">
        <label for="validationDefault10">Cidade</label>
        <input type="text" class="form-control" name="cidade" placeholder="cidade" value="{{ $aluno->cidade ?? old('cidade') }}" id="cidade">
    </div>
    <div class="col-md-1 mb-3">
        <label for="validationDefault11">Estado</label>
        <input type="text" class="form-control" name="estado" placeholder="estado" value="{{ $aluno->estado ?? old('estado') }}" id="uf" maxlength="2">
    </div>
</div>
<hr>
@if (isset($aluno->imagem))
    <div class="form-group">
        <input type="file" class="form-control-file" name="imagem" id="imagem">    
    </div>
    <div class="form-group">    
        <img src="{{ url("storage/$aluno->imagem") }}" class="img-fluid img-thumbnail" alt="Sem Imagem" id="imagemAlt" style="max-width: 150px; max-height: 150px;">
    </div>    
@else
    <div class="form-group">
        <input type="file" class="form-control-file" name="imagem" id="imagem" required>    
    </div>
    <div class="form-group">    
        <img class="img-fluid img-thumbnail" alt="Sem Imagem" id="imagemAlt" style="display: none; max-width: 200px; max-height: 200px;">
    </div>    
@endif
<hr>
<div class="form-group">
    <a class="btn btn-primary btn-sm" href="{{ route('lista.index') }}">Voltar</a>
    <button class="btn btn-success btn-sm" type="submit">Confirmar</button>
</div>   
@push('scripts')  

<script>

// 

function limpa_formulário_cep() {
            //Limpa valores do formulário de cep.
            document.getElementById('rua').value=("");
            document.getElementById('bairro').value=("");
            document.getElementById('cidade').value=("");
            document.getElementById('uf').value=("");            
    }

    function meu_callback(conteudo) {
        if (!("erro" in conteudo)) {
            //Atualiza os campos com os valores.
            document.getElementById('rua').value=(conteudo.logradouro);
            document.getElementById('bairro').value=(conteudo.bairro);
            document.getElementById('cidade').value=(conteudo.localidade);
            document.getElementById('uf').value=(conteudo.uf);            
        } //end if.
        else {
            //CEP não Encontrado.
            limpa_formulário_cep();
            alert("CEP não encontrado.");
        }
    }
        
    function pesquisacep(valor) {

        //Nova variável "cep" somente com dígitos.
        var cep = valor.replace(/\D/g, '');

        //Verifica se campo cep possui valor informado.
        if (cep != "") {

            //Expressão regular para validar o CEP.
            var validacep = /^[0-9]{8}$/;

            //Valida o formato do CEP.
            if(validacep.test(cep)) {

                //Preenche os campos com "..." enquanto consulta webservice.
                document.getElementById('rua').value="...";
                document.getElementById('bairro').value="...";
                document.getElementById('cidade').value="...";
                document.getElementById('uf').value="...";               

                //Cria um elemento javascript.
                var script = document.createElement('script');

                //Sincroniza com o callback.
                script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';

                //Insere script no documento e carrega o conteúdo.
                document.body.appendChild(script);

            } //end if.
            else {
                //cep é inválido.
                limpa_formulário_cep();
                alert("Formato de CEP inválido.");
            }
        } //end if.
        else {
            //cep sem valor, limpa formulário.
            limpa_formulário_cep();
        }
    };

// 

    $(function(){
        $('#imagem').change(function(){
            const file        = $(this)[0].files[0]
            const fileReader  = new FileReader()
            fileReader.onload = function(){
                $('#imagemAlt').attr('src', fileReader.result)
                $('#imagemAlt').css({display:"block"})
                console.log
            } 
            fileReader.readAsDataURL(file)
        })
    })
    $(document).ready(function(){   
        $("#cep").mask('99999-999');
    })	 
</script>            
@endpush


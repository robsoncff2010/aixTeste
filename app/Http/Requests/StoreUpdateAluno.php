<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUpdateAluno extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->segment(2);

        return [
            'nome'=>"required|unique:alunos,nome,{$id},id",
            'dataMatricula'=>'required',
            'curso'=>'required',
            'turma'=>'required',
            'imagem'=>'image|max:2500',
            'CEP'=>'required',
            'cidade'=>'required',
            'estado'=>'required',
            'bairro'=>'required',
            'numero'=>'required',
            'complemento'=>'required',
            'rua'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'nome.required' => 'Campo nome e obrigatório!',
            'dataMatricula.required' => 'Campo data matricula e obrigatório!',            
            'curso.required' => 'Campo curso e obrigatório!',
            'turma.required' => 'Campo turma e obrigatório!',            
            'CEP.required' => 'Campo CEP e obrigatório!',
            'cidade.required' => 'Campo cidade e obrigatório!',
            'estado.required' => 'Campo estado e obrigatório!',
            'bairro.required' => 'Campo bairro e obrigatório!',
            'numero.required' => 'Campo numero e obrigatório!',
            'complemento.required' => 'Campo complemento e obrigatório!',
            'rua.required' => 'Campo rua e obrigatório!',
            'image.max' => 'Imagem não pode ser maior que 2.5mb',
            'imagem.image' => 'So pode adicionar arquivo de imagem',
        ];
    }
}

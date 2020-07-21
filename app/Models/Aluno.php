<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aluno extends Model
{
    protected $fillable = ['id','nome','dataMatricula','curso','turma','situacao','CEP','rua','numero','complemento','bairro','cidade','estado','imagem'];   

    public function search($filter = null)
    {
        $results = $this->where(function ($query) use($filter){
            if($filter){                        
                $query->where('id', $filter);
            }               

        })->paginate();     
        return $results;
    }
}

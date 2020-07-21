<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Materia extends Model
{
    protected $fillable = ['id','idCodigoMateria','nomeMateria'];   

    public function search($filter = null)
    {
        $results = $this->where(function ($query) use($filter){
            if($filter){                        
                $query->where('nomeMateria', 'like', "%$filter%");
            }               

        })->paginate();     
        return $results;
    }
}

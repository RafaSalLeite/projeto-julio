<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    //Permite atribuição em massa nos campos nome, preco, descricao e quantidade
    protected $fillable = ['nome', 'preco', 'descricao', 'quantidade'];

}

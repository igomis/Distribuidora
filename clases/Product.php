<?php
namespace App;

class Product extends EntidadBase
{

    protected $visible = [
            'id' => 'number',
            'name' => 'text',
            'description' => 'text',
            'stock' => 'number',
            'idCategory' => 'number',
            'price' => 'number'
    ];

    protected static $table = "Products";
    protected static $index =  "id";


}


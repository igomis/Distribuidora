<?php
namespace App;

class Category extends EntidadBase
{

    protected $visible = [
            'id' => 'number',
            'name' => 'text',
            'description' => 'text'
    ];

    protected static $table = "Categories";
    protected static $index =  "id";



}


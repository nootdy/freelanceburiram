<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Elasticquent\ElasticquentTrait;
use Illuminate\Support\Facades\Input;

class Item extends Model
{
    use ElasticquentTrait;

    public $fillable = ['title','description'];
    private function buildFieldsParameter($getSourceIfPossible, $getTimestampIfPossible) { return null; }

}

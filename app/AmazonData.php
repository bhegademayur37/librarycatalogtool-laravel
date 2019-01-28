<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AmazonData extends Model
{
 	protected $table = 'amazon_data';
      protected $fillable = [
    'id',
    'title',
    'author',
    'pages',
    'publisher',
    'language',
    'isbn_10',
    'isbn_13',
    'Details',
    'Subjectdb'

  ];

}

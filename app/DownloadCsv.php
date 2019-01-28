<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DownloadCsv extends Model
{
   protected $table = 'download_csv';
      protected $fillable = [
    'id',
    'csv_name',
    'u_id'

  ];
}

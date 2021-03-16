<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\Folder;

class Task extends Model
{
    // use HasFactory;

    const STATUS = [
      1 => [ 'label' => '未着手', 'class' => 'label-danger' ],
      2 => [ 'label' => '着手中', 'class' => 'label-info' ],
      3 => [ 'label' => '完了', 'class' => '' ],
    ];

    public function getStatusLabelAttribute()
    {
      $status = $this->attributes['status'];
      
      if (!isset(self::STATUS[$status])) {
        return '';
      }

      return self::STATUS[$status]['label'];
    }

    public function getformattedDueDateAttribute(){
      return Carbon::createFromFormat('Y-m-d', $this->attributes['due_date'])
        ->format('Y/m/d');
    }

    public function folders()
    {
        return $this->belongsTo('App\Models\Folder');
    }

}

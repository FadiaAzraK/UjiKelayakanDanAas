<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\rombel;
use App\Models\rayon;
use App\Models\late;

class student extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'nis',
        'rombel_id',
        'rayon_id',
    ];

    public function rombel(){
        return $this->belongsTo(rombel::class);
    }

    public function rayon(){
        return $this->belongsTo(rayon::class);
    }

    public function late(){
        return $this->hasMany(late::class);
    }


}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pocet extends Model
{
    use HasFactory;

    protected $table = 'pocet_prijatych';
    public $timestamps = true;

    protected $fillable = [
        'obor',
        'skola',
        'pocet',
        'rok',
    ];

    public function obor() {
        return $this->hasOne('App\Models\Obor', 'id', 'obor');
    }

    public function skola() {
        return $this->hasOne('App\Models\Skola', 'id', 'skola');
    }
}
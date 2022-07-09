<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jam extends Model
{
    use HasFactory;
    protected $table = 'jam';
	protected $guarded = [];
    public function kategori(){
		return $this->hasOne(Kategori::class, 'kategori_id', 'id');
	}
}

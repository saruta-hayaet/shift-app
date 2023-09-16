<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    use HasFactory;

    protected $fillable = ['title']; // 案件の名前や他のカラムをここに追加

    public function shifts()
    {
        return $this->hasMany(Shift::class);
    }
}

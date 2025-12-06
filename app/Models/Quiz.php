<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'date', 'pembahasan'];

    public function questions()
    {
        return $this->hasMany(Question::class);
    }
}

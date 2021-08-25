<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suggest extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'deadline', 'created_by'];

    public function creator() {
        return $this->belongsTo(User::class, ' created_by');
    }
}

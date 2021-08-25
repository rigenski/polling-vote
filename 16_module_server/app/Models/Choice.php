<?php

namespace App\Models;

use App\Models\Poll;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Choice extends Model
{
    use HasFactory;

    protected $fillable = ['choice', 'poll_id'];

    public function polls() {
        return $this->belongsTo(Poll::class);
    }
}

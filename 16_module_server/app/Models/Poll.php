<?php

namespace App\Models;

use App\Models\Choice;
use App\Models\Vote;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poll extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'deadline', 'created_by'];

    public function choices() {
        return $this->hasMany(Choice::class);
    }

    public function votes() {
        return $this->hasMany(Vote::class);
    }

    public function creator() {
        return $this->belongsTo(User::class, ' created_by');
    }
}

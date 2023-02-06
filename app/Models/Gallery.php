<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Symfony\Component\Console\Input\Input;

class Gallery extends Model
{
    use HasFactory;

    protected $casts = [
        'url' => 'array',
        'created_at' => "date:d.m.Y H:i:s",
        'updated_at' => "date:d.m.Y H:i:s"
    ];

    protected $guarded = ['id'];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->timezone('Europe/Belgrade');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->orderBy('id', 'desc')->with('user');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'date', 'slug', 'content', 'img'];

    public function menus()
    {
        return $this->hasMany(Menu::class, 'type_id')->where('type', 'Page');
    }
}

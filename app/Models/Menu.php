<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'display','type', 'type_id', 'status', 'parent_id'];

    public function module()
    {
        return $this->belongsTo(Module::class, 'type_id');
    }

    public function page()
    {
        return $this->belongsTo(Page::class, 'type_id');
    }
    public function parent()
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Menu::class, 'parent_id')->with('children');
    }
}

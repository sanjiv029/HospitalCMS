<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'slug'];

    public function menus()
    {
        return $this->hasMany(Menu::class, 'type_id')->where('type', 'Module');
    }
}

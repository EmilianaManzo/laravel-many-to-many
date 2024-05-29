<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    public function type(){
        return $this->belongsTo(Type::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function tecnologies(){
        return $this->belongsToMany(Tecnology::class);
    }

    protected $fillable = [
        'type_id',
        'user_id',
        'title',
        'slug',
        'href',
        'image',
        'image_original_name',
        'description'
    ];
}

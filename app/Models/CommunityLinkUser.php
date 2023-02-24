<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class CommunityLinkUser extends Model
{
    use HasFactory;

    // nombre de la tabla puesto a mano porque daba error con la base de datos
    protected $table = 'community_link_user';

    protected $fillable = [
        'user_id', 'community_link_id'
    ];

    public function toggle($link)
    {
        // Encuentra el primero registro que pertenece al user y el link o lo crea
        $vote =  CommunityLinkUser::firstOrNew([
            'user_id' => Auth::id(),
            'community_link_id' => $link->id
        ]);
        // Si ya hay un voto con ese id quiere decir que dicho usuario ya ha votado, entonces esto significa que quiere eliminar el voto 
        if ($vote->id) {
            $vote->delete();

        // Si no hay un voto con ese id quiere decir que dicho usuario no ha votado, entonces esto significa que quiere añadir un voto 
        } else {
            $vote->save();
        }
    }
}

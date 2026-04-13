<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EspacementMenu extends Model
{
    //
    protected $fillable = [
        'espacement', 'menu_id','gras', 'italique', 'alignement', 'couleur_fond_icon'
    ];

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'menu_id');
    }
}

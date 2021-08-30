<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\pantallas;

class permisos extends Model
{
    use HasFactory;
    protected $table='permisos';
    public $timestamps=false;
    protected $guarded=[];

    /**
     * Get the user that owns the permisos
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function Pantalla(){
        return $this->belongsTo(pantallas::class,"id_pantalla");
    }
}

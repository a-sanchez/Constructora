<?php

namespace App\Models;

use App\Models\status;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class factura extends Model
{
    use HasFactory;
    protected $table='facturas';
    public $timestamps=true;
    protected $guarded=[];
    protected $appends =["status"];

    public function getStatusAttribute(){
        $status = status::where("id",$this->id_status)->first();
        return $status->status;
    }

    public function contrato()
    {
        return $this->belongsTo(contrato::class,"id_contrato");
    }
}

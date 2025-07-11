<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Appointment extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'phone_number',
        'name',
        'email',
        'meeting_at', // secara defaulth string
        'budget',
        'brief',
        'product_id',
    ];

    protected $casts = [ // casts = mengganti tipe data
        'meeting_at' => 'date', // format method...
    ];

    public function product(){
        return $this->belongsTo(Product::class, 'product_id');
    }
}

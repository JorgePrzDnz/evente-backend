<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;

class PaymentMethod extends Model
{

    use HasFactory;

    protected $fillable = [
        'ownerName',
        'cardNumber',
        'expiryDate',
        'bank',
        'user_id'
    ];



    public function user(){
        return $this->belongsTo('App\Models\User');
    }
}

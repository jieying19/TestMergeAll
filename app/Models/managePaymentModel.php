<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class managePaymentModel extends Model
{
    use HasFactory;

    protected $table = "managePaymentModel";

    protected $fillable = [
        'cardBank',
        'cardNum',
        'cardCVV',
        'cardExpirationDate',
        'cardholderName',
        'cardholderState',
        'cardholderCity',
        'cardholderPostalCode',
        'eWalletbank',
        'eWalletAccNum',
        'parent_id',
        'payment_method',
        'payment_owed',
        'payment_made',
        'payment_status',
        'payment_date',
    ];

}

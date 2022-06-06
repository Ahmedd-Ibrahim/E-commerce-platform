<?php
namespace App\Models;

use App\Http\Traits\HasDefaultValue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PaymentMethod extends Model
{
    use HasFactory, HasDefaultValue;

    protected $fillable = [
        'card_type',
        'last_four',
        'provider_id',
        'default',
        'payment_method_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

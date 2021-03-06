<?php
namespace App\Models;

use App\Http\Traits\HasDefaultValue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Address extends Model
{
    use HasFactory, HasDefaultValue;

    protected $fillable = ['name', 'address_1', 'city', 'postal_code', 'country_id', 'default'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function country()
    {
        return $this->hasOne(Country::class, 'id', 'country_id');
    }
}

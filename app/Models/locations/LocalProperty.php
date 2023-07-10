<?php

namespace App\Models\locations;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocalProperty extends Model
{
    use HasFactory;

    protected $fillable = [
        'img',
        'location_id',
        'society_id',
        'account_id_recv',
        'area',
        'road_size',
        'street_size',
        'owner_name',
        'demand_amount',
        'marala_type',
        'demand_amount',
        'taken_amount',
        'commission_paid',
        'owner_phone_no',
        'sale_amount',
        'recevied_amount',
        'remaining_amount',
        'commission_amount',
        'sold_date',
        'customer_id',
        'agent_id',
        'buyer_id',
        'state_type',
        'property_type',
        'status',
        'description',
        'purc_post_status',
        'sale_post_status',
        'created_at',
        'updated_at',
    ];


    public function Propertylocation()
    {
        return $this->belongsTo(\App\Models\Location::class,'location_id');
    }

    public function PropertySociety()
    {
        return $this->belongsTo(\App\Models\locations\Societies::class,'society_id');
    }

    public function PropertyMaral()
    {
        return $this->belongsTo(\App\Models\locations\Marala::class,'marala_type');
    }

    public function PropertyCustomer()
    {
        return $this->belongsTo(\App\Models\persons\Customers::class,'customer_id');
    }

    public function PropertyAgent()
    {
        return $this->belongsTo(\App\Models\persons\Agent::class,'agent_id');
    }

    public function PropertyPaymentAccount()
    {
        return $this->belongsTo(\App\Models\Accounts\CashAccounts::class,'account_id_recv');
    }

    public function PropertyBuyer()
    {
        return $this->belongsTo(\App\Models\persons\Buyers::class,'buyer_id');
    }
}

<?php

namespace App\Models\locations;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\Persons\Customers;

class Files extends Model
{
    use HasFactory;

    protected $fillable = [
        'registration_no',
        'location_id',
        'society_id',
        'block_id',
        'account_id',
        'account_id_recv',
        'marala_type',
        'purchase_amount',
        'sale_amount',
        'recevied_amount',
        'remaining_amount',
        'commission_amount',
        'purchase_date',
        'sold_date',
        'customer_id',
        'agent_id',
        'state_type',
        'status',
        'purc_post_status',
        'sale_post_status',
        'created_at',
        'updated_at',
    ];


    public function fileslocation()
    {
        return $this->belongsTo(\App\Models\Location::class,'location_id');
    }

    public function filesSociety()
    {
        return $this->belongsTo(\App\Models\locations\Societies::class,'society_id');
    }

    public function filesBlock()
    {
        return $this->belongsTo(\App\Models\locations\Blocks::class,'block_id');
    }

    public function filesMaral()
    {
        return $this->belongsTo(\App\Models\locations\Marala::class,'marala_type');
    }

    public function filesPaymentAccount()
    {
        return $this->belongsTo(\App\Models\Accounts\CashAccounts::class,'account_id');
    }

    public function filesPaymentRecvAccount()
    {
        return $this->belongsTo(\App\Models\Accounts\CashAccounts::class,'account_id_recv');
    }

    public function filesCustomer()
    {
        return $this->belongsTo(\App\Models\persons\Customers::class,'customer_id');
    }
// app/Models/persons
    public function filesAgent()
    {
        return $this->belongsTo(\App\Models\persons\Agent::class,'agent_id');
    }

}

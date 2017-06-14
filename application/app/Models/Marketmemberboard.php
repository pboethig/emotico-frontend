<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Marketmemberboard
 * @package App
 */
class Marketmemberboard extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['market_id','stock_id', 'company_id', 'price'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function stockId()
    {
        return $this->belongsTo(Stock::class,'stock_id');
    }

    public function stocks()
    {
        return $this->hasMany(Stock::class, 'id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function marketId()
    {
        return $this->belongsTo(Market::class,'market_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function markets()
    {
        return $this->marketId();
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function companyId()
    {
        return $this->belongsTo(Company::class,'company_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function companies()
    {
        return $this->hasMany(Company::class, 'id');
    }
}
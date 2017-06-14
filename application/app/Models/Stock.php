<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Stock
 * @package App
 */
class Stock extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name','isin', 'wkn', 'company_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function companyId()
    {
        return $this->belongsTo(Company::class,'company_id');
    }

    public function markets(Marketmemberboard $marketmemberboard)
    {
        return Market::where('id', $marketmemberboard->market_id);
    }
}
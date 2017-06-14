<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Trade
 * @package App
 */
class Trade extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function stockId(){
        return $this->belongsTo(Stock::class,'stock_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function marketId(){
        return $this->belongsTo(Market::class,'market_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function companyId(){
        return $this->belongsTo(Company::class,'company_id');
    }
}

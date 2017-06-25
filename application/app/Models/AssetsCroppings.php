<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

/**
 * Class Stock
 * @package App
 */
class AssetsCroppings extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['id', 'asset_id','user_id','canvasdata','cropping_asset_id','cropping_hash'];

    /**
     * @return mixed
     */
    public function asset()
    {
        return $this->belongsTo(Asset::class,'asset_id','id')->get()->first();
    }

    /**
     * @return mixed
     */
    public function croppedAsset()
    {
        return $this->belongsTo(Asset::class,'cropping_asset_id','id')->get()->first();
    }

    /**
     * @return mixed
     */
    public function getThumbnailUrl()
    {
        return json_decode($this->croppedAsset()->thumbnailList, true)[0];
    }

    /**
     * @return bool
     */
    public function doesExists()
    {
        if(isset(AssetsCroppings::where('cropping_hash', $this->cropping_hash)->get()->first()->id))
        {
            return true;
        }

        return false;
    }

}
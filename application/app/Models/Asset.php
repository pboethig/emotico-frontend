<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Stock
 * @package App
 */
class Asset extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['uuid', 'version','thumbnailList', 'extension'];


    public function croppings()
    {
        return $this->belongsTo(AssetsCroppings::class,'id','asset_id')->get();
    }

    /**
     * @param User $user
     * @return mixed
     */
    public function getUserCroppings(User $user)
    {
        return $this->croppings()
            ->filter(function(AssetsCroppings $cropping) use($user) {
                if($cropping->user_id == $user->id) return $cropping;
            });
    }
}
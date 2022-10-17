<?php

namespace App\Models;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use SoftDeletes;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'products';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['name'];

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];



    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function storeProducts()
    {
        return $this->belongsToMany('App\Models\Store', 'store_products')
            ->withPivot(['price']);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class MainCollection extends Model
{
    const isTrue = 1;
    const isFalse = 0;
    const CREATED_AT = 'CreatedAt';
    const UPDATED_AT = 'UpdatedAt';

    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "m-collection";

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'CollectionId';

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'CollectionId',
        'CollectionName',
        'Description',
        'IsActive',
        'IsDeleted'
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()  
    {
        static::addGlobalScope('globalCollection', function (Builder $builder) {
            $builder->where('IsActive', self::isTrue)->where('IsDeleted', self::isFalse);
        });
    }

    /**
     * Scope a query to only include active data.
     *
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeActive($query)
    {
        return $query->where('IsActive', self::isTrue);
    }

    public function artwork()
    {
        return $this->hasMany(ArtWorkDetail::class, 'CollectionId', 'CollectionId')->select([
            'ArtworkId', 'ArtworkTitle', 'ArtworkUrl', 'CollectionId', 'Description', 'SubCategoryId'
        ]);
    }
}

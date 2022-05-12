<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class ArtWorkDetail extends Model
{
    const isTrue = 1;
    const isFalse = 0;

    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "artworkdetails";

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'ArtworkId';


    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

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
        'ArtworkId',
        'ArtworkTitle',
        'ArtworkUrl',
        'ArtworkSubmittedBy',
        'SubCategoryId',
        'CollectionId',
        'Description',
        'IsDiscard',
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
        static::addGlobalScope('globalArtworkDetail', function (Builder $builder) {
            $builder->where('IsActive', self::isTrue)
                ->where('IsDeleted', self::isFalse)
                ->where('IsDiscard', self::isFalse);
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

    /**
     * Get the short list details for the judge session.
     */
    public function mainSubCategory()
    {
        return $this->belongsTo(MainSubCategory::class, 'SubCategoryId', 'SubCategoryId')->select([
            'SubCategoryName', 'Description', 'CategoryId'
        ]);
    }

    /**
     * Get the collections for the Art work.
     */
    public function MainCollection()
    {
        return $this->belongsTo(MainCollection::class, 'CollectionId', 'CollectionId')->select([
            'CollectionName', 'Description'
        ]);
    }
}

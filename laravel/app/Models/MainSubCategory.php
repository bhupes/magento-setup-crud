<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainSubCategory extends Model
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
    protected $table = "m-subcategory";

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'SubCategoryId';

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
        'SubCategoryId',
        'SubCategoryName',
        'Description',
        'CategoryId',
        'IsDeleted'
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope('globalSubCategory', function (Builder $builder) {
            $builder->where('IsDeleted', self::isFalse);
        });
    }

    /**
     * Get the short list details for the judge session.
     */
    public function mainCategory()
    {
        return $this->belongsTo(MainCategory::class, 'CategoryId', 'CategoryId')->select([
            'CategoryName', 'Description', 'Ranking'
        ]);
    }
}

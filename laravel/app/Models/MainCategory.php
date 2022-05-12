<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MainCategory extends Model
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
    protected $table = "m-category";

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'CategoryId';

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
        'CategoryId',
        'CategoryName',
        'Description',
        'Ranking',
        'IsDeleted'
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope('globalCategory', function (Builder $builder) {
            $builder->where('IsDeleted', self::isFalse);
        });
    }
}

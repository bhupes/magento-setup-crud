<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class MainSortlists extends Model
{
    const isTrue = 1;
    const isFalse = 0;
    const CREATED_AT = 'CraetedAt';
    const UPDATED_AT = 'UpdatedAt';

    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "m-shortlists";

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'Id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ShortlistName',
        'IsActive'
    ];

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope('globalShortList', function (Builder $builder) {
            $builder->where('IsActive', self::isTrue);
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
}

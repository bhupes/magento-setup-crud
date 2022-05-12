<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SortLisedArtwork extends Model
{
    const isTrue = 1;
    const isFalse = 0;

    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = "shortlisedartworks";

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'Id';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'UserId',
        'ArtworkId',
        'SortlistId',
        'Comment'
    ];

    public function artwork()
    {
        return $this->hasMany(ArtWorkDetail::class, 'ArtworkId', 'ArtworkId')->select([
            'ArtworkId', 'ArtworkTitle', 'ArtworkUrl', 'CollectionId', 'Description', 'SubCategoryId'
        ]);
    }
}

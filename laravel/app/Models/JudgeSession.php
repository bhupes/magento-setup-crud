<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JudgeSession extends Model
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
    protected $table = "usersession";

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
        'CollectionId',
        'UserId',
        'ShortlistId',
        'Position'
    ];

    /**
     * Get the collection list for the judge session.
     */
    public function mainCollection()
    {
        return $this->belongsTo(MainCollection::class, 'CollectionId', 'CollectionId')->select([
            'CollectionId', 'CollectionName', 'Description'
        ]);
    }

    /**
     * Get the short list details for the judge session.
     */
    public function mainShortlist()
    {
        return $this->belongsTo(MainShortlists::class, 'ShortlistId', 'Id')->select([
            'Id', 'ShortlistName'
        ]);
    }

    /**
     * Get the user for the judge session.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'UserId', 'id');
    }
}

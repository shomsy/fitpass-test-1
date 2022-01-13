<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SportObjectLog extends Model
{
    use HasFactory;

    protected $fillable = ['card_id', 'gym_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function gym(): BelongsTo
    {
        return $this->belongsTo(Gym::class);
    }
}

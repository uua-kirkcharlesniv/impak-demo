<?php

namespace App\Models;

use App\Events\QuantDataPublished;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class QuestionQuant extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $dispatchesEvents = [
        'saved' => QuantDataPublished::class,
    ];

    public function question(): BelongsTo
    {
        return $this->belongsTo(Question::class);
    }
}

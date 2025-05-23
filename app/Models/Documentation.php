<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Documentation extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_doc';
    protected $fillable = [
        'doc_name',
        'description',
        'file_photos',
        'status',
        'date_submitted',
        'id_project',
        'id_user',
        'created_at',
        'updated_at'
    ];

    // Documentation belongs to project
    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class, 'id_project');
    }

    // Documentation belongs to user
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}

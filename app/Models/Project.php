<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Project extends Model
{
    protected $primaryKey = 'id_project';
    protected $fillable = [
        'project_name',
        'cost',
        'complexity',
        'status',
        'description',
        'file_workorder',
        'start_date',
        'end_date',
        'id_user',
        'id_client'
    ];

    // Project belongs to user
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    // Client belongs to project
    public function client(): BelongsTo
    {
        return $this->belongsTo(Client::class, 'id_client');
    }

    // Project has many materials
    public function materials(): BelongsTo
    {
        return $this->belongsTo(Material::class, 'project_materials', 'id_project','id_material')->withPivot('quantity');
    }

    // Project has many documentations
    public function docoumentations(): HasMany
    {
        return $this->hasMany(Documentation::class, 'id_project');
    }


    
}

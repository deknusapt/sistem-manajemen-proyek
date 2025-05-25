<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_material'; // Primary key yang digunakan
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'material_name',
        'brandname',
        'serial_number',
        'quantity',
        'availability'
    ];

    // Material belongs to many projects
    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class, 'project_materials', 'id_material', 'id_project')->withPivot('quantity');
    }
}

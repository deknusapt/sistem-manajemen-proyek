<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Client extends Model
{
    //
    use HasFactory;

    protected $primaryKey = 'id_client';
    public $incrementing = true;
    protected $keyType = 'int';
    
    protected $fillable = [
        'client_fullname',
        'company',
        'position',
        'address',
        'phone_number',
        'email'
    ];

    // Client has many projects
    public function projects(): HasMany
    {
        return $this->hasMany(Project::class, 'id_client');
    }
}

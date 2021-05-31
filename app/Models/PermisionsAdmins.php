<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermisionsAdmins extends Model
{
    use HasFactory;
    protected $fillable = [
      'actived_by_id',
      'permision_id',
      'admin_id',
    ];
    
    public function adminsactived()
    {
        return $this->belongsTo(Admins::class, 'actived_by_id');
    }
    public function admins()
    {
        return $this->belongsTo(Admins::class, 'admin_id');
    }

    public function permisions()
    {
        return $this->belongsTo(Permisions::class, 'permision_id');
    }
}

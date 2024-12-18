<?php
namespace appdigidelete\AccountDeletion\Models;

use Illuminate\Database\Eloquent\Model;

class DeletedUser extends Model
{
    protected $table = 'deleted_users'; 

    protected $fillable = ['email', 'name', 'deleted_data']; 

    protected $casts = [
        'deleted_data' => 'array', 
    ];
}

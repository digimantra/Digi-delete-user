<?php

namespace AppDigiDelete\AccountDeletion\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Otp extends Model
{
    use HasFactory;

    protected $fillable = [
        'email',
        'otp',
        'created_at',
        'validated_at',
    ]; 
}

<?php

namespace Notification\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    use HasFactory;
    protected $fillable = ['to_user_id', 'from_user_id', 'notifiable_id', 'notifiable_type', 'action', 'seen'];
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GameAccount extends Model
{
    protected $table = 'game_account';

    protected $fillable = ['user_id','game_hard','account'];
}

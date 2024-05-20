<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    protected $fillable = [
        'name',
        'username',
        'date_of_birth',
        'address',
        'religion',
        'institution',
        'phone_number',
        'field_of_expertise', // Ubah 'field_of_experience' menjadi 'field_of_expertise'
    ];
}
?>
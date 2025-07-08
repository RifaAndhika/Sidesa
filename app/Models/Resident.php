<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Resident extends Model
{
    protected $table = 'residents';

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function complaints()
    {
        return $this->hasMany(Complaint::class);
    }

        public function getGenderLabelAttribute()
    {
        return [
            'male' => 'Laki-laki',
            'female' => 'Perempuan',
        ][$this->gender] ?? '-';
    }

    public function getMaritalStatusLabelAttribute()
    {
        return [
            'single' => 'Kawin',
            'married' => 'Belum Kawin',
            'divorced' => 'Cerai',
            'widowed' => 'Duda/Janda',
        ][$this->marital_status] ?? '-';
    }

}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class GiaoVien extends Model
{
    protected $guarded = [];

    public function khoa()
    {
        return $this->belongsTo(Khoa::class, 'makhoa');
    }
}

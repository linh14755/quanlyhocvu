<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lop extends Model
{
    protected $guarded = [];

    public function giaovien()
    {
        return $this->belongsTo(GiaoVien::class, 'magvcn');
    }
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LopHocPhan extends Model
{
    protected $guarded = [];

    public function hocphan()
    {
        return $this->belongsToMany(HocPhan::class, 'chi_tiet_lop_hoc_phans', 'malhp', 'mahp')->withTimestamps();
    }
}

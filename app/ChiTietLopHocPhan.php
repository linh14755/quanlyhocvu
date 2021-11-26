<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChiTietLopHocPhan extends Model
{
    protected $guarded = [];

    public function sinhvien()
    {
        return $this->hasOne(SinhVien::class, 'masv', 'masv');
    }
    public function hocphan()
    {
        return $this->hasOne(HocPhan::class, 'mahp', 'mahp');
    }
}

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

    public function khoa()
    {
        return $this->belongsTo(Khoa::class, 'makhoa');
    }

    public function sinhvien()
    {
        return $this->belongsToMany(SinhVien::class, 'sinhvien_lops', 'malop', 'masv', 'malop', 'masv')->withTimestamps();
    }
}

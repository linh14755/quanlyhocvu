<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SinhVien extends Model
{
    protected $guarded = [];

    public function phuhuynh1()
    {
        return $this->belongsTo(PhuHuynh::class, 'maph1');
    }

    public function phuhuynh2()
    {
        return $this->belongsTo(PhuHuynh::class, 'maph2');
    }

    public function lop()
    {
        return $this->belongsTo(Lop::class, 'malop','malop');
    }
}

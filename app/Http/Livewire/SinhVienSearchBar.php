<?php

namespace App\Http\Livewire;

use App\SinhVien;
use Livewire\Component;

class SinhVienSearchBar extends Component
{

    public $searchTerm;

    public function render()
    {
        return view('livewire.sinh-vien-search-bar',
            [
                'sinhviens' => SinhVien::where(function ($sub_query) {
                    $sub_query->where('masv', 'like', '%' . $this->searchTerm . '%')
                        ->orWhere('tensv', 'like', '%' . $this->searchTerm . '%');
                })->latest()->paginate(10)
            ]);
    }

    public function resetTerm()
    {
        $this->searchTerm = '';
    }
}

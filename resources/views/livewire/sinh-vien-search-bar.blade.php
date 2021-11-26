<div class="input-group input-group-sm position-relative">
    <input
        wire:model="searchTerm"
        type="search"
        name="table_search"
        class="form-control float-right"
        placeholder="Tìm kiếm theo MSSV và tên"
        wire:keydown.escape="resetTerm"
        wire:keydown.tab="resetTerm"
    >
    @if(!empty($searchTerm))

        <ul class="position-absolute list-group" style="top: 30px;width: 100%">
            <div>
                @foreach($sinhviens as $sinhvien)
                    <li class="list-group-item">
                        <a class="text-black"
                           href="{{route('sinhvien.edit',['id'=>$sinhvien['masv']])}}">{{$sinhvien['masv'].' - '.$sinhvien['tensv']}}
                            <i class="fas fa-edit text-warning mr-2" aria-hidden="true"></i></a>

                        <a href="{{route('chitietlophocphan.theosinhvien',['masv'=>$sinhvien['masv']])}}">Kết quả đăng ký HP <i
                                class="fa fa-link text-danger" aria-hidden="true"></i></a>

                    </li>
                @endforeach
            </div>
        </ul>
    @endif

</div>



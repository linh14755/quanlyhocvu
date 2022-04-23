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
                          </a>
-
                        <a href="{{route('chitietlophocphan.theosinhvien',['masv'=>$sinhvien['masv']])}}"><img style="width: 22px" src="{{url('/storage/diem/detail.png')}}"></a>

                    </li>
                @endforeach
            </div>
        </ul>
    @endif

</div>



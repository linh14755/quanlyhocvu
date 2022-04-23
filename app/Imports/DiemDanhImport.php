<?php

namespace App\Imports;

use App\DiemDanh;
use App\ThoiKhoaBieu;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Imports\HeadingRowFormatter;

HeadingRowFormatter::default('none');

class DiemDanhImport implements ToModel, SkipsEmptyRows, WithHeadingRow
{
    protected $fileName;

    public function fromFile(string $fileName)
    {
        $this->fileName = $fileName;
        return $this;
    }

    public function model(array $row)
    {
        //mssv
        //do_dem
        //ten
        //diem_danh
        //lop
        //ngay
        //mon
        //tiet
        //so sánh ngày và tên môn để check điểm danh
        $arr_name = explode('_', $this->fileName);
        $arr_name = explode('-', $arr_name[0]);
        $lop = $arr_name[1];
        $tenhp_rutgon_excel = $arr_name[0];
        foreach ($row as $key => $value) {
            //$key => dia chi thu dien tu
            //$lop => lớp CTK...
            //$key => ngay
            if (strpos($key, 'Tất cả sinh viên')) {
                //16 Thg 8 2021 1.05PM Tất cả sinh viên
                //Cắt ngày tháng bằng chữ m
                //16_thg_8_2021_105p
                $ar_ngay = explode('M', $key);
                $arr_ngay = explode(' ', $ar_ngay[0]);
                $arr_gio = explode('.', $arr_ngay[4]);
                $gio = $arr_gio[0];
                $phut = substr($arr_gio[1], 0, 2);
                $a = strtoupper(substr($arr_gio[1], -1));

                $ngay = date("Y-m-d", strtotime("$arr_ngay[3]/$arr_ngay[2]/$arr_ngay[0] $gio:$phut $a" . "M"));
                $gio = date("G", strtotime("$arr_ngay[3]/$arr_ngay[2]/$arr_ngay[0] $gio:$phut $a" . "M"));
                //tiết sẽ từ 1->  7->  11-> 3 mốc sáng chiều tối
                $tiet = '';

                if ((7 <= $gio) && ($gio <= 12)) {
                    $tiet = "1->";
                } elseif ((13 <= $gio) && ($gio <= 16)) {
                    $tiet = "7->";
                } elseif ((17 <= $gio)) {
                    $tiet = "11->";
                }

                $result = ThoiKhoaBieu::where([
                    ['lop', 'like', '%' . $lop . '%'],
                    ['tiet', 'like', '%' . $tiet . '%'],
                    ['ngay', $ngay],
                ])->first();
                if (!empty($result)) {
                    $tenhp = $this->string_between_two_string($result->tenhp, ':', '(');
                    $tenhp = $this->vn_str_filter($tenhp);
                    $tenhp = explode(' ', $tenhp);
                    $tenhp_rutgon_database = '';
                    foreach ($tenhp as $item) {
                        if (!empty($item)) {
                            $tenhp_rutgon_database .= substr($item, 0, 1);
                        }
                    }
                    $tenhp_rutgon_database = strtoupper($tenhp_rutgon_database);
                    if ($tenhp_rutgon_excel == $tenhp_rutgon_database) {
                        $mssv = explode('@', $row['Địa chỉ thư điện tử'])[0];
                        $arr = [
                            'mssv' => $mssv,
                            'malhp' => $result->malhp,
                            'ngay' => $ngay,
                            'trangthai' => $value,
                            'tiet' => explode(':', $result->tiet)[1],
                        ];
                        DiemDanh::create($arr);
                    }
                }


            }
        }


        return null;
    }

    function string_between_two_string($str, $starting_word, $ending_word)
    {
        $subtring_start = strpos($str, $starting_word);
        //Adding the starting index of the starting word to
        //its length would give its ending index
        $subtring_start += strlen($starting_word);
        //Length of our required sub string
        $size = strpos($str, $ending_word, $subtring_start) - $subtring_start;
        // Return the substring from the index substring_start of length size
        return substr($str, $subtring_start, $size);
    }

    function vn_str_filter($str)
    {
        $unicode = array(
            'a' => 'á|à|ả|ã|ạ|ă|ắ|ặ|ằ|ẳ|ẵ|â|ấ|ầ|ẩ|ẫ|ậ',
            'd' => 'đ',
            'e' => 'é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ',
            'i' => 'í|ì|ỉ|ĩ|ị',
            'o' => 'ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ',
            'u' => 'ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự',
            'y' => 'ý|ỳ|ỷ|ỹ|ỵ',
            'A' => 'Á|À|Ả|Ã|Ạ|Ă|Ắ|Ặ|Ằ|Ẳ|Ẵ|Â|Ấ|Ầ|Ẩ|Ẫ|Ậ',
            'D' => 'Đ',
            'E' => 'É|È|Ẻ|Ẽ|Ẹ|Ê|Ế|Ề|Ể|Ễ|Ệ',
            'I' => 'Í|Ì|Ỉ|Ĩ|Ị',
            'O' => 'Ó|Ò|Ỏ|Õ|Ọ|Ô|Ố|Ồ|Ổ|Ỗ|Ộ|Ơ|Ớ|Ờ|Ở|Ỡ|Ợ',
            'U' => 'Ú|Ù|Ủ|Ũ|Ụ|Ư|Ứ|Ừ|Ử|Ữ|Ự',
            'Y' => 'Ý|Ỳ|Ỷ|Ỹ|Ỵ',
        );

        foreach ($unicode as $nonUnicode => $uni) {
            $str = preg_replace("/($uni)/i", $nonUnicode, $str);
        }
        return $str;
    }

    public function headingRow(): int
    {
        return 4;
    }
}

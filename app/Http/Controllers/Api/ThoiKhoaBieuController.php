<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Sunra\PhpSimple\HtmlDomParser;

include(app_path() . '/Traits/simple_html_dom.php');


class ThoiKhoaBieuController extends Controller
{
    public function index()
    {
        //link mau
        //http://qlgd.dlu.edu.vn/public/DrawingClassStudentSchedules_Mau2?YearStudy=2021-2022&TermID=HK02&Week=11&ClassStudentID=CTK42-PM&t=0.24912816254772174


        $year_study = "2021-2022";
        $term_id = "HK02";
        $week = "11"; //tuần 10 thì giá trị là 11
        $class_student_id = "CTK42-PM";
        //random tu 0 den 1
        $t = mt_rand(0, 10) / 10;
        $url = "http://qlgd.dlu.edu.vn/public/DrawingClassStudentSchedules_Mau2?YearStudy=$year_study&TermID=$term_id&Week=$week&ClassStudentID=$class_student_id&t=$t";

        $resp = [];
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        $data = curl_exec($ch);
        curl_close($ch);

        //lay duoc html
        $data = preg_replace("/\r|\n/", "", $data);

        //Cài đặt thư viện simple html dom để thay thế biểu thức chính quy
        // tạo mảng thời khóa biểu từ chuỗi html lấy được ở trên
        //include(app_path().'/Traits/simple_html_dom.php');

        $html = str_get_html($data);

        $result = array();
        $children = array();
        foreach ($html->find('td') as $element) {
            $chill = array();
            $arr = explode("\r\n", $element->plaintext);
            foreach ($arr as $item) {
                array_push($chill, $item);
            }
            array_push($children, $chill);
            if (count($children) == 3) {
                $result["thu ".(count($result) + 2)] = $children;
                $children = array();
            }
        }

        return response()->json($result, 200);
    }
}

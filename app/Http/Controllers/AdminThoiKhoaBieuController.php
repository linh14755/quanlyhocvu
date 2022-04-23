<?php

namespace App\Http\Controllers;

use App\ThoiKhoaBieu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use function PHPUnit\Framework\isNull;

include(app_path() . '/Traits/simple_html_dom.php');

class AdminThoiKhoaBieuController extends Controller
{
    private $thoikhoabieu;

    public function __construct(ThoiKhoaBieu $thoikhoabieu)
    {
        $this->thoikhoabieu = $thoikhoabieu;
    }

    public function index()
    {



        return view('admin.thoikhoabieu.index');
    }

    function getDatesFromRange($start, $end, $format = 'Y-m-d')
    {

        // Declare an empty array
        $array = array();

        // Variable that store the date interval
        // of period 1 day
        $interval = new \DateInterval('P1D');

        $realEnd = new \DateTime($end);
        $realEnd->add($interval);

        $period = new \DatePeriod(new \DateTime($start), $interval, $realEnd);

        // Use loop to store date into array
        foreach ($period as $date) {
            $array[] = $date->format($format);
        }

        // Return the array elements
        return $array;
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


    public function importForm()
    {
        //Lay thong tin tu server cua truong
        $url = "http://qlgd.dlu.edu.vn";
        $year_study = array();
        $term_id = array();
        $week = array(); //tuần 10 thì giá trị là 11
        $class_student_id = array();
        //random tu 0 den 1
        $t = mt_rand(0, 10) / 10;

        $html = file_get_contents($url);

        //lay duoc html
        $data = preg_replace("/\r|\n/", "", $html);
        $html = str_get_html($data);
        //Tao mang year study
        $element = $html->find('#YearStudy', 0)->find('option');
        foreach ($element as $elemen) {
            $year_study[$elemen->value] = $elemen->plaintext;
        }
        //Tao mang term id
        $element = $html->find('#TermID', 0)->find('option');
        foreach ($element as $elemen) {
            $term_id[$elemen->value] = $elemen->plaintext;
        }
        //Tao mang ClassStudentID
        $element = $html->find('#ClassStudentID', 0)->find('option');
        foreach ($element as $elemen) {
            $class_student_id[$elemen->value] = $elemen->plaintext;
        }

        return view('admin.thoikhoabieu.import', compact('year_study', 'term_id', 'class_student_id'));
    }

    public function import(Request $request)
    {
        try {
            DB::beginTransaction();

            $year_study = $request->YearStudy;
            $term_id = $request->TermID;
            $class_student_id = $request->ClassStudentID;
            $t = mt_rand(0, 10) / 10;
            $weeks = explode(",", $request->Week);


            foreach ($weeks as $week) {
                $url = "http://qlgd.dlu.edu.vn/Public/DrawingClassStudentSchedules_Mau2?YearStudy=$year_study&TermID=$term_id&Week=$week&ClassStudentID=$class_student_id&t=$t";
                $html = file_get_contents($url);

                //lay duoc html
                $data = preg_replace("/\r|\n/", "", $html);
                $html = str_get_html($data);
                //Lay chuoi tu ngay den ngay
                $ngay_thang = array();
                foreach ($html->find('span') as $element) {
                    array_push($ngay_thang, $element->plaintext);
                }
                if (!empty($ngay_thang)) {
                    //return redirect()->back()->with('message', 'Không lấy được html, xem lại bạn đã đăng nhập http://qlgd.dlu.edu.vn/Login/Index chưa !!');
                    //tach ngay dau ngay cuoi

                    $arr = explode(" ", $ngay_thang[0]);
                    $day_from = date("Y-m-d", strtotime(str_replace('/', '-', $arr[4])));
                    $day_to = date("Y-m-d", strtotime(str_replace('/', '-', $arr[7])));

                    //danh sách ngày trong tuần
                    $array_day = $this->getDatesFromRange($day_from, $day_to);


                    $array_tkb = array();
                    $children = array();
                    foreach ($html->find('td') as $element) {
                        $chill = array();
                        $arr = explode("\r\n", $element->plaintext);
                        foreach ($arr as $item) {
                            array_push($chill, $item);
                        }
                        array_push($children, $chill);
                        if (count($children) == 3) {
                            $array_tkb["Thứ " . (count($array_tkb) + 2)] = $children;
                            $children = array();
                        }
                    }

                    $array = array();
                    $i = 0;
                    foreach ($array_tkb as $thu => $tkb) {
                        if ($i == 7) {
                            $i = 0;
                        } else {
                            $array[] = [
                                'ngay' => $array_day[$i],
                                'chitiet' => $tkb
                            ];
                            $i++;
                        }
                    }

                    foreach ($array as $item) {
                        $ngay = $item["ngay"];
                        $chitiet = $item["chitiet"];
                        foreach ($chitiet as $buoi_hoc) {
                            if (!empty($buoi_hoc[0])) {
                                $mahp = $this->string_between_two_string($buoi_hoc[0], "(", ")");
                                $nam = substr($year_study, 2, 2);
                                $hocky = substr($term_id, -1);
                                $nhom = explode(" ", $buoi_hoc[1])[1];
                                $malhp = $nam . $hocky . $mahp . $nhom;

                                $this->thoikhoabieu->create(
                                    [
                                        'malhp' => $malhp,
                                        'mahp' => $mahp,
                                        'tenhp' => $buoi_hoc[0],
                                        'nhom' => $buoi_hoc[1],
                                        'lop' => $buoi_hoc[2],
                                        'tiet' => $buoi_hoc[3],
                                        'phong' => $buoi_hoc[4],
                                        'giaovien' => $buoi_hoc[5],
                                        'dahoc' => $buoi_hoc[6],
                                        'ngay' => $ngay
                                    ]
                                );
                            }
                        }
                    }
                }


            }

            DB::commit();
            return redirect()->back()->with('message', 'Import successfully !!');
        } catch (\Exception $exception) {
            Log::error('Message' . $exception->getMessage() . ' ------Line ' . $exception->getLine());
            DB::rollBack();

        }
    }

    public function getWeek()
    {
        $term_id = $_GET['TermID'];
        $year_study = $_GET['YearStudy'];
        $respone = Http::get('http://qlgd.dlu.edu.vn/Public/GetWeek/' . $year_study . '$' . $term_id);
        $data = array();
        foreach ($respone->json() as $item) {
            array_push($data, $item['Week']);
        }
        //chuyen thanh chuoi
        $data = collect($data)->implode(',');
        return response()->json([
            'code' => 200,
            'data' => $data
        ]);
    }
}

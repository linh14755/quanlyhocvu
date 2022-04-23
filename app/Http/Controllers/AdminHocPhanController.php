<?php

namespace App\Http\Controllers;

use App\ChiTietLopHocPhan;
use App\HocPhan;
use App\Imports\BangDiemImport;
use App\Imports\ChiTietLopHocPhanImport;
use App\Khoa;
use App\Lop;
use App\LopHocPhan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;

include(app_path() . '/Traits/simple_html_dom.php');

class AdminHocPhanController extends Controller
{
    private $hocphan;
    private $chitietlhp;

    public function __construct(HocPhan $hocphan, ChiTietLopHocPhan $chchitietlhp)
    {
        $this->hocphan = $hocphan;
        $this->chitietlhp = $chchitietlhp;
    }

    public function index()
    {
        $hocphans = $this->hocphan->latest()->paginate(35);
        return view('admin.hocphan.index', compact('hocphans'));
    }

    public function theohocphan($mahp)
    {
        $chitietlhps = $this->chitietlhp->where('mahp', $mahp)->get();
        $tenhp = optional($chitietlhps[0]->hocphan)->tenhp;
        return view('admin.chitietlophocphan.index', compact('chitietlhps', 'tenhp'));
    }

    public function bangDiemImportForm()
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
        $khoas = Khoa::all();

        return view('admin.lophocphan.bangdiem.import-form', compact('khoas', 'year_study', 'term_id', 'class_student_id'));
    }

    public function bangDiemImport(Request $request)
    {
        $year_study = $request->YearStudy;
        $termId = $request->TermID;
        $lop = $request->ClassStudentID;
        $khoa_id = $request->khoa;
        $subject = $request->subject;

        try {
            DB::beginTransaction();

            $import = (new BangDiemImport())
                ->fromFile($request->file->getClientOriginalName(), $year_study, $termId, $khoa_id, $lop, $subject);
            Excel::import($import, $request->file);
            DB::commit();

            return redirect()->back()->with('message', 'Import Successfully !!');
        } catch (\Exception $exception) {
            Log::error('Message: ' . $exception->getMessage() . ' ------Line ' . $exception->getLine());
            DB::rollBack();
            return redirect()->back()->with('message', 'Message: ' . $exception->getMessage());
        }
    }

    public function getLopVaHocPhanFromKhoa()
    {
        $class_student_id = $_GET['ClassStudentID'];
        $year_study = $_GET['YearStudy'];
        $term_id = substr($_GET['TermID'], 3, 1);
        $html_lophocphan = '';
        $html_lop = '';

        if ($khoa = Khoa::find($class_student_id)) {

            if ($lophocphans = LopHocPhan::where('malhp', 'like', '%' . $khoa->makhoa . '%')->where('namhoc', $year_study)->where('hocky', $term_id)->get()) {
                foreach ($lophocphans as $lophocphan) {
                    if ($hocphan = DB::select("select hp.mahp, hp.tenhp from hoc_phans hp, chi_tiet_lop_hoc_phans ctlhp where ctlhp.malhp='" . $lophocphan->malhp . "' and hp.mahp = ctlhp.mahp limit 1")) {
                        $html_lophocphan .= "<option value='" . $lophocphan->malhp . "'>" . $hocphan[0]->tenhp . " - " . $hocphan[0]->mahp . "</option>";
                    }

                }
            }
        }


        if ($lops = Lop::where('makhoa', $class_student_id)->get()) {
            foreach ($lops as $lop) {
                $html_lop .= "<option value='" . $lop->malop . "'>" . $lop->malop . "</option>";
            }
        }

        return response()->json([
            'code' => 200,
            'htmllop' => $html_lop,
            'htmllophocphan' => $html_lophocphan]);
    }
}

<?php

namespace App\Http\Controllers\UM;

use App\Http\Controllers\Controller;
use App\Models\ListProjectAdmin;
use App\Models\ListProjet;
use App\Models\NomerKodeProjectOrderOpties;
use App\Models\ProgressStatus;
use App\Models\SalesOpty;
use App\Models\SalesOrder;
use App\Models\UserHasSalesOpties;
use App\Models\WeeklyReport;
use App\Models\Weekly;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class ReportpController extends Controller
{

    // !Report controller Technikal
    public function index(Request $request)
    {
        if ($request->dari_tgl || $request->sampai_tgl) {
            $dari_tgl = Carbon::parse($request->dari_tgl)->toDateTimeString();
            $sampai_tgl = Carbon::parse($request->sampai_tgl)->toDateTimeString();
            $dataM = Weekly::with('timelines.lists')->whereBetween('created_at', [$dari_tgl,$sampai_tgl])->where('status', 'like', "%" . $request->status . "%")->where('name_technikal', 'like', "%" . $request->name_technikal . "%")->get();
        } else {
            $dataM = Weekly::with('timelines.lists')->get();
        }
        // $projk = WeeklyReport::all();
        $Tech = Role::with('users')->where("name", "Technikal")->get();

        // return $datas;
        return view('UM.reportp', compact('dataM','Tech'));
    }

    public function showTechnikal($id) {
        $datas = ListProjet::all()->count();
        $data = ListProjet::all();
        $user = Role::with('users')->where('name', 'Technikal')->get();
        $time =  ListProjet::with('detail.weeklies')->where('id', $id)->first();
        $t = Weekly::all();

        return view('UM.showTechnikal', compact('time', 'user','t', 'data', 'datas',));
    }

    //! Akhir !Report controller Technikal

    // ! CONTROLLER REPORT SALES PIPLANE
    public function indexPiplane(Request $request)
    {
        // $datas = Weekly::with('reportd.listp')->orderBy('created_at', 'ASC')->paginate();

        if ($request->dari_tgl || $request->sampai_tgl) {
            $dari_tgl = Carbon::parse($request->dari_tgl)->toDateTimeString();
            $sampai_tgl = Carbon::parse($request->sampai_tgl)->toDateTimeString();
            $sales = SalesOpty::whereBetween('Date', [$dari_tgl,$sampai_tgl])->where('Status', 'like', "%" . $request->Status . "%")->where('name_user', 'like', "%" . $request->sales . "%")->get();
        } else {
            $sales = SalesOpty::all();
        }

        $user = Role::with('users')->where("name", "AM/Sales")->get();

        $prostat = ProgressStatus::all();
        $detailss = UserHasSalesOpties::with("userTechnikal","projectSalesOpties", "userPM")->get();
        $jumlah = count($detailss); 

        return view('UM.indexPiplane', compact('sales', 'detailss', 'jumlah', 'prostat', 'user'));
    }

    public function showPiplane($id)
    {
        // $datas = Weekly::with('reportd.listp')->orderBy('created_at', 'ASC')->paginate();
        // buat kode project
        // AD202281001
        $now =  Carbon::now();
        $thBulan = $now->year . $now->month;
        $tabelListProjectAdmin = NomerKodeProjectOrderOpties::count();
        if ($tabelListProjectAdmin == 0) {
            $urut = 1001;
            $nomer = 'AD'. $thBulan. $urut;            
        }  else {
            $ambilLast = NomerKodeProjectOrderOpties::all()->last();
            $urut = (int)substr($ambilLast->arr2, -4) + 1;
            $nomer = 'AD'. $thBulan. $urut;            
        }

        $pmLead = Role::with('users')->where("name", "PM")->get();
        $technikalLead = Role::with('users')->where("name", "Technikal")->get();

        $detail = SalesOpty::with('elearnings', 'pmLead', 'technikelLead')->find($id);
        $detailss = UserHasSalesOpties::with("userTechnikal","projectSalesOpties", "userPM")->Where("sales_opties_id", $id)->get();
        $jumlah = count($detailss);   

        return view('UM.showPiplane', compact('detailss', "jumlah", 'detail', 'pmLead', 'technikalLead', 'nomer'));
    }
    // ! AKHIR CONTROLLER REPORT SALES PIPLANE


    //! Report controller ADMIN
    private $mediaCollection = 'UploadDocument';

    public function indexAdmin(Request $request)
    { 
        $datas = Weekly::with('reportd.listp')->orderBy('created_at', 'ASC')->paginate();
        // $admin = ListProjectAdmin::with("Pm")->get();
        if ($request->dari_tgl || $request->sampai_tgl || $request->Status) {
            // dd("ok");
            $dari_tgl = Carbon::parse($request->dari_tgl)->toDateTimeString();
            $sampai_tgl = Carbon::parse($request->sampai_tgl)->toDateTimeString();
            $admin = ListProjectAdmin::with('userTechnikals.userTechnikal','userTechnikals.AM','Pm')->whereBetween('Date', [$dari_tgl,$sampai_tgl])->where('Status', 'like', "%" . $request->Status . "%")->paginate(7);
        } else {
            $admin = ListProjectAdmin::with('userTechnikals.userTechnikal','userTechnikals.AM', "Pm")->paginate(7);
        }
        $prostat = ProgressStatus::all();

        // dd($prostat);
        // $detailss = UserHasListProjectAdmin::with("projectSalesOrder","userTechnikal","userPM","AM")->get();
        // $jumlah = count($detailss); 
        
        // $admin = ListProjectAdmin::all();
        return view('UM.indexAdmin', [
            'admin' => $admin,
            'prostat' => $prostat,
            // "detailss" => $detailss,
            // "jumlah" => $jumlah,
            'datas' => $datas,
            'mediaCollection' => $this->mediaCollection
        ]);
    }

    public function showAdmin($id)
    {
        $datas = Weekly::with('reportd.listp')->orderBy('created_at', 'ASC')->paginate();
        $angka = ListProjectAdmin::all()->count();
        $detailId = ListProjectAdmin::with('userTechnikals.userTechnikal', 'userTechnikals.AM')->find($id);

        return view('UM.showAdmin', compact('detailId', 'angka' , 'datas'));
    }
    //! Akhir Reeport  controller ADMIN


    //! Report Reeport controller PM
    public function indexPm(Request $request)
    {
        $datas = Weekly::with('reportd.listp')->orderBy('created_at', 'ASC')->paginate();
        $rp = ListProjet::all();
        return view('UM.indexPm',compact('rp', 'datas'));
    
    }

    public function showPm($id)
    {
        $datas = Weekly::with('reportd.listp')->orderBy('created_at', 'ASC')->paginate();
        $rpt = ListProjet::with('detail')->where('id', $id)->first();
        return view('UM.showPm', compact('rpt','datas'));
    }
    //! Akhir Repport controller PM 
}

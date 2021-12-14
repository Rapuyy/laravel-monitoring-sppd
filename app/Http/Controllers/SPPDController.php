<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SPPD;
use App\Models\IPA;
use App\Models\PP;
use Illuminate\Support\Facades\DB;
use Session;
use Illuminate\Support\Carbon;
use DataTables;
use Auth;
use phpDocumentor\Reflection\Types\Null_;

class SppdController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function validateStatus($sppd, $ipa, $pp) //dipake store sama update
    {
        //nanti kayanya mesti null nullan disini deh
        if ($sppd->sppd_no) { //ipa
            $sppd->status = 0;
            if ($ipa->ipa_tgl_dibuat && $sppd->ipa_no) {
                $sppd->status = 1;
                if ($ipa->ipa_tgl_diajukan) {
                    $sppd->status = 2;
                    if ($ipa->ipa_tgl_approval) {
                        $sppd->status = 3;
                        if ($ipa->ipa_tgl_msk_finance) {
                            $sppd->status = 4;
                            if ($ipa->ipa_tgl_selesai) {
                                $sppd->status = 10;
                                if ($sppd->pp_no && $pp->pp_tgl_dibuat) {
                                    $sppd->status = 11; //pp
                                    if ($pp->pp_tgl_diajukan) {
                                        $sppd->status = 12;
                                        if ($pp->pp_tgl_approval) {
                                            $sppd->status = 13;
                                            if ($pp->pp_tgl_msk_finance) {
                                                $sppd->status = 14;
                                                if ($pp->pp_tgl_selesai) {
                                                    $sppd->status = 15;
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        return $sppd->status;
    }

    public function updateStatus(Request $request)
    {
        $sppd = Sppd::find($request->id);

        if ($sppd->status == $request->status) {
            if ($sppd->status == 0) {
                $sppd->ipa_tgl_dibuat = $request->today;
            }
            else if ($sppd->status == 1) {
                $sppd->ipa_tgl_diajukan = $request->today;
            }
            else if ($sppd->status == 2) {
                $sppd->ipa_tgl_approval = $request->today;
            }
            else if ($sppd->status == 3) {
                $sppd->ipa_tgl_msk_finance = $request->today;
            }
            else if ($sppd->status == 4) {
                $sppd->ipa_tgl_selesai = $request->today;
            }
            else if ($sppd->status == 10) {
                $sppd->pp_tgl_dibuat = $request->today;
            }
            else if ($sppd->status == 11) {
                $sppd->pp_tgl_diajukan = $request->today;
            }
            else if ($sppd->status == 12) {
                $sppd->pp_tgl_approval = $request->today;
            }
            else if ($sppd->status == 13) {
                $sppd->pp_tgl_msk_finance = $request->today;
            }
            else if ($sppd->status == 14) {
                $sppd->pp_tgl_selesai = $request->today;
            }
        }

        $sppd->ipa_no = $request->ipa_no;
        $sppd->ipa_tgl_dibuat = $request->ipa_tgl_dibuat;
        $sppd->ipa_tgl_approval = $request->ipa_tgl_approval;
        $sppd->ipa_tgl_msk_finance = $request->ipa_tgl_msk_finance;
        $sppd->ipa_tgl_selesai = $request->ipa_tgl_selesai;
        $sppd->nilai_ipa = $request->nilai_ipa;
        $sppd->sumber_dana = $request->sumber_dana;
        $sppd->pp_no = $request->pp_no;
        $sppd->pp_tgl_dibuat = $request->pp_tgl_dibuat;
        $sppd->pp_tgl_approval = $request->pp_tgl_approval;
        $sppd->pp_tgl_msk_finance = $request->pp_tgl_msk_finance;
        $sppd->pp_tgl_selesai = $request->pp_tgl_selesai;

        $sppd->status = $this->validateStatus($sppd);

        $simpan = $sppd->update();

        if($simpan){
            Session::flash('success', 'Perubahan data berhasil! Silahkan login untuk mengakses data');
            return redirect()->route('sppd');
        } else {
            Session::flash('errors', ['' => 'Perubahan data gagal! Silahkan ulangi beberapa saat lagi']);
            return redirect()->route('sppd.add');
        }
    }

    public function dibuat($id){
        $sppd=Sppd::find($id);
        $sppd->status = "1";
        $ipa_tgl_dibuat=Carbon::today()->toDateString();
        // $sppd->ipa_tgl_dibuat=$ipa_tgl_dibuat;
        $sppd->save();
        $ipa = IPA::where('ipa_no', $sppd->ipa_no)->first();
        $ipa->ipa_tgl_dibuat=$ipa_tgl_dibuat;
        $ipa->save();
        return redirect()->back();
    }

    public function diajukan($id){
        $sppd=Sppd::find($id);
        $sppd->status = "2";
        $ipa_tgl_diajukan=Carbon::today()->toDateString();
        // $sppd->ipa_tgl_diajukan=$ipa_tgl_diajukan;
        $sppd->save();
        $ipa = IPA::where('ipa_no', $sppd->ipa_no)->first();
        $ipa->ipa_tgl_diajukan=$ipa_tgl_diajukan;
        $ipa->save();
        return redirect()->back();
    }

    public function disetujui($id){
        $sppd=Sppd::find($id);
        $sppd->status = "3";
        $ipa_tgl_approval=Carbon::today()->toDateString();
        // $sppd->ipa_tgl_approval=$ipa_tgl_approval;
        $sppd->save();
        $ipa = IPA::where('ipa_no', $sppd->ipa_no)->first();
        $ipa->ipa_tgl_approval=$ipa_tgl_approval;
        $ipa->save();
        return redirect()->back();
    }

    public function finance($id){
        $sppd=Sppd::find($id);
        $sppd->status = "4";
        $ipa_tgl_msk_finance=Carbon::today()->toDateString();
        // $sppd->ipa_tgl_msk_finance=$ipa_tgl_msk_finance;
        $sppd->save();
        $ipa = IPA::where('ipa_no', $sppd->ipa_no)->first();
        $ipa->ipa_tgl_msk_finance=$ipa_tgl_msk_finance;
        $ipa->save();
        return redirect()->back();
    }

    public function selesai($id){
        $sppd=Sppd::find($id);
        $sppd->status = "10";
        $ipa_tgl_selesai=Carbon::today()->toDateString();
        // $sppd->ipa_tgl_selesai=$ipa_tgl_selesai;
        $sppd->save();
        $ipa = IPA::where('ipa_no', $sppd->ipa_no)->first();
        $ipa->ipa_tgl_selesai=$ipa_tgl_selesai;
        $ipa->save();
        return redirect()->back();
    }

    public function ppdibuat($id){
        $sppd=Sppd::find($id);
        $sppd->status = "11";
        $pp_tgl_dibuat=Carbon::today()->toDateString();
        // $sppd->pp_tgl_dibuat=$pp_tgl_dibuat;
        $sppd->save();
        $pp = PP::where('pp_no', $sppd->pp_no)->first();
        $pp->pp_tgl_dibuat=$pp_tgl_dibuat;
        $pp->save();
        return redirect()->back();
    }

    public function ppdiajukan($id){
        $sppd=Sppd::find($id);
        $sppd->status = "12";
        $pp_tgl_diajukan=Carbon::today()->toDateString();
        // $sppd->pp_tgl_diajukan=$pp_tgl_diajukan;
        $sppd->save();
        $pp = PP::where('pp_no', $sppd->pp_no)->first();
        $pp->pp_tgl_diajukan=$pp_tgl_diajukan;
        $pp->save();
        return redirect()->back();
    }

    public function ppdisetujui($id){
        $sppd=Sppd::find($id);
        $sppd->status = "13";
        $pp_tgl_approval=Carbon::today()->toDateString();
        // $sppd->pp_tgl_approval=$pp_tgl_approval;
        $sppd->save();
        $pp = PP::where('pp_no', $sppd->pp_no)->first();
        $pp->pp_tgl_approval=$pp_tgl_approval;
        $pp->save();
        return redirect()->back();
    }

    public function ppfinance($id){
        $sppd=Sppd::find($id);
        $sppd->status = "14";
        $pp_tgl_msk_finance=Carbon::today()->toDateString();
        // $sppd->pp_tgl_msk_finance=$pp_tgl_msk_finance;
        $sppd->save();
        $pp = PP::where('pp_no', $sppd->pp_no)->first();
        $pp->pp_tgl_msk_finance=$pp_tgl_msk_finance;
        $pp->save();
        return redirect()->back();
    }

    public function ppselesai($id){
        $sppd=Sppd::find($id);
        $sppd->status = "15";
        $pp_tgl_selesai=Carbon::today()->toDateString();
        // $sppd->pp_tgl_seles/ai=$pp_tgl_selesai;
        $sppd->save();
        $pp = PP::where('pp_no', $sppd->pp_no)->first();
        $pp->pp_tgl_selesai=$pp_tgl_selesai;
        $pp->save();
        return redirect()->back();
    }

    public function index()
    {
        // $sppd_list = Sppd::select(DB::raw('*'))->orderBy('id', 'DESC')->get();
        $sppd_list = DB::table('sppd')
            ->selectRaw('ipa.*, pp.*,sppd.*')
            ->join('ipa', 'ipa.ipa_no', '=', 'sppd.ipa_no', 'left outer')
            ->join('pp', 'pp.pp_no', '=', 'sppd.pp_no', 'left outer')
            ->orderByDesc('sppd.id')
            ->get();
        $today = Carbon::now()->format('Y-m-d');
        $today = Carbon::parse($today);

        $status = [
            "green" => 0,
            "yellow" => 0,
            "red" => 0,
            "done" => 0,
        ];

        $cek_days = [];
        $count = 0;
        $diff = 0;
        foreach ($sppd_list as $sppd) 
        {
            if ($sppd->status == 0) {
                $diff = $today->diffindays($sppd->tgl_pulang);
            }
            else if ($sppd->status == 1) {
                $diff = $today->diffindays($sppd->ipa_tgl_dibuat);
            }
            else if ($sppd->status == 2) {
                $diff = $today->diffindays($sppd->ipa_tgl_diajukan);
            }
            else if ($sppd->status == 3) {
                $diff = $today->diffindays($sppd->ipa_tgl_approval);
            }
            else if ($sppd->status == 4) {
                $diff = $today->diffindays($sppd->ipa_tgl_msk_finance);
            }
            else if ($sppd->status == 10) {
                $diff = $today->diffindays($sppd->ipa_tgl_selesai);
            }
            else if ($sppd->status == 11) {
                $diff = $today->diffindays($sppd->pp_tgl_dibuat);
            }
            else if ($sppd->status == 12) {
                $diff = $today->diffindays($sppd->pp_tgl_diajukan);
            }
            else if ($sppd->status == 13) {
                $diff = $today->diffindays($sppd->pp_tgl_approval);
            }
            else if ($sppd->status == 14) {
                $diff = $today->diffindays($sppd->pp_tgl_msk_finance);
            }
            else if ($sppd->status == 15) {
                $diff = 999;
                $status['done']++;
            }
            else return abort(404);
            
            // array_push($cek_days,['id' => $sppd->id, 'status' => $sppd->status, 'diffToday' => $diff]);
            if ($diff < 4) $status['green']++;
            else if ($diff >= 4 && $diff < 10) $status['yellow']++;
            else if ($diff >=10 && $diff != 999) $status['red']++;
        }
        return view('index', compact(['sppd_list', 'today', 'status']));
    }

    public function detilSPPD($id)
    {
        // $sppd = Sppd::where('id', $id)->first();
        $sppd = DB::table('sppd')
            ->selectRaw('ipa.*, pp.*,sppd.*')
            ->join('ipa', 'ipa.ipa_no', '=', 'sppd.ipa_no', 'left outer')
            ->join('pp', 'pp.pp_no', '=', 'sppd.pp_no', 'left outer')
            ->orderByDesc('sppd.id')
            ->where('sppd.id', $id)
            ->first();
        // $progres = Sppd::select(DB::raw('
        //     DATEDIFF(tgl_pulang, tgl_berangkat) + 1 as lama_perjalanan, 
        //     DATEDIFF(ipa_tgl_diajukan, ipa_tgl_dibuat) + 1 as ipa_1, 
        //     DATEDIFF(ipa_tgl_approval, ipa_tgl_diajukan) + 1 as ipa_2, 
        //     DATEDIFF(ipa_tgl_msk_finance, ipa_tgl_approval) + 1 as ipa_3, 
        //     DATEDIFF(ipa_tgl_selesai, ipa_tgl_msk_finance) + 1 as ipa_4, 
        //     DATEDIFF(ipa_tgl_selesai, ipa_tgl_dibuat) + 1 as ipa,
        //     DATEDIFF(pp_tgl_dibuat, ipa_tgl_selesai) + 1 as ipa_pp, 
        //     DATEDIFF(pp_tgl_diajukan, pp_tgl_dibuat) + 1 as pp_1, 
        //     DATEDIFF(pp_tgl_approval, pp_tgl_diajukan) + 1 as pp_2, 
        //     DATEDIFF(pp_tgl_msk_finance, pp_tgl_approval) + 1 as pp_3, 
        //     DATEDIFF(pp_tgl_selesai, pp_tgl_msk_finance) + 1 as pp_4,
        //     DATEDIFF(pp_tgl_selesai, pp_tgl_dibuat) + 1 as pp
        //     '))
        //     ->where('id', $id)->first();
        $query = 'select
            DATEDIFF(sppd.tgl_pulang, sppd.tgl_berangkat) + 1 as lama_perjalanan, 
            DATEDIFF(ipa.ipa_tgl_diajukan, ipa.ipa_tgl_dibuat) + 1 as ipa_1, 
            DATEDIFF(ipa.ipa_tgl_approval, ipa.ipa_tgl_diajukan) + 1 as ipa_2, 
            DATEDIFF(ipa.ipa_tgl_msk_finance, ipa.ipa_tgl_approval) + 1 as ipa_3, 
            DATEDIFF(ipa.ipa_tgl_selesai, ipa.ipa_tgl_msk_finance) + 1 as ipa_4, 
            DATEDIFF(ipa.ipa_tgl_selesai, ipa.ipa_tgl_dibuat) + 1 as ipa,
            DATEDIFF(pp.pp_tgl_dibuat, ipa.ipa_tgl_selesai) + 1 as ipa_pp, 
            DATEDIFF(pp.pp_tgl_diajukan, pp.pp_tgl_dibuat) + 1 as pp_1, 
            DATEDIFF(pp.pp_tgl_approval, pp.pp_tgl_diajukan) + 1 as pp_2, 
            DATEDIFF(pp.pp_tgl_msk_finance, pp.pp_tgl_approval) + 1 as pp_3, 
            DATEDIFF(pp.pp_tgl_selesai, pp.pp_tgl_msk_finance) + 1 as pp_4,
            DATEDIFF(pp.pp_tgl_selesai, pp.pp_tgl_dibuat) + 1 as pp
            from sppd
            left join `ipa` on `sppd`.`ipa_no` = `ipa`.`ipa_no` 
			left join `pp` on `sppd`.`pp_no` = `pp`.`pp_no`
            where sppd.id=
            ' . $id;
        $progres = DB::select(DB::raw($query))[0];
        $ipa_list = IPA::select('ipa_no')->get();
        $pp_list = PP::select('pp_no')->get();
        $tanggal=Carbon::today()->toDateString();
        return view('detil', compact('sppd', 'ipa_list', 'pp_list', 'tanggal', 'progres'));
    }

    public function filterSPPD(Request $request)
    {
        $today = Carbon::now()->format('Y-m-d');
        $today = Carbon::parse($today);

        $sppd_list = SPPD::all();
        
        $cek_days = [];
        $count = 0;
        $diff = 0;
        
        foreach ($sppd_list as $id => $sppd) 
        {
            if ($sppd->status == 0) {
                $diff = $today->diffindays($sppd->tgl_pulang);
            }
            else if ($sppd->status == 1) {
                $diff = $today->diffindays($sppd->ipa_tgl_dibuat);
            }
            else if ($sppd->status == 2) {
                $diff = $today->diffindays($sppd->ipa_tgl_diajukan);
            }
            else if ($sppd->status == 3) {
                $diff = $today->diffindays($sppd->ipa_tgl_approval);
            }
            else if ($sppd->status == 4) {
                $diff = $today->diffindays($sppd->ipa_tgl_msk_finance);
            }
            else if ($sppd->status == 10) {
                $diff = $today->diffindays($sppd->ipa_tgl_selesai);
            }
            else if ($sppd->status == 11) {
                $diff = $today->diffindays($sppd->pp_tgl_dibuat);
            }
            else if ($sppd->status == 12) {
                $diff = $today->diffindays($sppd->pp_tgl_diajukan);
            }
            else if ($sppd->status == 13) {
                $diff = $today->diffindays($sppd->pp_tgl_approval);
            }
            else if ($sppd->status == 14) {
                $diff = $today->diffindays($sppd->pp_tgl_msk_finance);
            }
            else if ($sppd->status == 15) {
                $diff = 999;
            }
            else return abort(404);
            
            if ($request->filter == "green") {
                if ($diff < 0 or $diff >=4) unset($sppd_list[$id]);
            }
            else if ($request->filter == "yellow") {
                if ($diff < 4 || $diff >= 10) unset($sppd_list[$id]);
            }
            else if ($request->filter == "red") {
                if ($diff < 10 || $diff == 999) unset($sppd_list[$id]);
            }
            else if ($request->filter == "done") {
                if ($diff != 999) unset($sppd_list[$id]);
            }
        }
        // dd($sppd_list);
        
        if ($sppd_list) {
            // dd($sppd_list);
            return view('filter', compact('sppd_list'));
        }
        else {
            return redirect()->back();
        }
    }

    public function detilIPA($id)
    {
        $sppd = Sppd::where('id', $id)->first();
        return view('detil', compact('sppd'));
    }

    public function detilPP($id)
    {
        $sppd = Sppd::where('id', $id)->first();
        return view('detil', compact('sppd'));
    }

    public function create()
    {
        $ipa_list = IPA::select('ipa_no')->get();
        $pp_list = PP::select('pp_no')->get();
        return view('create', compact('ipa_list', 'pp_list'));
    }

    public function store(Request $request)
    {
        $sppd = new Sppd;
        
        if ($request->ipa_tgl_dibuat) { //case ipa baru dibuat
            $ipa = new Ipa;
            
            $ipa->ipa_no = $request->ipa_no;
            $ipa->ipa_tgl_dibuat = $request->ipa_tgl_dibuat;
            $ipa->ipa_tgl_diajukan = $request->ipa_tgl_diajukan;
            $ipa->ipa_tgl_approval = $request->ipa_tgl_approval;
            $ipa->ipa_tgl_msk_finance = $request->ipa_tgl_msk_finance;
            $ipa->ipa_tgl_selesai = $request->ipa_tgl_selesai;
            $ipa->ipa_nilai = $request->ipa_nilai;
            $ipa->sumber_dana = $request->sumber_dana;
            $simpan_ipa = $ipa->save();
            
            if (!$simpan_ipa) {
                Session::flash('errors', ['' => 'Penambahan gagal! Silahkan ulangi beberapa saat lagi']);
                return redirect()->route('sppd.add');
            }
            
        }    
        else {
            $ipa = IPA::where('ipa_no', $request->ipa_no)->first();

        }    
        if ($request->pp_tgl_dibuat) {//case pp baru dibuat
            $pp = new Pp;
            
            $pp->pp_no = $request->pp_no;
            $pp->pp_tgl_dibuat = $request->pp_tgl_dibuat;
            $pp->pp_tgl_diajukan = $request->pp_tgl_diajukan;
            $pp->pp_tgl_approval = $request->pp_tgl_approval;
            $pp->pp_tgl_msk_finance = $request->pp_tgl_msk_finance;
            $pp->pp_tgl_selesai = $request->pp_tgl_selesai;
            $simpan_pp = $pp->save();
            if (!$simpan_pp) {
                Session::flash('errors', ['' => 'Penambahan gagal! Silahkan ulangi beberapa saat lagi']);
                return redirect()->route('sppd.add');
            }
        }
        else {
            $pp = PP::where('pp_no', $request->pp_no)->first();

        }

        $sppd->sppd_no = $request->sppd_no;
        $sppd->ipa_no = $request->ipa_no;
        $sppd->pp_no = $request->pp_no;
        $sppd->sppd_tujuan = $request->sppd_tujuan;
        $sppd->sppd_alasan = $request->sppd_alasan;
        $sppd->tgl_berangkat = $request->tgl_berangkat;
        $sppd->tgl_pulang = $request->tgl_pulang;
        $sppd->sppd_tgl_msk = $request->sppd_tgl_msk;
        $sppd->unit_kerja = $request->unit_kerja;
        

        $sppd->status = $this->validateStatus($sppd, $ipa, $pp);
        

        $sppd->pegawai = implode(', ', $request->pegawai);

        if ($request->sppd_kendaraan == '1') {
            $sppd->sppd_kendaraan = 'Kendaraan Darat';
        }
        else if ($request->sppd_kendaraan == '2') {
            $sppd->sppd_kendaraan = 'Kendaraan Udara';
        }
        else if ($request->sppd_kendaraan == '3') {
            $sppd->sppd_kendaraan = 'Kendaraan Dinas/Pribadi';
        }
        else return redirect()->route('sppd.add');
        
        if ($request->op_pengisi == '1') {
            $sppd->op_pengisi = 'Ady';
        }
        else if ($request->op_pengisi == '2') {
            $sppd->op_pengisi = 'Rika';
        }
        else redirect()->route('sppd.add');

        $simpan = $sppd->save();
  
        if($simpan){
            Session::flash('success', 'Penambahan berhasil! Silahkan login untuk mengakses data');
            return redirect()->route('sppd');
        } else {
            Session::flash('errors', ['' => 'Penambahan gagal! Silahkan ulangi beberapa saat lagi']);
            return redirect()->route('sppd.add');
        }

        if ($request->ajax()) {
            $data = SPPD::latest()->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $actionBtn = '<a href="javascript:void(0)" class="edit btn btn-success btn-sm">Edit</a> <a href="javascript:void(0)" class="delete btn btn-danger btn-sm">Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function edit($id)
    {
        $sppd = Sppd::where('id', $id)->first();
        return view('edit', compact('sppd'));
    }


    public function update(Request $request)
    {
        // dd($request);
        $sppd = Sppd::find($request->id);
        
        if ($request->ipa_tgl_dibuat) { //case ipa baru dibuat
            $ipa = IPA::where('ipa_no', $request->ipa_no)->first();
            
            $ipa->ipa_no = $request->ipa_no;
            $ipa->ipa_tgl_dibuat = $request->ipa_tgl_dibuat;
            $ipa->ipa_tgl_diajukan = $request->ipa_tgl_diajukan;
            $ipa->ipa_tgl_approval = $request->ipa_tgl_approval;
            $ipa->ipa_tgl_msk_finance = $request->ipa_tgl_msk_finance;
            $ipa->ipa_tgl_selesai = $request->ipa_tgl_selesai;
            $ipa->ipa_nilai = $request->ipa_nilai;
            $ipa->sumber_dana = $request->sumber_dana;
            $simpan_ipa = $ipa->save();
            
            if (!$simpan_ipa) {
                Session::flash('errors', ['' => 'Penambahan gagal! Silahkan ulangi beberapa saat lagi']);
                return redirect()->route('sppd.add');
            }
            
        }    
        else {
            $ipa = IPA::where('ipa_no', $request->ipa_no)->first();

        }    
        if ($request->pp_tgl_dibuat) {//case pp baru dibuat
            $pp = PP::where('pp_no', $request->pp_no)->first();

            
            $pp->pp_no = $request->pp_no;
            $pp->pp_tgl_dibuat = $request->pp_tgl_dibuat;
            $pp->pp_tgl_diajukan = $request->pp_tgl_diajukan;
            $pp->pp_tgl_approval = $request->pp_tgl_approval;
            $pp->pp_tgl_msk_finance = $request->pp_tgl_msk_finance;
            $pp->pp_tgl_selesai = $request->pp_tgl_selesai;
            $simpan_pp = $pp->save();
            if (!$simpan_pp) {
                Session::flash('errors', ['' => 'Penambahan gagal! Silahkan ulangi beberapa saat lagi']);
                return redirect()->route('sppd.add');
            }
        }
        else {
            $pp = PP::where('pp_no', $request->pp_no)->first();

        }

        $sppd->sppd_no = $request->sppd_no;
        $sppd->ipa_no = $request->ipa_no;
        $sppd->pp_no = $request->pp_no;
        $sppd->sppd_tujuan = $request->sppd_tujuan;
        $sppd->sppd_alasan = $request->sppd_alasan;
        $sppd->tgl_berangkat = $request->tgl_berangkat;
        $sppd->tgl_pulang = $request->tgl_pulang;
        $sppd->sppd_tgl_msk = $request->sppd_tgl_msk;
        $sppd->unit_kerja = $request->unit_kerja;

        $sppd->status = $this->validateStatus($sppd, $ipa, $pp);
        

        $sppd->pegawai = implode(', ', $request->pegawai);

        if ($request->sppd_kendaraan == '1' or $sppd->sppd_kendaraan = 'Kendaraan Darat') {
            $sppd->sppd_kendaraan = 'Kendaraan Darat';
        }
        else if ($request->sppd_kendaraan == '2' or $sppd->sppd_kendaraan = 'Kendaraan Udara') {
            $sppd->sppd_kendaraan = 'Kendaraan Udara';
        }
        else if ($request->sppd_kendaraan == '3' or $sppd->sppd_kendaraan = 'Kendaraan Dinas/Pribadi') {
            $sppd->sppd_kendaraan = 'Kendaraan Dinas/Pribadi';
        }
        else return redirect()->back()->withInput();
        if ($request->op_pengisi == '1' or $sppd->op_pengisi = 'Ady') {
            $sppd->op_pengisi = 'Ady';
        }
        else if ($request->op_pengisi == '2' or $sppd->op_pengisi = 'Rika') {
            $sppd->op_pengisi = 'Rika';
        }
        else redirect()->back()->withInput();

        $sppd->status = $this->validateStatus($sppd, $ipa, $pp);

        $simpan = $sppd->update();

        if($simpan){
            Session::flash('success', 'Perubahan data berhasil! Silahkan login untuk mengakses data');
            return redirect()->route('sppd.detil', ['id' => $sppd->id]); 
        } else {
            Session::flash('errors', ['' => 'Perubahan data gagal! Silahkan ulangi beberapa saat lagi']);
            return redirect()->back()->withInput();
        }
    }

    public function delete($id)
    {
        $deletedUser = Sppd::where('id', $id)->delete();
        return back()->with('success', 'User successfully deleted');
    }
}

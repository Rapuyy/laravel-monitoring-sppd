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
        $this->middleware('auth', ['except' => ['index']]);
    }

    public function validateStatus($sppd, ?IPA $ipa, ?PP $pp) //dipake store sama update
    {
        // dd($ipa, $pp, $sppd);
        //nanti kayanya mesti null nullan disini deh
        if ($sppd->sppd_no) { //ipa
            $sppd->status = '0';
            if ($ipa) {
                if ($ipa->ipa_tgl_dibuat && $sppd->ipa_no) {
                    $sppd->status = '1';
                    if ($ipa->ipa_tgl_diajukan) {
                        $sppd->status = '2';
                        if ($ipa->ipa_tgl_approval) {
                            $sppd->status = '3';
                            if ($ipa->ipa_tgl_msk_finance) {
                                $sppd->status = '4';
                                if ($ipa->ipa_tgl_selesai) {
                                    $sppd->status = '10';
                                    if ($pp) {
                                        if ($sppd->pp_no && $pp->pp_tgl_dibuat) {
                                            $sppd->status = '11'; //pp
                                            if ($pp->pp_tgl_diajukan) {
                                                $sppd->status = '12';
                                                if ($pp->pp_tgl_approval) {
                                                    $sppd->status = '13';
                                                    if ($pp->pp_tgl_msk_finance) {
                                                        $sppd->status = '14';
                                                        if ($pp->pp_tgl_selesai) {
                                                            $sppd->status = '15';
                                                        }
                                                    }
                                                }
                                            }
                                        }
                                    }
                                    else return $sppd->status;
                                }
                            }
                        }
                    }
                }
            }
            else return $sppd->status;
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
        $ipa->ipa_status = "1";
        $ipa->ipa_tgl_dibuat=$ipa_tgl_dibuat;
        $ipa->save();
        return redirect()->back();
    }

    public function dibuat2($id){
        $ipa = IPA::where('id', $id)->first();

        $ipa_tgl_dibuat=Carbon::today()->toDateString();
        $ipa->ipa_status = "1";
        $ipa->ipa_tgl_dibuat=$ipa_tgl_dibuat;
        $ipa->save();
        SPPD::where('ipa_no', $ipa->ipa_no)->update(['status'=>'1']);
        return redirect()->back();
    }

    public function diajukan($id){
        $sppd=Sppd::find($id);
        $sppd->status = "2";
        $ipa_tgl_diajukan=Carbon::today()->toDateString();
        // $sppd->ipa_tgl_diajukan=$ipa_tgl_diajukan;
        $sppd->save();
        $ipa = IPA::where('ipa_no', $sppd->ipa_no)->first();
        $ipa->ipa_status = "2";
        $ipa->ipa_tgl_diajukan=$ipa_tgl_diajukan;
        $ipa->save();
        
        return redirect()->back();
    }

    public function diajukan2($id){
        $ipa = IPA::where('id', $id)->first();

        $ipa_tgl_diajukan=Carbon::today()->toDateString();
        $ipa->ipa_status = "2";
        $ipa->ipa_tgl_diajukan=$ipa_tgl_diajukan;
        $ipa->save();
        SPPD::where('ipa_no',$ipa->ipa_no)->update(['status'=>'2']);

        return redirect()->back();
    }

    public function disetujui($id){
        $sppd=Sppd::find($id);
        $sppd->status = "3";
        $ipa_tgl_approval=Carbon::today()->toDateString();
        // $sppd->ipa_tgl_approval=$ipa_tgl_approval;
        $sppd->save();
        $ipa = IPA::where('ipa_no', $sppd->ipa_no)->first();
        $ipa->ipa_status = "3";
        $ipa->ipa_tgl_approval=$ipa_tgl_approval;
        $ipa->save();
        return redirect()->back();
    }

    public function disetujui2($id){
        $ipa = IPA::where('id', $id)->first();

        $ipa_tgl_approval=Carbon::today()->toDateString();
        $ipa->ipa_status = "3";
        $ipa->ipa_tgl_approval=$ipa_tgl_approval;
        $ipa->save();
        SPPD::where('ipa_no',$ipa->ipa_no)->update(['status'=>'3']);

        return redirect()->back();
    }

    public function finance($id){
        $sppd=Sppd::find($id);
        $sppd->status = "4";
        $ipa_tgl_msk_finance=Carbon::today()->toDateString();
        // $sppd->ipa_tgl_msk_finance=$ipa_tgl_msk_finance;
        $sppd->save();
        $ipa = IPA::where('ipa_no', $sppd->ipa_no)->first();
        $ipa->ipa_status = "4";
        $ipa->ipa_tgl_msk_finance=$ipa_tgl_msk_finance;
        $ipa->save();
        return redirect()->back();
    }

    public function finance2($id){
        $ipa = IPA::where('id', $id)->first();

        $ipa_tgl_msk_finance=Carbon::today()->toDateString();
        $ipa->ipa_status = "4";
        $ipa->ipa_tgl_msk_finance=$ipa_tgl_msk_finance;
        $ipa->save();
        SPPD::where('ipa_no',$ipa->ipa_no)->update(['status'=>'4']);

        return redirect()->back();
    }

    public function selesai($id){
        $sppd=Sppd::find($id);
        $sppd->status = "10";
        $ipa_tgl_selesai=Carbon::today()->toDateString();
        // $sppd->ipa_tgl_selesai=$ipa_tgl_selesai;
        $sppd->save();
        $ipa = IPA::where('ipa_no', $sppd->ipa_no)->first();
        $ipa->ipa_status = "10";
        $ipa->ipa_tgl_selesai=$ipa_tgl_selesai;
        $ipa->save();
        return redirect()->back();
    }

    public function selesai2($id){
        $ipa = IPA::where('id', $id)->first();

        $ipa_tgl_selesai=Carbon::today()->toDateString();
        $ipa->ipa_status = "10";
        $ipa->ipa_tgl_selesai=$ipa_tgl_selesai;
        $ipa->save();
        SPPD::where('ipa_no',$ipa->ipa_no)->update(['status'=>'10']);

        return redirect()->back();
    }

    public function ppdibuat($id){
        $sppd=Sppd::find($id);
        $sppd->status = "11";
        $pp_tgl_dibuat=Carbon::today()->toDateString();
        // $sppd->pp_tgl_dibuat=$pp_tgl_dibuat;
        $sppd->save();
        $pp = PP::where('pp_no', $sppd->pp_no)->first();
        $pp->pp_status = "11";
        $pp->pp_tgl_dibuat=$pp_tgl_dibuat;
        $pp->save();
        return redirect()->back();
    }

    public function ppdibuat2($id){
        $pp = PP::where('id', $id)->first();

        $pp_tgl_dibuat=Carbon::today()->toDateString();
        $pp->pp_status = "11";
        $pp->pp_tgl_dibuat=$pp_tgl_dibuat;
        $pp->save();
        SPPD::where('pp_no',$pp->pp_no)->update(['status'=>'11']);

        return redirect()->back();
    }

    public function ppdiajukan($id){
        $sppd=Sppd::find($id);
        dd($sppd);
        $sppd->status = "12";
        $pp_tgl_diajukan=Carbon::today()->toDateString();
        // $sppd->pp_tgl_diajukan=$pp_tgl_diajukan;
        $sppd->save();
        $pp = PP::where('pp_no', $sppd->pp_no)->first();
        $pp->pp_status = "12";
        $pp->pp_tgl_diajukan=$pp_tgl_diajukan;
        $pp->save();
        return redirect()->back();
    }

    public function ppdiajukan2($id){
        $pp = PP::where('id', $id)->first();

        $pp_tgl_diajukan=Carbon::today()->toDateString();
        $pp->pp_status = "12";
        $pp->pp_tgl_diajukan=$pp_tgl_diajukan;
        $pp->save();
        SPPD::where('pp_no',$pp->pp_no)->update(['status'=>'12']);

        return redirect()->back();
    }

    public function ppdisetujui($id){
        $sppd=Sppd::find($id);
        $sppd->status = "13";
        $pp_tgl_approval=Carbon::today()->toDateString();
        // $sppd->pp_tgl_approval=$pp_tgl_approval;
        $sppd->save();
        $pp = PP::where('pp_no', $sppd->pp_no)->first();
        $pp->pp_status = "13";
        $pp->pp_tgl_approval=$pp_tgl_approval;
        $pp->save();   
        return redirect()->back();
    }

    public function ppdisetujui2($id){
        $pp = PP::where('id', $id)->first();

        $pp_tgl_approval=Carbon::today()->toDateString();
        $pp->pp_status = "13";
        $pp->pp_tgl_approval=$pp_tgl_approval;
        $pp->save();   
        SPPD::where('pp_no',$pp->pp_no)->update(['status'=>'13']);

        return redirect()->back();
    }

    public function ppfinance($id){
        $sppd=Sppd::find($id);
        $sppd->status = "14";
        $pp_tgl_msk_finance=Carbon::today()->toDateString();
        // $sppd->pp_tgl_msk_finance=$pp_tgl_msk_finance;
        $sppd->save();
        $pp = PP::where('pp_no', $sppd->pp_no)->first();
        $pp->pp_status = "14";
        $pp->pp_tgl_msk_finance=$pp_tgl_msk_finance;
        $pp->save();
        return redirect()->back();
    }

    public function ppfinance2($id){
        $pp = PP::where('id', $id)->first();

        $pp_tgl_msk_finance=Carbon::today()->toDateString();
        $pp->pp_status = "14";
        $pp->pp_tgl_msk_finance=$pp_tgl_msk_finance;
        $pp->save();
        SPPD::where('pp_no',$pp->pp_no)->update(['status'=>'14']);

        return redirect()->back();
    }

    public function ppselesai($id){
        $sppd=Sppd::find($id);
        $sppd->status = "15";
        $pp_tgl_selesai=Carbon::today()->toDateString();
        // $sppd->pp_tgl_seles/ai=$pp_tgl_selesai;
        $sppd->save();
        $pp = PP::where('pp_no', $sppd->pp_no)->first();
        $pp->pp_status = "15";
        $pp->pp_tgl_selesai=$pp_tgl_selesai;
        $pp->save();
        return redirect()->back();
    }

    public function ppselesai2($id){
        $pp = PP::where('id', $id)->first();

        $pp_tgl_selesai=Carbon::today()->toDateString();
        $pp->pp_status = "15";
        $pp->pp_tgl_selesai=$pp_tgl_selesai;
        $pp->save();
        SPPD::where('pp_no',$pp->pp_no)->update(['status'=>'15']);

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
        
        $pp_list = Pp::select('pp.*', DB::raw("DATEDIFF(curdate(), pp.pp_tgl_dibuat) + 1 as pp, DATEDIFF(pp.pp_tgl_msk_finance, pp.pp_tgl_dibuat) + 1 as pp_selesai"))
            ->get();

        $ipa_list = Ipa::select('ipa.*', DB::raw("DATEDIFF(curdate(), ipa.ipa_tgl_dibuat) + 1 as ipa, DATEDIFF(ipa.ipa_tgl_selesai, ipa.ipa_tgl_dibuat) + 1 as ipa_selesai"))
            ->get();
        
        $today = Carbon::now()->format('Y-m-d');
        $today = Carbon::parse($today);

        $status = [
            "green" => 0,
            "greenIPA" => 0,
            "greenPP" => 0,
            "yellow" => 0,
            "yellowIPA" => 0,
            "yellowPP" => 0,
            "red" => 0,
            "redIPA" => 0,
            "redPP" => 0,
            "done" => 0,
        ];

        $cek_days = [];
        $count = 0;
        $diff = 0;
        $diff2 = 0;
        $diff3 = 0;

        foreach ($pp_list as $pp) {
            if ($pp->pp_selesai) {
                if ($pp->pp_selesai < 6) $status['greenPP']++; //+1 biar query ga null
                else if ($pp->pp_selesai >= 6 && $pp->pp_selesai < 11) $status['yellowPP']++;
                else if ($pp->pp_selesai >= 11 && $pp->pp_selesai != 999) $status['redPP']++;
            }
            else {
                if ($pp->pp < 6) $status['greenPP']++;
                else if ($pp->pp >= 6 && $pp->pp < 11) $status['yellowPP']++;
                else if ($pp->pp >= 11 && $pp->pp != 999) $status['redPP']++;
            }
        }
        foreach ($ipa_list as $ipa) {
            if ($ipa->ipa_selesai) {
                if ($ipa->ipa_selesai < 6) $status['greenIPA']++;
                else if ($ipa->ipa_selesai >= 6 && $ipa->ipa_selesai < 11) $status['yellowIPA']++;
                else if ($ipa->ipa_selesai >= 11 && $ipa->ipa_selesai != 999) $status['redIPA']++;
            }
            else {
                if ($ipa->ipa < 6) $status['greenIPA']++;
                else if ($ipa->ipa >= 6 && $ipa->ipa < 11) $status['yellowIPA']++;
                else if ($ipa->ipa >= 11 && $ipa->ipa != 999) $status['redIPA']++;
            }
        }
        // dd($ipa_list);

        foreach ($sppd_list as $sppd) 
        {
            if ($sppd->status == 0) {
                $diff = $today->diffindays($sppd->tgl_pulang);
            }
            else if ($sppd->status == 1) {
                $diff = $today->diffindays($sppd->ipa_tgl_dibuat);
                $diff2 = $today->diffindays($sppd->ipa_tgl_dibuat);
            }
            else if ($sppd->status == 2) {
                $diff = $today->diffindays($sppd->ipa_tgl_diajukan);
                $diff2 = $today->diffindays($sppd->ipa_tgl_diajukan);
            }
            else if ($sppd->status == 3) {
                $diff = $today->diffindays($sppd->ipa_tgl_approval);
                $diff2 = $today->diffindays($sppd->ipa_tgl_approval);
            }
            else if ($sppd->status == 4) {
                $diff = $today->diffindays($sppd->ipa_tgl_msk_finance);
                $diff2 = $today->diffindays($sppd->ipa_tgl_msk_finance);
            }
            else if ($sppd->status == 10) {
                $diff = $today->diffindays($sppd->ipa_tgl_selesai);

                $ipaDone = new Carbon($sppd->ipa_tgl_selesai);
                $ipaDone = Carbon::parse($ipaDone);
                $diff2 = $ipaDone->diffindays($sppd->ipa_tgl_dibuat);

            }
            else if ($sppd->status == 11) {
                $diff = $today->diffindays($sppd->pp_tgl_dibuat);
                $diff3 = $today->diffindays($sppd->pp_tgl_dibuat);
            }
            else if ($sppd->status == 12) {
                $diff = $today->diffindays($sppd->pp_tgl_diajukan);
                $diff3 = $today->diffindays($sppd->pp_tgl_diajukan);
            }
            else if ($sppd->status == 13) {
                $diff = $today->diffindays($sppd->pp_tgl_approval);
                $diff3 = $today->diffindays($sppd->pp_tgl_approval);
            }
            else if ($sppd->status == 14) {
                $diff = 999;
                $status['done']++;

                $ppDone = new Carbon($sppd->pp_tgl_selesai);
                $ppDone = Carbon::parse($ppDone);
                $diff3 = $ppDone->diffindays($sppd->pp_tgl_dibuat);
            }
            else return abort(404);
            
            // array_push($cek_days,['id' => $sppd->id, 'status' => $sppd->status, 'diffToday' => $diff]);
            if ($diff < 4) $status['green']++;
            else if ($diff >= 4 && $diff < 10) $status['yellow']++;
            else if ($diff >=10 && $diff != 999) $status['red']++;

            // if ($diff2 < 4) $status['greenIPA']++;
            // else if ($diff2 >= 4 && $diff2 < 10) $status['yellowIPA']++;
            // else if ($diff2 >=10 && $diff2 != 999) $status['redIPA']++;

            // if ($diff3 < 4) $status['greenPP']++;
            // else if ($diff3 >= 4 && $diff3 < 10) $status['yellowPP']++;
            // else if ($diff3 >=10 && $diff3 != 999) $status['redPP']++;
        }
        // dd($status);
        return view('index', compact(['sppd_list', 'today', 'status']));
    }

    public function detilSPPD($id)
    {
        $sppd = DB::table('sppd')
            ->selectRaw('ipa.*, pp.*,sppd.*')
            ->join('ipa', 'ipa.ipa_no', '=', 'sppd.ipa_no', 'left outer')
            ->join('pp', 'pp.pp_no', '=', 'sppd.pp_no', 'left outer')
            ->orderByDesc('sppd.id')
            ->where('sppd.id', $id)
            ->first();
        $query = 'select
            DATEDIFF(sppd.tgl_pulang, sppd.tgl_berangkat) +1 as lama_perjalanan, 
            DATEDIFF(ipa.ipa_tgl_diajukan, ipa.ipa_tgl_dibuat)  as ipa_1, 
            DATEDIFF(ipa.ipa_tgl_approval, ipa.ipa_tgl_diajukan)  as ipa_2, 
            DATEDIFF(ipa.ipa_tgl_msk_finance, ipa.ipa_tgl_approval)  as ipa_3, 
            DATEDIFF(ipa.ipa_tgl_selesai, ipa.ipa_tgl_msk_finance)  as ipa_4, 
            DATEDIFF(ipa.ipa_tgl_selesai, ipa.ipa_tgl_dibuat)  as ipa,
            DATEDIFF(pp.pp_tgl_dibuat, ipa.ipa_tgl_selesai)  as ipa_pp, 
            DATEDIFF(pp.pp_tgl_diajukan, pp.pp_tgl_dibuat)  as pp_1, 
            DATEDIFF(pp.pp_tgl_approval, pp.pp_tgl_diajukan)  as pp_2, 
            DATEDIFF(pp.pp_tgl_msk_finance, pp.pp_tgl_approval)  as pp_3, 
            DATEDIFF(pp.pp_tgl_msk_finance, pp.pp_tgl_dibuat)  as pp
            from sppd
            left join `ipa` on `sppd`.`ipa_no` = `ipa`.`ipa_no` 
			left join `pp` on `sppd`.`pp_no` = `pp`.`pp_no`
            where sppd.id=
            ' . $id;
        $progres = DB::select(DB::raw($query))[0];
        $ipa_list = IPA::select('ipa_no')->get();
        $pp_list = PP::select('pp_no')->get();
        $tanggal=Carbon::today()->toDateString();
        return view('sppd.detil', compact('sppd', 'ipa_list', 'pp_list', 'tanggal', 'progres'));
    }

    public function filterSPPD(Request $request)
    {
        $today = Carbon::now()->format('Y-m-d');
        $today = Carbon::parse($today);

        $sppd_list = DB::table('sppd')
        ->selectRaw('ipa.*, pp.*,sppd.*')
        ->join('ipa', 'ipa.ipa_no', '=', 'sppd.ipa_no', 'left outer')
        ->join('pp', 'pp.pp_no', '=', 'sppd.pp_no', 'left outer')
        ->orderByDesc('sppd.id')
        ->get();
        
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
                // $diff = $today->diffindays($sppd->pp_tgl_msk_finance);
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
            return view('sppd.filter', compact('sppd_list'));
        }
        else {
            return redirect()->back();
        }
    }

    public function indexSPPD()
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
            "greenIPA" => 0,
            "greenPP" => 0,
            "yellow" => 0,
            "yellowIPA" => 0,
            "yellowPP" => 0,
            "red" => 0,
            "redIPA" => 0,
            "redPP" => 0,
            "done" => 0,
        ];

        $cek_days = [];
        $count = 0;
        $diff = 0;
        $diff2 = 0;
        $diff3 = 0;
        foreach ($sppd_list as $sppd) 
        {
            if ($sppd->status == 0) {
                $diff = $today->diffindays($sppd->tgl_pulang);
            }
            else if ($sppd->status == 1) {
                $diff = $today->diffindays($sppd->ipa_tgl_dibuat);
                $diff2 = $today->diffindays($sppd->ipa_tgl_dibuat);
            }
            else if ($sppd->status == 2) {
                $diff = $today->diffindays($sppd->ipa_tgl_diajukan);
                $diff2 = $today->diffindays($sppd->ipa_tgl_diajukan);
            }
            else if ($sppd->status == 3) {
                $diff = $today->diffindays($sppd->ipa_tgl_approval);
                $diff2 = $today->diffindays($sppd->ipa_tgl_approval);
            }
            else if ($sppd->status == 4) {
                $diff = $today->diffindays($sppd->ipa_tgl_msk_finance);
                $diff2 = $today->diffindays($sppd->ipa_tgl_msk_finance);
            }
            else if ($sppd->status == 10) {
                $diff = $today->diffindays($sppd->ipa_tgl_selesai);
                $diff2 = $today->diffindays($sppd->ipa_tgl_selesai);
            }
            else if ($sppd->status == 11) {
                $diff = $today->diffindays($sppd->pp_tgl_dibuat);
                $diff3 = $today->diffindays($sppd->pp_tgl_dibuat);
            }
            else if ($sppd->status == 12) {
                $diff = $today->diffindays($sppd->pp_tgl_diajukan);
                $diff3 = $today->diffindays($sppd->pp_tgl_diajukan);
            }
            else if ($sppd->status == 13) {
                $diff = $today->diffindays($sppd->pp_tgl_approval);
                $diff3 = $today->diffindays($sppd->pp_tgl_approval);
            }
            else if ($sppd->status == 14) {
                $diff = $today->diffindays($sppd->pp_tgl_msk_finance);
                $diff3 = $today->diffindays($sppd->pp_tgl_msk_finance);
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

            if ($diff2 < 4) $status['greenIPA']++;
            else if ($diff2 >= 4 && $diff2 < 10) $status['yellowIPA']++;
            else if ($diff2 >=10 && $diff2 != 999) $status['redIPA']++;

            if ($diff3 < 4) $status['greenPP']++;
            else if ($diff3 >= 4 && $diff3 < 10) $status['yellowPP']++;
            else if ($diff3 >=10 && $diff3 != 999) $status['redPP']++;
        }
        return view('sppd.index', compact(['sppd_list', 'today', 'status']));
    }

    public function indexIPA()
    {
        \DB::statement("SET SQL_MODE=''");
        $ipa_list = ipa::leftJoin('sppd', 'sppd.ipa_no', '=', 'ipa.ipa_no')
        ->select('ipa.*', 'sppd.status',DB::raw("DATEDIFF(curdate(), ipa.ipa_tgl_dibuat)  as ipa"))
        ->groupBy('ipa.ipa_no')->get()->sortByDesc('created_at');

        $today = Carbon::now()->format('Y-m-d');
        $today = Carbon::parse($today);

        foreach ($ipa_list as $ipa) 
        {
            $ipa->diff = 0;
            if ($ipa->status == 0) {
                $diff = $today->diffindays($ipa->tgl_pulang);
            }
            else if ($ipa->status == 1 || $ipa->status == 2 || $ipa->status == 3) {
                $ipa->diff = $today->diffindays($ipa->ipa_tgl_dibuat);
            }
            else if ($ipa->status == 4) {
                $ipa->diff = $today->diffindays($ipa->ipa_tgl_msk_finance);
            }
        }
        // dd($ipa_list);
        return view('ipa.index', compact('ipa_list'));
    }

    public function detailIPA($id)
    {
        $ipa = ipa::leftJoin('sppd', 'sppd.ipa_no', '=', 'ipa.ipa_no')
        ->select('ipa.*', 'sppd.status')
        ->where([['ipa.id', '=', $id]])
        ->first();
        // dd($ipa);

        $query = 'select
        DATEDIFF(sppd.tgl_pulang, sppd.tgl_berangkat)  as lama_perjalanan, 
        DATEDIFF(ipa.ipa_tgl_diajukan, ipa.ipa_tgl_dibuat)  as ipa_1, 
        DATEDIFF(ipa.ipa_tgl_approval, ipa.ipa_tgl_diajukan)  as ipa_2, 
        DATEDIFF(ipa.ipa_tgl_msk_finance, ipa.ipa_tgl_approval)  as ipa_3, 
        DATEDIFF(ipa.ipa_tgl_selesai, ipa.ipa_tgl_msk_finance)  as ipa_4, 
        DATEDIFF(curdate(), ipa.ipa_tgl_dibuat)  as ipa,
        DATEDIFF(ipa.ipa_tgl_selesai, ipa.ipa_tgl_dibuat)  as ipa_selesai,
        DATEDIFF(pp.pp_tgl_dibuat, ipa.ipa_tgl_selesai)  as ipa_pp, 
        DATEDIFF(pp.pp_tgl_diajukan, pp.pp_tgl_dibuat)  as pp_1, 
        DATEDIFF(pp.pp_tgl_approval, pp.pp_tgl_diajukan)  as pp_2, 
        DATEDIFF(pp.pp_tgl_msk_finance, pp.pp_tgl_approval)  as pp_3, 
        DATEDIFF(pp.pp_tgl_selesai, pp.pp_tgl_msk_finance)  as pp_4,
        DATEDIFF(pp.pp_tgl_selesai, pp.pp_tgl_dibuat)  as pp
        from ipa
        left join `sppd` on `sppd`.`ipa_no` = `ipa`.`ipa_no` 
        left join `pp` on `sppd`.`pp_no` = `pp`.`pp_no`
        where ipa.id=
        ' . $id;
        $progres = DB::select(DB::raw($query))[0];
        $tanggal=Carbon::today()->toDateString();
        return view('ipa.detail', compact('ipa', 'progres', 'tanggal'));
    }

    public function indexPP()
    {
        $today = Carbon::now()->format('Y-m-d');
        $today = Carbon::parse($today);

        \DB::statement("SET SQL_MODE=''");
        $pp_list = pp::leftJoin('sppd', 'sppd.pp_no', '=', 'pp.pp_no')
            ->select('pp.*', 'sppd.status')
            ->where([['sppd.status', '>=', '10'], ['sppd.status', '<=', '15']])
            ->groupBy('pp.pp_no')->get()->sortByDesc('created_at');
        foreach ($pp_list as $pp) 
        {
            $pp->diff = 0;
            if ($pp->status == 0) {
                $diff = $today->diffindays($pp->tgl_pulang);
            }
            else if ($pp->status == 11 || $pp->status == 12 || $pp->status == 13) {
                $pp->diff = $today->diffindays($pp->pp_tgl_dibuat);
            }
            else if ($pp->status == 14) {
                $pp->diff = $today->diffindays($pp->pp_tgl_msk_finance);
            }
        }
        // dd($pp);
        return view('pp.index', compact('pp_list'));
    }

    public function detailPP($id)
    {
        $pp = pp::leftJoin('sppd', 'sppd.pp_no', '=', 'pp.pp_no')
        ->select('pp.*', 'sppd.status')
        ->where([['sppd.status', '>=', '10'], ['sppd.status', '<=', '15'], ['pp.id', '=', $id]])
        ->first();
        // dd($pp);

        $query = 'select
        DATEDIFF(sppd.tgl_pulang, sppd.tgl_berangkat)  as lama_perjalanan, 
        DATEDIFF(ipa.ipa_tgl_diajukan, ipa.ipa_tgl_dibuat)  as ipa_1, 
        DATEDIFF(ipa.ipa_tgl_approval, ipa.ipa_tgl_diajukan)  as ipa_2, 
        DATEDIFF(ipa.ipa_tgl_msk_finance, ipa.ipa_tgl_approval)  as ipa_3, 
        DATEDIFF(ipa.ipa_tgl_selesai, ipa.ipa_tgl_msk_finance)  as ipa_4, 
        DATEDIFF(ipa.ipa_tgl_selesai, ipa.ipa_tgl_dibuat)  as ipa,
        DATEDIFF(pp.pp_tgl_dibuat, ipa.ipa_tgl_selesai)  as ipa_pp, 
        DATEDIFF(pp.pp_tgl_diajukan, pp.pp_tgl_dibuat)  as pp_1, 
        DATEDIFF(pp.pp_tgl_approval, pp.pp_tgl_diajukan)  as pp_2, 
        DATEDIFF(pp.pp_tgl_msk_finance, pp.pp_tgl_approval)  as pp_3, 
        DATEDIFF(pp.pp_tgl_selesai, pp.pp_tgl_msk_finance)  as pp_4,
        DATEDIFF(curdate(), pp.pp_tgl_dibuat)  as pp,
        DATEDIFF(pp.pp_tgl_msk_finance, pp.pp_tgl_dibuat)  as pp_selesai
        from pp
        left join `sppd` on `sppd`.`pp_no` = `pp`.`pp_no`
        left join `ipa` on `sppd`.`ipa_no` = `ipa`.`ipa_no` 
        where pp.id=
        ' . $id;
        $progres = DB::select(DB::raw($query))[0];
        $tanggal=Carbon::today()->toDateString();
        // dd($pp);
        return view('pp.detail', compact('pp', 'progres', 'tanggal'));
    }

    public function create()
    {
        $ipa_list = IPA::select('ipa_no')->get();
        $pp_list = PP::select('pp_no')->get();
        return view('sppd.create', compact('ipa_list', 'pp_list'));
    }

    public function store(Request $request)
    {

        $sppd = new Sppd;
        $ipa = null;
        $pp = null;

        // dd($request);

        if (!$request->ipa_no || $request->ipa_no == '0'){
            $request->ipa_no == null;
        }
        else{
            $ipa = IPA::where('ipa_no', $request->ipa_no)->first();
            if ($ipa) {
                $request->ipa_no == $ipa->ipa_no;
            }
            else {
                $ipa = new Ipa;
            
                $ipa->ipa_no = $request->ipa_no;
                $ipa->ipa_status = '0';
                if ($request->ipa_tgl_dibuat) {
                    $ipa->ipa_tgl_dibuat = $request->ipa_tgl_dibuat;
                    $ipa->ipa_status = '1';
                }
                if ($request->ipa_tgl_diajukan) {
                    $ipa->ipa_tgl_diajukan = $request->ipa_tgl_diajukan;
                    $ipa->ipa_status = '2';
                }
                if ($request->ipa_tgl_dibuat) {
                    $ipa->ipa_tgl_approval = $request->ipa_tgl_approval;
                    $ipa->ipa_status = '3';
                }
                if ($request->ipa_tgl_msk_finance) {
                    $ipa->ipa_tgl_msk_finance = $request->ipa_tgl_msk_finance;
                    $ipa->ipa_status = '4';
                }
                if ($request->ipa_tgl_selesai) {
                    $ipa->ipa_tgl_selesai = $request->ipa_tgl_selesai;
                    $ipa->ipa_status = '10';
                }
                
                $ipa->ipa_nilai = $request->ipa_nilai;
                $ipa->sumber_dana = $request->sumber_dana;
                // dd($ipa);
                $simpan_ipa = $ipa->save();
                // if (!$simpan_ipa) {
                //     Session::flash('errors', ['' => 'Penambahan gagal! Silahkan ulangi beberapa saat lagi']);
                //     return redirect()->route('sppd.add');
                // }
            }
        }

        // if (!$request->ipa_no) { //case ipa baru dibuat
        //     $ipa = new Ipa;
            
        //     $ipa->ipa_no = $request->ipa_no;
        //     $ipa->ipa_status = '0';
        //     if ($request->ipa_tgl_dibuat) {
        //         $ipa->ipa_tgl_dibuat = $request->ipa_tgl_dibuat;
        //         $ipa->ipa_status = '1';
        //     }
        //     if ($request->ipa_tgl_diajukan) {
        //         $ipa->ipa_tgl_diajukan = $request->ipa_tgl_diajukan;
        //         $ipa->ipa_status = '2';
        //     }
        //     if ($request->ipa_tgl_dibuat) {
        //         $ipa->ipa_tgl_approval = $request->ipa_tgl_approval;
        //         $ipa->ipa_status = '3';
        //     }
        //     if ($request->ipa_tgl_msk_finance) {
        //         $ipa->ipa_tgl_msk_finance = $request->ipa_tgl_msk_finance;
        //         $ipa->ipa_status = '4';
        //     }
        //     if ($request->ipa_tgl_selesai) {
        //         $ipa->ipa_tgl_selesai = $request->ipa_tgl_selesai;
        //         $ipa->ipa_status = '10';
        //     }
            
        //     $ipa->ipa_nilai = $request->ipa_nilai;
        //     $ipa->sumber_dana = $request->sumber_dana;
        //     // dd($ipa);
        //     $simpan_ipa = $ipa->save();
        //     // if (!$simpan_ipa) {
        //     //     Session::flash('errors', ['' => 'Penambahan gagal! Silahkan ulangi beberapa saat lagi']);
        //     //     return redirect()->route('sppd.add');
        //     // }
            
        // }    
        // else {
        //     $ipa = IPA::where('ipa_no', $request->ipa_no)->first();
        // }   
        
        if (!$request->pp_no || $request->pp_no == '0'){
            $request->pp_no == null;
        }
        else{
            $pp = PP::where('pp_no', $request->pp_no)->first();
            if ($pp) {
                $request->pp_no == $pp->pp_no;
            }
            else {
                $pp = new Pp;
                
                $pp->pp_no = $request->pp_no;
                $pp->pp_status = '10';
                if ($request->pp_tgl_dibuat) {
                    $pp->pp_tgl_dibuat = $request->pp_tgl_dibuat;
                    $pp->pp_status = '11';
                }
                if ($request->pp_tgl_diajukan) {
                    $pp->pp_tgl_diajukan = $request->pp_tgl_diajukan;
                    $pp->pp_status = '12';
                }
                if ($request->pp_tgl_approval) {
                    $pp->pp_tgl_approval = $request->pp_tgl_approval;
                    $pp->pp_status = '13';
                }
                if ($request->pp_tgl_msk_finance) {
                    $pp->pp_tgl_msk_finance = $request->pp_tgl_msk_finance;
                    $pp->pp_status = '14';
                }
                if ($request->pp_tgl_selesai) {
                    $pp->pp_tgl_selesai = $request->pp_tgl_selesai;
                    $pp->pp_status = '15';
                }
                $simpan_pp = $pp->save();
            }
        }
        
        // if (!$request->pp_no) {//case pp baru dibuat
        //     $pp = new Pp;
            
        //     $pp->pp_no = $request->pp_no;
        //     $pp->pp_status = '10';
        //     if ($request->pp_tgl_dibuat) {
        //         $pp->pp_tgl_dibuat = $request->pp_tgl_dibuat;
        //         $pp->pp_status = '11';
        //     }
        //     if ($request->pp_tgl_diajukan) {
        //         $pp->pp_tgl_diajukan = $request->pp_tgl_diajukan;
        //         $pp->pp_status = '12';
        //     }
        //     if ($request->pp_tgl_approval) {
        //         $pp->pp_tgl_approval = $request->pp_tgl_approval;
        //         $pp->pp_status = '13';
        //     }
        //     if ($request->pp_tgl_msk_finance) {
        //         $pp->pp_tgl_msk_finance = $request->pp_tgl_msk_finance;
        //         $pp->pp_status = '14';
        //     }
        //     if ($request->pp_tgl_selesai) {
        //         $pp->pp_tgl_selesai = $request->pp_tgl_selesai;
        //         $pp->pp_status = '15';
        //     }
        //     $simpan_pp = $pp->save();
        //     // if (!$simpan_pp) {
        //     //     Session::flash('errors', ['' => 'Penambahan gagal! Silahkan ulangi beberapa saat lagi']);
        //     //     return redirect()->route('sppd.add');
        //     // }
        // }
        // else {
        //     $pp = PP::where('pp_no', $request->pp_no)->first();

        // }

        $sppd->sppd_no = $request->sppd_no;

        $sppd->ipa_no = (!$request->ipa_no || $request->ipa_no == '0') ? null : $request->ipa_no ;
        // $sppd->ipa_no = $request->ipa_no;
        $sppd->pp_no = (!$request->pp_no || $request->pp_no == '0') ? null : $request->pp_no ;
        // $sppd->pp_no = $request->pp_no;
        $sppd->sppd_tujuan = $request->sppd_tujuan;
        $sppd->sppd_alasan = $request->sppd_alasan;
        $sppd->tgl_berangkat = $request->tgl_berangkat;
        $sppd->tgl_pulang = $request->tgl_pulang;
        $sppd->sppd_tgl_msk = $request->sppd_tgl_msk;
        $sppd->unit_kerja = $request->unit_kerja;
        $sppd->status = '0';
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
        
        // dd($request);
        if (!$request->ipa_tgl_dibuat) { //case ipa baru dibuat
            $ipa = new IPA;
            
            $ipa->ipa_status = '0';
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
            $ipa->ipa_nilai = $request->ipa_nilai;
            $ipa->sumber_dana = $request->sumber_dana;
            $ipa->update();

        }    
        if (!$request->pp_tgl_dibuat) {//case pp baru dibuat
            $pp = new PP;

            $pp->pp_status = '10';
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

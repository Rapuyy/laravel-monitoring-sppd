<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sppd;
use Illuminate\Support\Facades\DB;
use Session;
use Illuminate\Support\Carbon;
use DataTables;

class SppdController extends Controller
{
    public function validateStatus($sppd) //dipake store sama update
    {
        //nanti kayanya mesti null nullan disini deh
        if ($sppd->sppd_no) { //ipa
            $sppd->status = 0;
            if ($sppd->ipa_tgl_dibuat && $sppd->ipa_no) {
                $sppd->status = 1;
                if ($sppd->ipa_tgl_diajukan) {
                    $sppd->status = 2;
                    if ($sppd->ipa_tgl_approval) {
                        $sppd->status = 3;
                        if ($sppd->ipa_tgl_selesai) {
                            $sppd->status = 4;
                            if ($sppd->pp_no) {
                                $sppd->status = 11; //pp
                                if ($sppd->pp_tgl_dibuat && $sppd->pp_no) {
                                    $sppd->status = 11;
                                    if ($sppd->pp_tgl_diajukan) {
                                        $sppd->status = 12;
                                        if ($sppd->pp_tgl_approval) {
                                            $sppd->status = 13;
                                            if ($sppd->pp_tgl_selesai) {
                                                $sppd->status = 14;
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
        $sppd->ipa_tgl_selesai = $request->ipa_tgl_selesai;
        $sppd->pp_no = $request->pp_no;
        $sppd->pp_tgl_dibuat = $request->pp_tgl_dibuat;
        $sppd->pp_tgl_approval = $request->pp_tgl_approval;
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
        $sppd->ipa_tgl_dibuat=$ipa_tgl_dibuat;
        $sppd->save();
        return redirect()->back();
    }

    public function diajukan($id){
        $sppd=Sppd::find($id);
        $sppd->status = "2";
        $ipa_tgl_diajukan=Carbon::today()->toDateString();
        $sppd->ipa_tgl_diajukan=$ipa_tgl_diajukan;
        $sppd->save();
        return redirect()->back();
    }

    public function disetujui($id){
        $sppd=Sppd::find($id);
        $sppd->status = "3";
        $ipa_tgl_approval=Carbon::today()->toDateString();
        $sppd->ipa_tgl_approval=$ipa_tgl_approval;
        $sppd->save();
        return redirect()->back();
    }

    public function finance($id){
        $sppd=Sppd::find($id);
        $sppd->status = "4";
        $ipa_tgl_msk_finance=Carbon::today()->toDateString();
        $sppd->ipa_tgl_msk_finance=$ipa_tgl_msk_finance;
        $sppd->save();
        return redirect()->back();
    }

    public function selesai($id){
        $sppd=Sppd::find($id);
        $sppd->status = "10";
        $ipa_tgl_selesai=Carbon::today()->toDateString();
        $sppd->ipa_tgl_selesai=$ipa_tgl_selesai;
        $sppd->save();
        return redirect()->back();
    }

    public function ppdibuat($id){
        $sppd=Sppd::find($id);
        $sppd->status = "11";
        $pp_tgl_dibuat=Carbon::today()->toDateString();
        $sppd->pp_tgl_dibuat=$pp_tgl_dibuat;
        $sppd->save();
        return redirect()->back();
    }

    public function ppdiajukan($id){
        $sppd=Sppd::find($id);
        $sppd->status = "12";
        $pp_tgl_diajukan=Carbon::today()->toDateString();
        $sppd->pp_tgl_diajukan=$pp_tgl_diajukan;
        $sppd->save();
        return redirect()->back();
    }

    public function ppdisetujui($id){
        $sppd=Sppd::find($id);
        $sppd->status = "13";
        $pp_tgl_approval=Carbon::today()->toDateString();
        $sppd->pp_tgl_approval=$pp_tgl_approval;
        $sppd->save();
        return redirect()->back();
    }

    public function ppfinance($id){
        $sppd=Sppd::find($id);
        $sppd->status = "14";
        $pp_tgl_msk_finance=Carbon::today()->toDateString();
        $sppd->pp_tgl_msk_finance=$pp_tgl_msk_finance;
        $sppd->save();
        return redirect()->back();
    }

    public function ppselesai($id){
        $sppd=Sppd::find($id);
        $sppd->status = "100";
        $pp_tgl_selesai=Carbon::today()->toDateString();
        $sppd->pp_tgl_selesai=$pp_tgl_selesai;
        $sppd->save();
        return redirect()->back();
    }

    public function index()
    { 
        $sppd_list = Sppd::select(DB::raw('DATEDIFF(ipa_tgl_selesai, ipa_tgl_dibuat) as ipa_time, 
                                    DATEDIFF(pp_tgl_selesai, pp_tgl_dibuat) as pp_time,
                                    id, sppd_no, ipa_no, pp_no, pegawai, sppd_tujuan, sppd_alasan, sppd_kendaraan, keterangan, 
                                    status, tgl_berangkat, tgl_pulang, ipa_tgl_dibuat, ipa_tgl_selesai,
                                    pp_tgl_dibuat'))
                    ->get();
        
        $day_status = DB::select( DB::raw("
                                SELECT green1.total as green1, green2.total as green2, yellow1.total as yellow1, yellow2.total as yellow2, red1.total as red1, red2.total as red2 
                                from 
                                (SELECT COUNT(*) as total FROM sppd WHERE DATEDIFF(ipa_tgl_selesai, ipa_tgl_dibuat) < 4) green1, 
                                (SELECT COUNT(*) as total FROM sppd WHERE DATEDIFF(pp_tgl_selesai, pp_tgl_dibuat) < 4) green2, 
                                (SELECT COUNT(*) as total FROM sppd WHERE DATEDIFF(ipa_tgl_selesai, ipa_tgl_dibuat) >= 4 and DATEDIFF(ipa_tgl_selesai, ipa_tgl_dibuat) < 10) yellow1, 
                                (SELECT COUNT(*) as total FROM sppd WHERE DATEDIFF(pp_tgl_selesai, pp_tgl_dibuat) >= 4 and DATEDIFF(pp_tgl_selesai, pp_tgl_dibuat) < 10) yellow2, 
                                (SELECT COUNT(*) as total FROM sppd WHERE DATEDIFF(ipa_tgl_selesai, ipa_tgl_dibuat) >= 10) red1, 
                                (SELECT COUNT(*) as total FROM sppd WHERE DATEDIFF(pp_tgl_selesai, pp_tgl_dibuat) >= 10) red2
                                "))[0];
        
        $today = Carbon::now()->format('Y-m-d');
        $today = Carbon::parse($today);
        return view('index', compact(['sppd_list', 'today', 'day_status']));
    }

    public function detilSPPD($id)
    {
        $sppd = Sppd::where('id', $id)->first();
        $progres = $sppd_list = Sppd::select(DB::raw('
                        DATEDIFF(ipa_tgl_diajukan, ipa_tgl_dibuat) + 1 as ipa_1, 
                        DATEDIFF(ipa_tgl_approval, ipa_tgl_diajukan) + 1 as ipa_2, 
                        DATEDIFF(ipa_tgl_msk_finance, ipa_tgl_approval) + 1 as ipa_3, 
                        DATEDIFF(ipa_tgl_selesai, ipa_tgl_msk_finance) + 1 as ipa_4, 
                        DATEDIFF(ipa_tgl_selesai, ipa_tgl_dibuat) + 1 as ipa, 
                        DATEDIFF(pp_tgl_diajukan, pp_tgl_dibuat) + 1 as pp_1, 
                        DATEDIFF(pp_tgl_approval, pp_tgl_diajukan) + 1 as pp_2, 
                        DATEDIFF(pp_tgl_msk_finance, pp_tgl_approval) + 1 as pp_3, 
                        DATEDIFF(pp_tgl_selesai, pp_tgl_msk_finance) + 1 as pp_4,
                        DATEDIFF(pp_tgl_selesai, pp_tgl_dibuat) + 1 as pp
                    '))
                    ->where('id', $id)->first();
                    
        $tanggal=Carbon::today()->toDateString();
        return view('detil', compact('sppd','tanggal', 'progres'));
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
        return view('create');
    }

    public function store(Request $request)
    {
        // $rules = [
        //     'name'                  => 'required|min:3|max:35',
        //     'email'                 => 'required|email|unique:users,email',
        //     'password'              => 'required|confirmed',
        //     'role_id'               => 'exists:App\Models\Role,id'
        //     'sppd_no'               =>
        //     'ipa_no'                =>
        //     'pp_no'                 =>
        //     'sppd_tujuan'           =>
        //     'sppd_alasan'           =>
        //     'sppd_kendaraan'        =>
        //     'tgl_berangkat'         =>
        //     'tgl_pulang'            =>
        //     'ipa_tgl_dibuat'        =>
        //     'ipa_tgl_approval'      =>
        //     'ipa_tgl_selesai'       =>
        //     'pp_tgl_dibuat'         =>
        //     'pp_tgl_approval'       =>
        //     'pp_tgl_selesai'        =>
        // ];
  
        // $messages = [
        //     'name.required'         => 'Nama Lengkap wajib diisi',
        //     'name.min'              => 'Nama lengkap minimal 3 karakter',
        //     'name.max'              => 'Nama lengkap maksimal 35 karakter',
        //     'email.required'        => 'Email wajib diisi',
        //     'email.email'           => 'Email tidak valid',
        //     'email.unique'          => 'Email sudah terdaftar',
        //     'password.required'     => 'Password wajib diisi',
        //     'password.confirmed'    => 'Password tidak sama dengan konfirmasi password',
        //     'role_id.exists'        => 'Role tidak sesuai'
        // ];

        // $validator = Validator::make($request->all(), $rules, $messages);

        // if($validator->fails()){
        //     return redirect()->back()->withErrors($validator)->withInput($request->all);
        // }

        $sppd = new Sppd;
        $sppd->sppd_no = $request->sppd_no;
        $sppd->pegawai = $request->pegawai;
        $sppd->sppd_tujuan = $request->sppd_tujuan;
        $sppd->sppd_kendaraan = $request->sppd_kendaraan;
        $sppd->sppd_alasan = $request->sppd_alasan;
        $sppd->tgl_berangkat = $request->tgl_berangkat;
        $sppd->tgl_pulang = $request->tgl_pulang;
        $sppd->ipa_no = $request->ipa_no;
        $sppd->ipa_tgl_dibuat = $request->ipa_tgl_dibuat;
        $sppd->ipa_tgl_approval = $request->ipa_tgl_approval;
        $sppd->ipa_tgl_selesai = $request->ipa_tgl_selesai;
        $sppd->pp_no = $request->pp_no;
        $sppd->pp_tgl_dibuat = $request->pp_tgl_dibuat;
        $sppd->pp_tgl_approval = $request->pp_tgl_approval;
        $sppd->pp_tgl_selesai = $request->pp_tgl_selesai;

        // dd($sppd);

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

    public function show($id)
    {
        //
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
        
        $sppd->sppd_no = $request->sppd_no;
        $sppd->pegawai = $request->pegawai;
        $sppd->sppd_tujuan = $request->sppd_tujuan;
        $sppd->sppd_kendaraan = $request->sppd_kendaraan;
        $sppd->sppd_alasan = $request->sppd_alasan;
        $sppd->tgl_berangkat = $request->tgl_berangkat;
        $sppd->tgl_pulang = $request->tgl_pulang;
        $sppd->ipa_no = $request->ipa_no;
        $sppd->ipa_tgl_dibuat = $request->ipa_tgl_dibuat;
        $sppd->ipa_tgl_approval = $request->ipa_tgl_approval;
        $sppd->ipa_tgl_selesai = $request->ipa_tgl_selesai;
        $sppd->pp_no = $request->pp_no;
        $sppd->pp_tgl_dibuat = $request->pp_tgl_dibuat;
        $sppd->pp_tgl_approval = $request->pp_tgl_approval;
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

    public function delete($id)
    {
        $deletedUser = Sppd::where('id', $id)->delete();
        return back()->with('success', 'User successfully deleted');
    }
}

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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
        $sppd_list = Sppd::select(DB::raw('DATEDIFF(ipa_tgl_selesai, ipa_tgl_dibuat) as ipa_time, 
                                    DATEDIFF(pp_tgl_selesai, pp_tgl_dibuat) as pp_time,
                                    id, sppd_no, ipa_no, pp_no, pegawai, sppd_tujuan, sppd_alasan, sppd_kendaraan, keterangan, 
                                    status, tgl_berangkat, tgl_pulang, ipa_tgl_dibuat, ipa_tgl_selesai,
                                    pp_tgl_dibuat'))
                    ->get();
        
        // $stat_counter = Sppd::select(DB::raw('DATEDIFF(ipa_tgl_selesai, ipa_tgl_dibuat) as ipa_time, 
        //                                         DATEDIFF(pp_tgl_selesai, pp_tgl_dibuat) as pp_time,
        //                                         sum(case 
        //                                         when ipa_time < 4 and pp_time < 4 then 2
        //                                         when ipa_time < 4 and pp_time >= 4 then 1
        //                                         when ipa_time >= 4 and pp_time < 4 then 1
        //                                         when ipa_time >= 4 and pp_time >= 4 then 0
        //                                         else 0 end) as count_green
        //                                     '))
        //             ->get();
        // DB::select( DB::raw("SELECT DATEDIFF(ipa_tgl_selesai, ipa_tgl_dibuat) as ipa_time, 
        //                             DATEDIFF(pp_tgl_selesai, pp_tgl_dibuat) as pp_time,
        //                             sum(case 
        //                                 when ipa_time < 4 and pp_time < 4 then 2
        //                                 when ipa_time < 4 and pp_time >= 4 then 1
        //                                 when ipa_time >= 4 and pp_time < 4 then 1
        //                                 when ipa_time >= 4 and pp_time >= 4 then 0
        //                                 else 0 end) as count_green
        //                      FROM sppd") );
        

        $today = Carbon::now()->format('Y-m-d');
        $today = Carbon::parse($today);
        // $date_diff = DB::select( DB::raw("SELECT DATEDIFF(ipa_tgl_dibuat, ipa_tgl_selesai) as ipa_time, DATEDIFF(pp_tgl_dibuat, pp_tgl_selesai) as pp_time FROM sppd") );
        // dd("2021-11-10"->diff($today));
        return view('index', compact(['sppd_list', 'today']));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function updateStatus($sppd) //dipake store sama update
    {
        if ($sppd->sppd_no) { //ipa
            $sppd->status = 0;
            if ($sppd->ipa_tgl_dibuat && $sppd->ipa_no) {
                $sppd->status = 1;
                if ($sppd->ipa_tgl_approval) {
                    $sppd->status = 2;
                    if ($sppd->ipa_tgl_selesai) {
                        $sppd->status = 3;
                        if ($sppd->pp_no) {
                            $sppd->status = 11; //pp
                            if ($sppd->pp_tgl_dibuat) {
                                $sppd->status = 11;
                                if ($sppd->pp_tgl_approval) {
                                    $sppd->status = 12;
                                    if ($sppd->pp_tgl_selesai) {
                                        $sppd->status = 13;
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


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sppd = Sppd::where('id', $id)->first();
        return view('edit', compact('sppd'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
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

        $sppd->status = $this->updateStatus($sppd);

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

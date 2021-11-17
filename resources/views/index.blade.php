@extends('layouts.main')

@section('container')

<div class="container">
            
            <!--Tabel-->
            <div class="row tabel-data">
                <div class="col-7 mt-4 table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th class="table-success"><a href="{{ route('sppd.filter', ['filter' => "green"]) }}">< 4 hari</a></th>
                                <th class="table-warning"><a href="{{ route('sppd.filter', ['filter' => "yellow"]) }}">4 - 10 hari</a></th>
                                <th class="table-danger"><a href="{{ route('sppd.filter', ['filter' => "red"]) }}">Lebih dari 10 hari</a></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="text-center">
                                <td>{{ $day_status->green }} proses</td>
                                <td>{{ $day_status->yellow }} proses</td>
                                <td>{{ $day_status->red }} proses</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <!--Button Opsi-->
            <div class="d-grid gap-2 d-md-block mt-2 mb-2">
                <a href="{{ route("sppd.add") }}" class="btn btn-primary" type="button">Tambah Ajuan SPPD</a>
                {{-- <button class="btn btn-secondary" type="button">Lihat Status Ajuan SPPD</button> --}}
            </div>

            <!--Tabel Data-->
            <div class="tabel-list mt-5 table-responsive">
                <table class="table table-bordered tab align-middle text-center cell-border" id="tablesppd">
                    <thead class="text-center">
                        <tr>
                            <th>Nomor</th>
                            <th>Nomor SPPD</th>
                            <th>PerihalPegawai</th>
                            <th>Pegawai</th>
                            <th>Status Sekarang</th>
                            <th>Aksi</th>
                        </tr>
                    </thead> 
                    
                    <tbody>
                    @foreach ($sppd_list as $sppd)  
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $sppd->sppd_no ? $sppd->sppd_no : "SPPD Belum diisi" }}</td>
                            <td>{{ $sppd->sppd_alasan }}</td>
                            <td>{{ $sppd->pegawai }}</td>
                            <td>
                                @if ($sppd->status == "0")
                                    {{ __('IPA Belum Dibuat') }}
                                @elseif ($sppd->status == "1")
                                    {{ __('IPA Belum Diajukan') }}
                                @elseif ($sppd->status == "2")
                                    {{ __('IPA Menunggu Tanda Tangan Approval') }}
                                @elseif ($sppd->status == "3")
                                    {{ __('IPA Menunggu Dikirim ke Divisi Finansial') }}
                                @elseif ($sppd->status == "4")
                                    {{ __('IPA Menunggu Kembali dari Divisi Finansial') }}    
                                @elseif ($sppd->status == "10")
                                    {{ __('IPA Sudah Selesai, PP Belum Dibuat') }}   
                                @elseif ($sppd->status == "11")
                                    {{ __('PP Belum Diajukan') }}
                                @elseif ($sppd->status == "12")
                                    {{ __('PP Menunggu Tanda Tangan Approval') }}
                                @elseif ($sppd->status == "13")
                                    {{ __('PP Menunggu Dikirim ke Divisi Finansial') }}  
                                @elseif ($sppd->status == "14")
                                    {{ __('PP Menunggu Kembali dari Divisi Finansial') }}   
                                @elseif ($sppd->status == "15")
                                    {{ __('PP Selesai') }}  
                                @endif
                            </td>
                            <td align="center">
                                <a href=" {{ route('sppd.detil', ['id' => $sppd->id]) }}" class="btn btn-info">Detail</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

@endsection
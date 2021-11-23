@extends('layouts.main')

@section('container')

        <div class="container">
            
            <!--Back Button-->
            <a href="/">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
            </svg>Kembali</a>

            <!--Button Opsi-->
            <div class="d-grid gap-2 d-md-block mt-2">
                <a href="{{ route("sppd.add") }}" class="btn btn-primary" type="button">Tambah Ajuan SPPD</a>
                {{-- <button class="btn btn-secondary" type="button">Lihat Status Ajuan SPPD</button> --}}
            </div>

            <!--Tabel Data-->
            <div class="tabel-list mt-3 table-responsive">
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
        @section('script')
        <script type="text/javascript" src="/js/script.js"></script>
        @endsection

@endsection
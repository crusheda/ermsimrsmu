@extends('layouts.index')

@section('content')
    <div class="page-header">
        <div class="page-block">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="fas fa-home"></i></a></li>
                        <li class="breadcrumb-item">Administrasi</li>
                        <li class="breadcrumb-item"><a href="{{ route('pengadaan.index') }}">Pengadaan</a></li>
                        <li class="breadcrumb-item" aria-current="page">Rekapitulasi</li>
                    </ul>
                </div>
                <div class="col-md-12">
                    <div class="page-header-title">
                        <h2 class="mb-0">Rekapitulasi <b class="text-primary">Pengadaan {{ $list['nama_kategori'] }}</b></h2>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- [ breadcrumb ] end -->

    <!-- [ Main Content ] start -->
    <div class="row pt-1">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between p-2">
                    <div class="btn-group">
                        <a href="javascript:void(0);" class="btn btn-link-primary" onclick="showRiwayat()" data-bs-toggle="tooltip"
                        data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Filter Rekap Pengadaan"><i class="fas fa-calendar-alt me-2"></i> Tampilkan Lainnya</a>
                    </div>
                    <div class="btn-group">
                        <a href="javascript:void(0);" class="btn btn-link-warning" onclick="refresh()" data-bs-toggle="tooltip"
                        data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Segarkan Tabel" id="btn-refresh"><i class="fas fa-sync me-2"></i> Refresh Tabel</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive" style="border: 0px" id="fresh-table">
                        <table id="tabelRekap" class="table table-display table-bordered">
                            <thead></thead>
                            <tbody><tr style='font-size:13px'><td colspan="9"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td></tr></tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- MULAI MODAL --}}
    <div class="modal fade" tabindex="-1" id="addKeranjang" role="dialog" data-bs-backdrop="static"
        aria-labelledby="orderdetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderdetailsModalLabel">Tambah ke keranjang</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input type="text" id="get_id_barang" class="form-control" hidden>
                        <div class="col-md-6" id="showBarangKeranjang"></div>
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label>Jumlah Permintaan <a class="text-danger">*</a></label>
                                <input type="text" id="jml_k" value="0" class="input-quantity form-control" width="100%">
                            </div>
                            <div class="form-group">
                                <label>Keterangan</label>
                                <textarea class="form-control" id="ket_k" rows="3" width="100%" placeholder="Optional"></textarea>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                            class="fa fa-times me-1"></i> Batal</button>
                    <button class="btn btn-info" onclick="masukKeranjang()"><i
                            class="ti ti-square-plus me-1"></i> Tambah</button>
                    <button class="btn btn-primary" onclick="showKeranjang()"><i
                            class="ti ti-shopping-cart-plus me-1 align-middle"></i> Lihat Keranjang</button>
                </div>
            </div>
        </div>
    </div>
    {{-- SELESAI MODAL --}}

    <script>
        $(document).ready(function() {
            refresh();
        })

        function refresh() {
            $('#btn-refresh').prop('disabled',true);
            $('#btn-refresh').find('i').addClass('fa-spin');
            $('#tabelRekap').empty().append(`<thead></thead><tbody><tr style='font-size:13px'><td colspan="9"><center><i class="fa fa-spinner fa-spin fa-fw"></i> Memproses data...</center></td></tr></tbody>`);
            $.ajax({
                url: "/api/rekap/{{ $list['bln'] }}/{{ $list['thn'] }}/{{ $list['kategori'] }}",
                type: 'GET',
                dataType: 'json',
                success: function(res) {
                    $('#tabelRekap').empty().append(`<thead></thead><tbody></tbody>`);
                    var tbody = $('#tabelRekap tbody');
                    var thead = $('#tabelRekap thead');
                    tbody.empty();
                    thead.empty();

                    // Inisialisasi penampung total per unit
                    var totalPerUnit = {};
                    res.units.forEach(function (unit) {
                        totalPerUnit[unit] = 0;
                    });

                    // Buat header dinamis
                    var head1 = '<tr><th rowspan="2">ID</th><th rowspan="2">Nama Barang</th>';
                    res.units.forEach(function (unit) {
                        head1 += '<th colspan="3">Unit ' + unit + '</th>';
                    });
                    head1 += '</tr>';

                    var head2 = '<tr>';
                    res.units.forEach(function (unit) {
                        head2 += '<th>Jumlah</th><th>Total</th><th>Keterangan</th>';
                    });
                    head2 += '</tr>';

                    thead.append(head1);
                    thead.append(head2);

                    // Buat tbody per barang
                    res.data.forEach(function (item) {
                        var row = '<tr>' +
                            '<td>' + item.id + '</td>' +
                            '<td>' + item.nama + '</td>';

                        res.units.forEach(function (unit) {
                            if (item.units && item.units[unit]) {
                                row += '<td>' + item.units[unit].jumlah + '</td>';
                                row += '<td>' + formatRupiah(item.units[unit].total) + '</td>';
                                row += '<td>' + item.units[unit].keterangan?item.units[unit].keterangan:'0' + '</td>';

                                // Tambahkan total per unit (pastikan angka)
                                totalPerUnit[unit] += parseFloat(item.units[unit].total);
                            } else {
                                row += '<td>0</td><td>0</td><td>-</td>';
                            }
                        });

                        row += '</tr>';
                        tbody.append(row);
                    });

                    // Buat baris total keseluruhan
                    var totalRow = '<tr style="font-weight:bold; background:#f8f8f8;">';
                    totalRow += '<td colspan="2" align="right">TOTAL KESELURUHAN</td>';

                    res.units.forEach(function (unit) {
                        totalRow += '<td></td>'; // kolom jumlah kosong
                        totalRow += '<td>' + formatRupiah(totalPerUnit[unit].toFixed(2)) + '</td>'; // total per unit
                        totalRow += '<td></td>'; // kolom keterangan kosong
                    });

                    totalRow += '</tr>';
                    tbody.append(totalRow);
                    $('#btn-refresh').prop('disabled',false);
                    $('#btn-refresh').find('i').removeClass('fa-spin');
                },
                error: function (xhr, status, error) {
                    console.log(error);
                    $('#btn-refresh').prop('disabled',false);
                    $('#btn-refresh').find('i').removeClass('fa-spin');
                }
            })
        }

        function formatRupiah(angka) {
            if (!angka || isNaN(angka)) return 'Rp 0 ,-';
            return 'Rp ' + parseFloat(angka).toFixed(0)
                .replace(/\B(?=(\d{3})+(?!\d))/g, ".") + ' ,-';
        }
    </script>
@endsection

@extends('layouts.default')

@section('content')
    <style>
        #myBtn {
            display: none;
            position: fixed;
            bottom: 20px;
            right: 30px;
            z-index: 99;
            font-size: 18px;
            border: none;
            outline: none;
            border-radius: 50%;
            color: white;
            cursor: pointer;
            /* padding: 15px; */
            border-radius: 4px;
        }
    </style>
    <button onclick="topFunction()" id="myBtn" class="bg-primary" title="Go to top" style="display: none"><h6 style="margin-top: 0.3rem;margin-bottom: 0.3rem;"><i class='bx bx-chevron-up align-middle'></i> Gulir ke atas</h6></button>
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Pengadaan</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex">
                        <div>
                            <h4 class="card-title mb-3">Digital Pengadaan</h4>
                            <p class="text-muted">Semua data terintegrasi menjadi satu dengan tampilan yang baru hanya di
                                Simrsmu</p>
                            <div>
                                <a href="javascript:void(0);" class="btn btn-primary btn-sm"><i class='bx bx-info-circle align-middle'></i> Baca Panduan</a>
                            </div>
                        </div>
                        <div>
                            <img src="{{ asset('images/jobs.png') }}" alt="" height="100">
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h4 class="card-title mb-4"><i class="bx bx-sort-down"></i> Riwayat Pengadaan</h4>
                        <div class="dropdown ms-2 dropend">
                            <a class="text-muted" href="#" role="button" data-bs-toggle="dropdown"
                                aria-haspopup="true" aria-expanded="false">
                                <i class="mdi mdi-dots-horizontal font-size-18"></i>
                            </a>

                            <div class="dropdown-menu dropdown-menu-end">
                                <a class="dropdown-item" href="#">Lihat Keranjang</a>
                                <a class="dropdown-item" href="#">Hapus Isi Keranjang</a>
                            </div>
                        </div>
                    </div>
                    <div data-simplebar style="max-height: 500px;">
                        <div class="table-responsive" style="border: 0px">
                            <table class="table table-nowrap align-middle table-hover mb-0">
                                <tbody id="tampil-tbody">
                                    <tr>
                                        <td colspan="9">
                                            <center><i class="fa fa-spinner fa-spin fa-fw"></i> Memuat data...</center>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-lg-9">

            <div class="row mb-3">
                <div class="col-xl-4 col-sm-6">
                    <div class="mt-2">
                        <h5><i class="bx bx-menu-alt-left"></i> Pembelanjaan</h5>
                    </div>
                </div>
                <div class="col-lg-8 col-sm-6">
                    <div class="mt-4 mt-sm-0 float-sm-end d-sm-flex align-items-center">
                        <div class="search-box me-2">
                            <div class="position-relative">
                                <input type="text" class="form-control border-0 typeahead" id="caribarang"
                                    autocomplete="off" placeholder="Cari Barang..." data-bs-toggle="tooltip"
                                    data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true"
                                    title="Tekan ENTER untuk Submit">
                                <i class="bx bx-search-alt search-icon"></i>
                            </div>
                        </div>
                        <ul class="nav nav-pills product-view-nav justify-content-end mt-3 mt-sm-0">
                            <li class="nav-item">
                                <button class="nav-link active" onclick="showKeranjang()" data-bs-toggle="tooltip"
                                    data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true"
                                    title="Tampilkan Keranjang"><i class="bx bx-cart align-middle"></i></button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link bg-warning text-white" onclick="refresh()" data-bs-toggle="tooltip"
                                    data-bs-offset="0,4" data-bs-placement="bottom" data-bs-html="true" title="Refresh"><i
                                        class="bx bx-sync align-middle"></i></button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row" id="daftar-barang">
                {{-- <div class="col-xl-3 col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="product-img position-relative">
                                <a class="image-popup-no-margins" href="{{ asset('images/no-img.png') }}"
                                    data-bs-toggle="tooltip" data-bs-offset="0,4" data-bs-placement="bottom"
                                    data-bs-html="true" title="Lihat Gambar">
                                    <img class="img-fluid mx-auto d-block " alt=""
                                        src="{{ asset('images/no-img.png') }}" width="150">
                                </a>
                            </div>
                            <div class="mt-4 text-center">
                                <h5 class="mb-3 text-truncate"><a href="javascript: void(0);" class="text-dark">Half sleeve
                                        T-shirt </a></h5>
                                <h5 class="my-0 mb-3"><span class="text-muted me-2"><del>$500</del></span> <b>$450</b></h5>
                                <a href="ecommerce-checkout.html" class="btn btn-outline-light btn-sm text-dark">
                                    <i class="mdi mdi-cart-arrow-right me-1"></i> Tambah keranjang </a>
                            </div>
                        </div>
                    </div>
                </div> --}}
            </div>
            <!-- end row -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="text-center mt-2 mb-5">
                        <a href="javascript:void(0);" class="text-dark" id="ajax-pending" style="display: none"><i
                                class="bx bx-caret-down font-size-18 align-middle me-2"></i> Gulir ke bawah untuk
                            melanjutkan <i class="bx bx-caret-down font-size-18 align-middle me-2"></i> </a>
                        <a href="javascript:void(0);" class="text-dark" id="ajax-loading"><i
                                class="bx bx-loader bx-spin font-size-18 align-middle me-2"></i> Memuat Data...</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- TAMPIL KERANJANG -->
    <div class="modal fade" tabindex="-1" id="keranjang" role="dialog" aria-labelledby="orderdetailsModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderdetailsModalLabel">Order Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="orderlist-overview">
                        <p class="mb-2">Product id: <span class="list-id text-primary">#SK2540</span></p>
                        <p class="mb-4">Billing Name: <span class="orderlist-customer text-primary">Neal Matthews</span>
                        </p>

                        <div class="table-responsive" style="border: 0px">
                            <table class="table align-middle table-nowrap">
                                <thead>
                                    <tr>
                                        <th scope="col">Product</th>
                                        <th scope="col">Product Name</th>
                                        <th scope="col">Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <th scope="row">
                                            <div>
                                                <img src="{{ asset('images/product/img-7.png') }}" alt=""
                                                    class="avatar-sm">
                                            </div>
                                        </th>
                                        <td>
                                            <div>
                                                <h5 class="text-truncate font-size-14">Wireless Headphone (Black)</h5>
                                                <p class="text-muted mb-0">$ 225 x 1</p>
                                            </div>
                                        </td>
                                        <td>$ 255</td>
                                    </tr>
                                    <tr>
                                        <th scope="row">
                                            <div>
                                                <img src="{{ asset('images/product/img-4.png') }}" alt=""
                                                    class="avatar-sm">
                                            </div>
                                        </th>
                                        <td>
                                            <div>
                                                <h5 class="text-truncate font-size-14">Hoodie (Blue)</h5>
                                                <p class="text-muted mb-0">$ 145 x 1</p>
                                            </div>
                                        </td>
                                        <td>$ 145</td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <h6 class="m-0 text-right">Sub Total:</h6>
                                        </td>
                                        <td>
                                            $ 400
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <h6 class="m-0 text-right">Shipping:</h6>
                                        </td>
                                        <td>
                                            Free
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2">
                                            <h6 class="m-0 text-right">Total:</h6>
                                        </td>
                                        <td>
                                            $ 400
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- TAMPIL RIWAYAT PER PENGADAAN -->
    <div class="modal fade" tabindex="-1" id="riwayat" role="dialog" aria-labelledby="orderdetailsModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="orderdetailsModalLabel">Riwayat Pengadaan <span class="badge bg-primary" id="show_id"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div id="orderlist-overview">
                        <p class="mb-2">Nama : <span class="list-id text-primary" id="nama_r"></span></p>
                        <p class="mb-2">Unit : <span class="list-id text-primary" id="unit_r"></span></p>
                        <p class="mb-4">Tanggal : <span class="orderlist-customer text-primary" id="tgl_r"></span>
                        </p>

                        <div class="table-responsive" style="border: 0px">
                            <table class="table align-middle table-hover table-nowrap">
                                <thead>
                                    <tr>
                                        <th scope="col">Gambar</th>
                                        <th scope="col">Barang</th>
                                        <th scope="col">Harga</th>
                                    </tr>
                                </thead>
                                <tbody id="tampil-riwayat">
                                    <tr>
                                        <td colspan="9">
                                            <center><i class="fa fa-spinner fa-spin fa-fw"></i> Memuat data...</center>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function() {
            // When the user scrolls down 20px from the top of the document, show the button
            window.onscroll = function() {
                scrollFunction()
            };

            $.ajax({
                url: "/api/pengadaan/data/{{ Auth::user()->id }}",
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    // Tampil Result setelah Selesai Laporan
                    $("#tampil-tbody").empty();
                    res.pengadaan.forEach(item => {
                        content = `<tr id="pengadaan` + item.id + `">
                                    <td style="width: 50px;">
                                        <span class="badge bg-primary">ID : ` + item.id + `</span>
                                    </td>
                                    <td>
                                        <h5 class="text-truncate font-size-14 mb-1"><a href="javascript: void(0);"
                                                class="text-dark">` + formatRupiah(item.total, 'Rp ') + ` ,-</a></h5>
                                        <p class="text-muted mb-0">` + item.tgl_pengadaan + `</p>
                                    </td>
                                    <td style="width: 90px;">
                                        <div>
                                            <ul class="list-inline mb-0 font-size-16">
                                                <li class="list-inline-item">
                                                    <a href="javascript: void(0);" onclick="showRiwayat(`+item.id+`)" class="text-primary p-1"><i
                                                            class="bx bx-shopping-bag"></i></a>
                                                </li>
                                                <li class="list-inline-item">
                                                    <a href="javascript: void(0);" class="text-danger p-1"><i
                                                            class="bx bxs-trash"></i></a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>`;
                        $('#tampil-tbody').append(content);
                    })
                }
            });

            // AUTOCOMPLETE CARI BARANG
            // var path = "{{ route('pengadaan.getacbarang') }}";
            // $('.typeahead').typeahead({
            //     source: function(query, process) {
            //         return $.get(path, {
            //             barang: query
            //         }, function(data) {
            //             return process(data);
            //         });
            //     }
            // });

            // var site_url = "{{ url('/') }}";
            var page = 1;
            var pagecari = 1;

            $('#ajax-loading').show();
            load_more(page);

            // AUTO SHOW CARI BARANG
            $("#caribarang").keyup(function() {
                var val_barang = $("#caribarang").val();
                if (val_barang.length === 0) {
                    page = 1;
                    load_more(page);
                }
            });
            $("#caribarang").on('keypress', function(e) {
                if (e.which == 13) {
                    var val_barang = $("#caribarang").val();
                    $('#ajax-pending').hide();
                    $('#ajax-loading').show();
                    pagecari = 1;
                    load_more_cari(val_barang, pagecari);
                }
            });

            $(window).scroll(function() {
                if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
                    $('#ajax-pending').hide();
                    $('#ajax-loading').show();
                    var val_barang = $("#caribarang").val();
                    if (val_barang.length === 0) {
                        page++;
                        load_more(page);
                    } else {
                        pagecari++;
                        load_more_cari(val_barang, pagecari);
                    }
                }
            });

        })

        // FUNCTION AREA
        function refresh() {
            load_more(1);
            $("#caribarang").val('');
            iziToast.success({
                title: 'Pesan Sukses!',
                message: 'Daftar Barang Pembelanjaan berhasil disegarkan',
                position: 'topRight'
            });
        }

        function showKeranjang() {
            $('#keranjang').modal('show');
        }

        function showRiwayat(id) {
            $.ajax({
                url: "/api/pengadaan/riwayat/"+id,
                type: 'GET',
                dataType: 'json', // added data type
                success: function(res) {
                    // Tampil Result setelah Selesai Laporan
                    $("#tampil-riwayat").empty();
                    // $("#total_r").empty();
                    res.detail.forEach(item => {
                        content =   `<tr>
                                        <th scope="row">
                                            <div>
                                                <img src="{{ asset('images/no-img.png') }}" alt=""
                                                    class="avatar-sm">
                                            </div>
                                        </th>
                                        <td>
                                            <div>
                                                <h5 class="text-truncate font-size-14">`+item.nama_barang+`</h5>
                                                <p class="text-muted mb-0">` + formatRupiah(item.harga, 'Rp ') + ` x `+item.jumlah+`</p>
                                            </div>
                                        </td>
                                        <td>` + formatRupiah(item.total, 'Rp ') + `</td>
                                    </tr>`;
                        $('#tampil-riwayat').append(content);
                    })
                    content_total = `<tr>
                                        <td colspan="2">
                                            <h6 class="m-0 text-right">Total:</h6>
                                        </td>
                                        <td><b>`+formatRupiah(res.pengadaan.total, 'Rp ')+`</b></td>
                                    </tr>`;
                    $('#tampil-riwayat').append(content_total);
                    $("#show_id").text("#"+res.pengadaan.id_pengadaan);
                    $("#nama_r").text(res.pengadaan.nama_user);
                    $("#unit_r").text(res.pengadaan.unit.replace('["', '').replace('"]', '').replace('","', ','));
                    $("#tgl_r").text(res.pengadaan.tgl_pengadaan);
                }
            });
            $('#riwayat').modal('show');
        }

        function scrollFunction() {
            // Get the button
            if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
                $('#myBtn').show();
            } else {
                $('#myBtn').hide();
            }
        }

        // When the user clicks on the button, scroll to the top of the document
        function topFunction() {
            document.body.scrollTop = 0;
            document.documentElement.scrollTop = 0;
        }

        /* Fungsi formatRupiah */
        function formatRupiah(angka, prefix) {
            var number_string = angka.toString(),
                split = number_string.split(','),
                sisa = split[0].length % 3,
                rupiah = split[0].substr(0, sisa),
                ribuan = split[0].substr(sisa).match(/\d{3}/gi);

            // tambahkan titik jika yang di input sudah menjadi angka ribuan
            if (ribuan) {
                separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
            return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
        }

        function load_more(page) {
            if (page === 1) {
                $("#daftar-barang").empty();
            }
            $.ajax({
                url: "/api/pengadaan/barang?page=" + page,
                type: "get",
                datatype: "html",
                beforeSend: function() {
                    $('#ajax-pending').hide();
                    $('#ajax-loading').show();
                }
            }).done(function(res) {
                if (res.data.length === 0) {
                    $('#ajax-pending').hide();
                    $('#ajax-loading').empty();
                    $('#ajax-loading').append("<center>Seluruh Barang ditampilkan</center>");
                    return;
                } else {
                    res.data.forEach(item => {
                        content =
                            `<div class="col-xl-3 col-sm-6">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="product-img position-relative">
                                                <img class="img-fluid mx-auto d-block " alt=""
                                                    src="{{ asset('images/no-img.png') }}" width="150">
                                            </div>
                                            <div class="mt-4 text-center">
                                                <h6 class="mb-3"><a href="javascript: void(0);" class="text-dark">` +
                            item.nama + `</a></h6>
                                                <h5 class="my-0 mb-3"><b class="text-success">` + formatRupiah(item
                                .harga, 'Rp ') + `</b> <span class="text-muted me-2">/ ` + item.satuan + `</span></h5>
                                                <a href="javascript:void(0);" onclick="masukKeranjang(` + item.id + `)" class="btn btn-outline-light btn-sm text-dark">
                                                    <i class="mdi mdi-cart-arrow-right me-1"></i> Masukkan keranjang </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>`;
                        $("#daftar-barang").append(content);
                    })
                    $('#ajax-pending').show();
                }
                $('#ajax-loading').hide();
            }).fail(function(jqXHR, ajaxOptions, thrownError) {
                alert('No response from server');
            });
        }

        function load_more_cari(barang, page) {
            if (page === 1) {
                $("#daftar-barang").empty();
            }
            setTimeout(function() {
                var val_barang = $("#caribarang").val();
                $.ajax({
                        url: "/api/pengadaan/caribarang?barang=" + val_barang + "&page=" + page,
                        type: "get",
                        datatype: "html",
                        beforeSend: function() {
                            $('#ajax-pending').hide();
                            $('#ajax-loading').show();
                        }
                    })
                    .done(function(res) {
                        if (res.data.length == 0) {
                            $('#ajax-pending').hide();
                            $('#ajax-loading').empty();
                            $('#ajax-loading').append("<center>Seluruh Barang ditampilkan</center>");
                            return;
                        } else {
                            res.data.forEach(item => {
                                content =
                                    `<div class="col-xl-3 col-sm-6">
                                            <div class="card">
                                                <div class="card-body">
                                                    <div class="product-img position-relative">
                                                        <img class="img-fluid mx-auto d-block " alt=""
                                                            src="{{ asset('images/no-img.png') }}" width="150">
                                                    </div>
                                                    <div class="mt-4 text-center">
                                                        <h6 class="mb-3"><a href="javascript: void(0);" class="text-dark">` +
                                    item.nama + `</a></h6>
                                                        <h5 class="my-0 mb-3"><b class="text-success">` + formatRupiah(
                                        item.harga, 'Rp ') + `</b> <span class="text-muted me-2">/ ` +
                                    item.satuan + `</span></h5>
                                                        <a href="javascript:void(0);" onclick="masukKeranjang(` + item
                                    .id + `)" class="btn btn-outline-light btn-sm text-dark">
                                                            <i class="mdi mdi-cart-arrow-right me-1"></i> Masukkan keranjang </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>`;
                                $("#daftar-barang").append(content);
                            })
                            $('#ajax-pending').show();
                        }
                        $('#ajax-loading').hide();
                    })
                    .fail(function(jqXHR, ajaxOptions, thrownError) {
                        alert('No response from server');
                    });
            }, 1000);
        }
    </script>
@endsection

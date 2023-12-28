@extends('layouts.default')

@section('content')
    <!-- start page title -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                <h4 class="mb-sm-0 font-size-18">Blank Page</h4>
            </div>
        </div>
    </div>

    <div class="card">
        <div id="reader" width="600px"></div>
    </div>
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <script>
        $(document).ready(function() {

        })
        function onScanSuccess(decodedText, decodedResult) {
            // handle the scanned code as you like, for example:
            // console.log(`Code matched = ${decodedText}`, decodedResult);
            iziToast.success({
                title: 'Sukses!',
                message: 'QR-Code : '+ decodedText +' - '+ decodedResult,
                position: 'topRight'
            });
            html5QrcodeScanner.stop().then((ignore) => {
                // QR Code scanning is stopped.
            }).catch((err) => {
                // Stop failed, handle it.
            });
        }

        function onScanFailure(error) {
            // handle scan failure, usually better to ignore and keep scanning.
            // for example:
            // console.warn(`Code scan error = ${error}`);
            iziToast.error({
                title: 'Pesan Galat!',
                message: error,
                position: 'topRight'
            });
            html5QrcodeScanner.stop().then((ignore) => {
                // QR Code scanning is stopped.
            }).catch((err) => {
                // Stop failed, handle it.
            });
        }
        const formatsToSupport = [
            Html5QrcodeSupportedFormats.QR_CODE,
            // Html5QrcodeSupportedFormats.UPC_A,
        ];
        let config = {
            fps: 10,
            qrbox: {width: 100, height: 100},
            rememberLastUsedCamera: true,
            // Only support camera scan type.
            supportedScanTypes: [Html5QrcodeScanType.SCAN_TYPE_CAMERA],
            formatsToSupport: formatsToSupport
        };
        let html5QrcodeScanner = new Html5QrcodeScanner("reader", config, /* verbose= */ false);
        html5QrcodeScanner.render(onScanSuccess, onScanFailure);
    </script>
@endsection

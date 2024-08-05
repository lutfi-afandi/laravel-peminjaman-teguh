@extends('layouts.tabler-admin.master')
@section('sub-breadcrumb', 'Scan Qr Code')
@section('content')

    <h1>Scan QR Code</h1>
    <div id="reader" width="300px"></div>

    <!-- Load HTML5 QR Code Scanner library dengan defer -->
    <script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
    <script>
        function onScanSuccess(decodedText, decodedResult) {
            // handle the scanned code as you like
            console.log(`Code matched = ${decodedText}`, decodedResult);

            // Buka URL dari isi QR code di tab baru
            window.open(decodedText, '_blank');
        }

        function onScanFailure(error) {
            // handle scan failure, usually better to ignore and keep scanning
            console.warn(`Code scan error = ${error}`);
        }

        let html5QrcodeScanner = new Html5QrcodeScanner(
            "reader", {
                fps: 10,
                qrbox: {
                    width: 350,
                    height: 350
                }
            },
            false
        );
        html5QrcodeScanner.render(onScanSuccess, onScanFailure);
    </script>

@endsection

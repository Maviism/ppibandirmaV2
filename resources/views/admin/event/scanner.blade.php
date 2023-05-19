@extends('adminlte::page')

@section('title', 'Absensi')

@section('content_header')
    <h1>Absensi</h1>
@stop

@section('content')

<button type="button" class="btn bg-purple text-default mx-1 shadow mb-1" data-toggle="modal" data-target="#manualAbsensi">
    <i class="fa fa-lg fa-fw fa-user-check"></i>Absensi manual
</button>

<x-adminlte-modal id="manualAbsensi" title="Absensi scanner" theme="purple" icon="fas fa-user-check" size='lg' v-centered>
    <select name="" id="camera-select"></select>
    <div class="row justify-content-center">
        <div id="qr-code-scanner" style="width: 500px;"></div>
    </div>
    <x-slot name="footerSlot">
        <x-adminlte-button id="stop-scan-button" theme="danger" label="close" data-dismiss="modal"/>
    </x-slot>
</x-adminlte-modal>

@stop
@section('css')
@stop
@section('js')
<script src="/vendor/html5-qrcode/html5-qrcode.min.js"></script>

<script>
function onScanSuccess(decodedText, decodedResult) {
    // Handle on success condition with the decoded text or result.
    console.log(`Scan result: ${decodedText}`, decodedResult);
    const userId = decodedText; // Replace with the actual user ID
    const eventId = {{ $event->id }}; // Use the decoded text as the event ID

    var token = $('meta[name="csrf-token"]').attr('content');
    $.ajax({
            url: `/admin/absensi/user/${userId}`,
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': token
            },
            data: {
                iEventId: eventId // include the value in the data parameter
            },
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Absen Berhasil',
                    text: response.message,
                    timer: 4000, // Timer set to 2 seconds (2000 milliseconds)
                    timerProgressBar: true,
                })
            },
            error: function(response) {
                Swal.fire({
                    icon: 'error',
                    title: 'Absen Gagal',
                    text: response.responseJSON.message,
                    timer: 4000, // Timer set to 2 seconds (2000 milliseconds)
                    timerProgressBar: true,
                });
            }
    });

    // Add a 1-second delay before executing the next line of code
    setTimeout(function() {
        // Code to be executed after the delay
        console.log("Delay completed");
    }, 1000);
}

let html5QrCode;
// Get the list of available cameras
Html5Qrcode.getCameras().then(devices => {
// Display the list of cameras as options for the user to choose from
    devices.forEach((device, index) => {
        const option = document.createElement('option');
        option.value = device.id;
        option.text = device.label || `Camera ${index + 1}`;
        document.getElementById('camera-select').appendChild(option);
    });

// Start scanning when the user selects a camera
    document.getElementById('camera-select').addEventListener('change', function(event) {
        const selectedCameraId = event.target.value;

        // Create a new instance of Html5Qrcode
        html5QrCode = new Html5Qrcode("qr-code-scanner");
        
        // Start scanning with the selected camera
        html5QrCode.start(
            selectedCameraId, 
            {
                fps: 10,    // Optional, frame per seconds for qr code scanning
                formatsToSupport: [ Html5QrcodeSupportedFormats.QR_CODE ]
                //   qrbox: { width: 250, height: 250 }  // Optional, if you want bounded box UI
            },
            onScanSuccess,
            (errorMessage) => {
            // Handle the error message
            }
        )
        .catch((err) => {
    // Handle the start scanning failure
        });
    });
})
.catch(err => {
// Handle the error when getting the list of cameras
});

document.getElementById('stop-scan-button').addEventListener('click', function() {
    if (html5QrCode) {
        console.log('hello');
        html5QrCode.stop().then(() => {
      // Scanning stopped successfully
      
    }).catch((err) => {
      // Handle the stop scanning failure
    });
  }
});
      
    
</script>


@stop

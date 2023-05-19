@extends('adminlte::page')

@section('title', 'Absensi')

@section('content_header')
    <h1>Absensi {{$event->title}}</h1>
@stop

@section('content')
    <a href="/admin/event" class="btn btn-info mb-1"><i class="fa fa-lg fa-chevron-left mr-1"></i>Kembali</a>
    <div class="my-1">
        <x-adminlte-button label="Absensi Scanner" data-toggle="modal" icon="fa fa-lg fa-fw fa-user-check" data-target="#scannerAbsensi" class="bg-purple"/>
        <x-adminlte-button label="Absensi Manual" data-toggle="modal" icon="fa fa-lg fa-fw fa-user-check" data-target="#manualAbsensi" class="bg-pink"/>
    </div>
    <x-adminlte-modal id="manualAbsensi" title="Absensi manual" theme="purple" icon="fas fa-user-check" size='lg'>
        <x-adminlte-datatable id="table1" :heads="[
                'Name',
                ['label' => 'Angkatan', 'width' => 5],
                ['label' => 'Actions', 'no-export' => true, 'width' => 1],
            ]" hoverable bordered compressed>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->role }}</td>
                    <td style="white-space: nowrap;">
                        <form class="form-hadir" action="{{ route('absensi.store', $user->id) }}" method="POST">
                            @csrf
                            <input type="text" name="iEventId" value="{{$event->id}}" hidden>
                            <button type="submit" class="btn btn-xs btn-success shadow">
                                Hadir
                                <i class="fa fa-lg fa-fw fa-check-circle"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </x-adminlte-datatable>
    </x-adminlte-modal>
    <x-adminlte-modal id="scannerAbsensi" title="Absensi scanner" theme="purple" icon="fas fa-user-check" size='lg' v-centered>
        <select name="" id="camera-select"></select>
        <div class="row justify-content-center">
            <div id="qr-code-scanner" style="width: 500px;"></div>
        </div>
        <x-slot name="footerSlot">
            <x-adminlte-button id="stop-scan-button" theme="danger" label="close" data-dismiss="modal"/>
        </x-slot>
    </x-adminlte-modal>
    <x-adminlte-datatable id="tAbsensi" :heads="[
            ['label' => 'No', 'width'=> 2 ],
            'Name',
            'Datetime',
            'Angkatan',
            ['label' => 'Actions', 'no-export' => true, 'width' => 5],
        ]" head-theme="dark" striped hoverable bordered compressed with-buttons>
        @foreach($registeredUsers as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $user->user->name }}</td>
                    <td>{{ $user->updated_at }}</td>
                    <td>{{ $user->user->education->arrival_year }}</td>
                    <td style="white-space: nowrap;">
                    <form action="{{ route('absensi.destroy', $user->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                        <input type="text" name="iEventId" value="{{$event->id}}" hidden>
                        <button type="submit" class="btn btn-xs btn-danger shadow">
                            <i class="fa fa-lg fa-fw fa-trash"></i>
                        </button>
                    </form>
                    </td>
                    
                </tr>
        @endforeach
    </x-adminlte-datatable>
@stop

@section('css')
@stop

@section('js')
<script src="/vendor/html5-qrcode/html5-qrcode.min.js"></script>
<script>
    $('.form-hadir').submit(function(event) {
        event.preventDefault();
        var form = $(this);
        var url = form.attr('action');
        var method = form.attr('method');
        var token = $('meta[name="csrf-token"]').attr('content');
        var iEventId = $('input[name="iEventId"]').val();

        $.ajax({
            url: url,
            method: method,
            headers: {
                'X-CSRF-TOKEN': token
            },
            data: {
                iEventId: iEventId // include the value in the data parameter
            },
            success: function(response) {
                Swal.fire({
                    icon: 'success',
                    title: 'Absen Berhasil',
                    text: response.message,
                    // timer: 2000
                })
            },
            error: function(response) {
                Swal.fire({
                    icon: 'error',
                    title: 'Absen Gagal',
                    text: response.responseJSON.message,
                    // timer: 2000
                });
            }
        });
    });


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
        html5QrCode.stop().then(() => {
      // Scanning stopped successfully
    }).catch((err) => {
      // Handle the stop scanning failure
    });
  }
});
</script>
@stop
@extends('layouts.default')

@section('content')
<main id="main" class="main">

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QR Code Registration & Attendance</title>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">

    <h1 class="text-center">QR Code Registration & Attendance</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="card p-3 mt-3">
        <h2>Register and Get Your QR Code</h2>
        <form action="{{ route('register_qr') }}" method="POST">
            @csrf
            <div class="mb-2">
                <label class="form-label">Name:</label>
                <input type="text" name="name" class="form-control" required>
            </div>
            
            <div class="mb-2">
                <label class="form-label">Age:</label>
                <input type="number" name="age" class="form-control" required>
            </div>

            <div class="mb-2">
                <label class="form-label">School:</label>
                <input type="text" name="school" class="form-control" required>
            </div>

            <div class="mb-2">
                <label class="form-label">Course:</label>
                <input type="text" name="course" class="form-control" required>
            </div>

            <div class="mb-2">
                <label class="form-label">Program:</label>
                <input type="text" name="program" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-success">Generate QR Code</button>
        </form>
    </div>

    <hr>

    <h2 class="mt-3">Generated QR Codes</h2>
    <div class="row">
        @foreach($ojts as $ojt)
            @if($ojt->qr_code)
                <div class="col-md-4 text-center">
                    <h5>{{ $ojt->name }}</h5>
                    {!! QrCode::size(200)->generate(base64_decode($ojt->qr_code)) !!}
                    <p>Scan this QR code for attendance.</p>
                </div>
            @endif
        @endforeach
    </div>

    <hr>

    <div class="card p-3 mt-3">
        <h2>Scan QR Code for Attendance</h2>
        <video id="preview" class="w-100 border rounded shadow"></video>

        <p id="scan-result" class="text-center fw-bold mt-2"></p>

        <h3 class="mt-3">Attendance Records</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Age</th>
                    <th>School</th>
                    <th>Course</th>
                    <th>Program</th>
                    <th>Attendance Time</th>
                </tr>
            </thead>
            <tbody id="attendance-table">
                <tr>
                    <td colspan="6" class="text-center">No attendance recorded yet.</td>
                </tr>
            </tbody>
        </table>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            let scanner = new Instascan.Scanner({ video: document.getElementById('preview') });

            scanner.addListener('scan', function (qrData) {
                fetch("{{ route('scan_qr') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({ qr_data: qrData })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        let newRow = `
                            <tr>
                                <td>${data.data.name}</td>
                                <td>${data.data.age}</td>
                                <td>${data.data.school}</td>
                                <td>${data.data.course}</td>
                                <td>${data.data.program}</td>
                                <td>${data.data.attendance_time}</td>
                            </tr>
                        `;
                        document.getElementById('attendance-table').innerHTML += newRow;
                        document.getElementById('scan-result').innerHTML = `<span class="text-success">Attendance recorded for ${data.data.name} at ${data.data.attendance_time}</span>`;
                    } else {
                        document.getElementById('scan-result').innerHTML = `<span class="text-danger">${data.error}</span>`;
                    }
                })
                .catch(error => console.error("Error:", error));
            });

            Instascan.Camera.getCameras().then(function (cameras) {
                if (cameras.length > 0) {
                    scanner.start(cameras[0]); 
                } else {
                    alert("No cameras found.");
                }
            }).catch(function (e) {
                console.error(e);
            });
        });
    </script>

</body>
</html>

</main>
@endsection

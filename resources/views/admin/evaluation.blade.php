@extends('layouts.default')

@section('content')


<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
<link href="{{asset('assets/css/evaluation.css')}}" rel="stylesheet">



<main id="main" class="main">
<div class="container d-flex justify-content-center mt-4">
 
    
    <div class="glass-card p-4 w-75" id="evaluationForm">
        <div class="d-flex justify-content-end mt-4">
          
        </div>
        <div class="header-box mb-4 border p-3 text-center">
            <div class="d-flex align-items-center justify-content-between border p-2">
                <img src="img/department-health.png" alt="Department of Health" class="header-logo">
                <div class="text-center flex-grow-1">
                    <h3 class="mb-0 text-uppercase fw-bold">Republic of the Philippines</h3>
                    <h4 class="mb-0 text-uppercase">Department of Health</h4>
                    <h2 class="fw-bold mb-0 text-uppercase" style="color: #766f6f;">Southern Isabela Medical Center</h2>
                    <div class="border-top border-bottom mt-2 py-1">
                        <h3 class="fw-bold text-uppercase">Student Trainee Evaluation and Endorsement</h3>
                    </div>
                </div>
                <img src="img/logo.png" alt="Medical Center Logo" class="header-logo">
            </div>
        </div>
        
        
        <!-- Student Trainee Profile -->
        <h4 class="text-primary text-center">Student Trainee Profile</h4>
        <div class="row">
            <div class="col-md-6 form-group">
                <label>Name:</label>
                <input type="text" class="form-control">
            </div>
            <div class="col-md-6 form-group">
                <label>Name of School:</label>
                <input type="text" class="form-control">
            </div>
        </div>
        <div class="row">
            <div class="col-md-4 form-group">
                <label>Total Number of Hours:</label>
                <input type="text" class="form-control">
            </div>
            <div class="col-md-4 form-group">
                <label>Date Started:</label>
                <input type="date" class="form-control">
            </div>
            <div class="col-md-4 form-group">
                <label>Date Ended:</label>
                <input type="date" class="form-control">
            </div>
        </div>
        
        <!-- Evaluation Table -->
        <h4 class="text-primary text-center mt-4">Student Trainee Evaluation</h4>
        <table id="evaluationTable" class="table table-bordered text-center">
            <thead>
                <tr>
                    <th>Parameters</th>
                    <th>E</th>
                    <th>VS</th>
                    <th>S</th>
                    <th>G</th>
                    <th>P</th>
                    <th>Remarks</th>
                </tr>
            </thead>
            <tbody>
                @foreach (['Work Attitudes and Habits', 'Work Knowledge', 'Personality and Personal Appearance', 'Professional Competence', 'Overall Rating'] as $parameter)
                <tr>
                    <td>{{ $parameter }}</td>
                    @for ($i = 0; $i < 5; $i++)
                        <td><input type="checkbox"></td>
                    @endfor
                    <td><input type="text" class="form-control"></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <p class="text-muted text-center mt-2">
            <strong>Adjective Rating:</strong> E – Excellent (100 – 95), VS – Very Satisfactory (94 – 90), S – Satisfactory (89 – 85), G – Good (84 – 80), P – Poor (79 below)
        </p>
        
        <!-- Comments -->
        <h4 class="text-primary text-center mt-4">Comments and Recommendations</h4>
        <div class="form-group">
            <textarea class="form-control" rows="4"></textarea>
        </div>
        
        <!-- Signature Section -->
        <h4 class="text-primary text-center mt-4">Evaluator’s Signature</h4>
        <div class="row signature">
            <div class="col-md-6 form-group">
                <label>Signature over Printed Name of Evaluator:</label>
                <input type="text" class="form-control">
            </div>
            <div class="col-md-6 form-group">
                <label>Date:</label>
                <input type="date" class="form-control">
            </div>
        </div>
     
    </div>
    <div class="d-flex justify-content-end mt-4">
        <button class="btn btn-success me-2" id="exportPdf">Generate Report PDF</button>
       <a class="btn btn-success" href="{{url('/uploadpage')}}">upload</a>
        
    </div>
  
    
    
</div>
</main>
<!-- Include Required Libraries -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/mammoth/1.4.2/mammoth.browser.min.js"></script>

<script>
    document.getElementById("exportPdf").addEventListener("click", function() {
        const { jsPDF } = window.jspdf;
        let doc = new jsPDF("p", "mm", "a4");

        html2canvas(document.getElementById("evaluationForm"), { scale: 2 }).then(canvas => {
            let imgData = canvas.toDataURL("image/png");
            let imgWidth = 210; // A4 width in mm
            let imgHeight = (canvas.height * imgWidth) / canvas.width;
            doc.addImage(imgData, "PNG", 0, 0, imgWidth, imgHeight);
            doc.save("Student_Evaluation.pdf");
        });
    });

    
</script>

@endsection

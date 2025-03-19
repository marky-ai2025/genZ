@extends('layouts.userdefault')

@section('content')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<style>
    .toast-success { background-color: #28a745 !important; }
    .toast-error { background-color: #dc3545 !important; }
</style>

<main id="main" class="main d-flex justify-content-center align-items-center" 
      style="position: fixed; inset: 0; background: #e0e5ec; overflow: hidden;">

    <div class="card shadow-lg p-4" 
         style="max-width: 600px; width: 100%; border-radius: 15px; 
                background: rgba(255, 255, 255, 0.2); backdrop-filter: blur(10px);">

        <div class="card-header text-white text-center" 
             style="background: linear-gradient(45deg, #0057A0, #1D9236); border-radius: 10px;">
            <h4 class="mb-0">Request Form</h4>
        </div>

        <div class="card-body">
            <a href="/approved-user" class="btn btn-outline-primary w-100 mb-3">
                <i class="bi bi-eye"></i> View Approved Requests
            </a>

            <form id="scheduleForm" class="needs-validation" novalidate>
                @csrf
                <div class="mb-3">
                    <label for="requested_by" class="form-label fw-bold">Requested By:</label>
                    <input type="text" id="requested_by" name="requested_by" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label fw-bold">Description:</label>
                    <textarea id="description" name="description" class="form-control" rows="3" required></textarea>
                </div>

                <div class="mb-3">
                    <label for="start_time" class="form-label fw-bold">Start Time:</label>
                    <input type="datetime-local" id="start_time" name="start_time" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="end_time" class="form-label fw-bold">End Time:</label>
                    <input type="datetime-local" id="end_time" name="end_time" class="form-control" required>
                </div>

                <button type="submit" class="btn w-100" 
                        style="background: linear-gradient(45deg, #F4C300, #E0301E); color: white; font-weight: bold;">
                    Submit Request
                </button>
            </form>
        </div>
    </div>
</main>

<script>
    $(document).ready(function() {
        toastr.options = {
            closeButton: true,
            progressBar: true,
            positionClass: "toast-top-right",
            timeOut: "3000"
        };

        $('#scheduleForm').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                type: 'POST',
                url: '/schedule/store',
                data: $(this).serialize(),
                success: function(response) {
                    toastr.success(response.success, 'Success');
                    
                    $('#scheduleForm')[0].reset();
                    
                    if (typeof fetchSchedules === 'function') {
                        fetchSchedules();
                    }
                },
                error: function(xhr) {
                    toastr.error('Something went wrong!', 'Error');
                }
            });
        });
    });
</script>

@endsection

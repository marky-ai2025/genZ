@extends('layouts.default')

@section('content')

<!-- Styles -->
<link href="{{ asset('assets/css/schedulerequest.css') }}" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

<!-- Dashboard Section -->
<main id="main" class="main">
    <div class="content-wrapper">
        <div class="dashboard p-3 mb-3 d-flex justify-content-between align-items-center" 
             style="background: linear-gradient(45deg, #0057A0, #1D9236); color: white; border-radius: 10px;">
            <h5 class="mb-0">Live Request Overview <i class="bi bi-wifi"></i></h5>
            <i class="bi bi-trophy" style="font-size: 24px;"></i>
        </div>
      
        
        <div class="row mb-4">
            <div class="col-md-3">
                <div class="card-custom text-center blue">
                    <i class="bi bi-list-task card-icon"></i>
                    <h6>Total Requests</h6>
                    <h4 id="totalRequests">4</h4>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card-custom text-center green">
                    <i class="bi bi-check-circle card-icon"></i>
                    <h6>Approved</h6>
                    <h4 id="approvedRequests">1</h4>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card-custom text-center yellow">
                    <i class="bi bi-hourglass-split card-icon"></i>
                    <h6>Pending</h6>
                    <h4 id="pendingRequests">3</h4>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card-custom text-center red">
                    <i class="bi bi-x-circle card-icon"></i>
                    <h6>Rejected</h6>
                    <h4 id="rejectedRequests">0</h4>
                </div>
            </div>
        </div>
        
        <div class="top-bar mb-3">
            <a href="/approved-admin" class="approved-link">
                <i class="bi bi-eye"></i> Approved Requests
            </a>
        </div>
        
        

        <!-- Notification Sound -->
        <audio id="notification-sound">
            <source src="{{ asset('mp3/mickey.mp3') }}" type="audio/mpeg">
        </audio>

        <!-- Schedule Requests Table -->
        <div class="table-container">
            <table id="scheduleTable" class="display nowrap" style="width:100%">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Date Posted</th>
                        <th>Requested By</th>
                        <th>Description</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</main>

<!-- Scripts -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
$(document).ready(function() {
    let lastRequestCount = 0; 

    function fetchSchedules() {
        $.ajax({
            url: '/schedules/fetch',
            method: 'GET',
            success: function(data) {
                let tableBody = $('#scheduleTable tbody');
                tableBody.empty();

                let totalRequests = data.length;
                let approvedRequests = data.filter(s => s.status === "Approved").length;
                let pendingRequests = data.filter(s => s.status === "Pending").length;
                let rejectedRequests = data.filter(s => s.status === "Rejected").length;

                $("#totalRequests").text(totalRequests);
                $("#approvedRequests").text(approvedRequests);
                $("#pendingRequests").text(pendingRequests);
                $("#rejectedRequests").text(rejectedRequests);

                if (totalRequests > lastRequestCount) {
                    document.getElementById('notification-sound').play();
                }

                lastRequestCount = totalRequests;

                data.forEach(function(schedule) {
                    tableBody.append(`
                        <tr id="row_${schedule.id}">
                            <td>${schedule.id}</td>
                            <td>${new Date(schedule.created_at).toLocaleString()}</td>
                            <td>${schedule.requested_by}</td>
                            <td>${schedule.description}</td>
                            <td>${schedule.start_time}</td>
                            <td>${schedule.end_time}</td>
                            <td>
                                <select id="status_${schedule.id}" class="status-select" data-id="${schedule.id}">
                                    <option value="Pending" ${schedule.status === 'Pending' ? 'selected' : ''}>Pending</option>
                                    <option value="Approved" ${schedule.status === 'Approved' ? 'selected' : ''}>Approved</option>
                                    <option value="Rejected" ${schedule.status === 'Rejected' ? 'selected' : ''}>Rejected</option>
                                </select>
                            </td>
                            <td>
                                <button class="delete-btn btn btn-danger btn-sm" onclick="deleteSchedule(${schedule.id})">Close</button>
                            </td>
                        </tr>
                    `);
                });

                if (!$.fn.DataTable.isDataTable('#scheduleTable')) {
                    $('#scheduleTable').DataTable({
                        dom: 'Bfrtip',
                        buttons: [
                            { extend: 'excelHtml5', text: 'Export to Excel', className: 'btn btn-success' },
                            { extend: 'print', text: 'Print', className: 'btn btn-primary' }
                        ],
                        order: [[1, "desc"]],
                        pageLength: 10
                    });
                }
            }
        });
    }

    $(document).on('change', '.status-select', function() {
        let id = $(this).data('id');
        let status = $(this).val();

        if (status === "Approved") {
            $.ajax({
                type: 'PUT',
                url: `/schedule/approve/${id}`,
                data: { _token: $('meta[name="csrf-token"]').attr('content') },
                success: function(response) {
                    toastr.success(response.success, 'Success');
                    fetchSchedules();
                }
            });
        } else if (status === "Rejected") {
            if (confirm("Are you sure you want to reject and delete this request?")) {
                deleteSchedule(id);
            } else {
                fetchSchedules();
            }
        }
    });

    window.deleteSchedule = function(id) {
        $.ajax({
            type: 'DELETE',
            url: `/schedule/delete/${id}`,
            data: { _token: $('meta[name="csrf-token"]').attr('content') },
            success: function(response) {
                toastr.success(response.success, 'Deleted');
                $(`#row_${id}`).remove();
                fetchSchedules();
            },
            error: function() {
                toastr.error("Error deleting schedule.");
            }
        });
    };

    setInterval(fetchSchedules, 5000);
    fetchSchedules();
});
</script>

@endsection

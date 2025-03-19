@extends('layouts.userdefault')

@section('content')
<!-- Link to custom CSS -->
<link href="{{ asset('assets/css/schedule.css') }}" rel="stylesheet">

<main id="main" class="main">
    <div class="content-wrapper">
        <!-- Top Bar -->
        <div class="top-bar">
            <h1>Approved Requests</h1>
            <a href="/request" class="approved-link">
                <i class="bi bi-eye"></i> Request 
            </a>
        </div>

        <!-- Table Section -->
        <div class="table-container">
            <table id="approvedTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Date Posted</th>
                        <th>Requested By</th>
                        <th>Description</th>
                        <th>Start Time</th>
                        <th>End Time</th>
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>
</main>

<!-- jQuery and AJAX Script -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
$(document).ready(function() {
    fetchApprovedSchedules();

    function fetchApprovedSchedules() {
        $.ajax({
            url: '/approved/admin',
            method: 'GET',
            success: function(data) {
                let tableBody = $('#approvedTable tbody');
                tableBody.empty();

                if (data.length === 0) {
                    tableBody.append(`<tr><td colspan="6" class="no-data">No approved requests found.</td></tr>`);
                } else {
                    data.forEach(function(schedule) {
                        tableBody.append(`
                            <tr>
                                <td>${schedule.id}</td>
                                <td>${new Date(schedule.created_at).toLocaleDateString()}</td>
                                <td>${schedule.requested_by}</td>
                                <td>${schedule.description}</td>
                                <td>${schedule.start_time}</td>
                                <td>${schedule.end_time}</td>
                            </tr>
                        `);
                    });
                }
            },
            error: function() {
                console.error('Error fetching approved schedules.');
            }
        });
    }

    setInterval(fetchApprovedSchedules, 5000);
});
</script>

@endsection

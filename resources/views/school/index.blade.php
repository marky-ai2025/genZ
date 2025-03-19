@extends('layouts.default')
@section('content')

<main id="main" class="main">

    <!-- Alert Message -->
    @if(session('success'))
        <div id="successAlert" class="alert alert-success position-fixed p-3 shadow" role="alert" 
            style="z-index: 1050; top: 20px; right: 20px; text-align: center;">
            {{ session('success') }}
        </div>

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                setTimeout(() => {
                    let successAlert = document.getElementById('successAlert');
                    if (successAlert) {
                        successAlert.style.opacity = "0"; // Start fading out
                        setTimeout(() => {
                            successAlert.style.display = "none"; // Hide completely
                        }, 500);
                    }
                }, 3000); // Display for 3 seconds before fade-out
            });
        </script>
    @endif

    <div class="pagetitle d-flex justify-content-between align-items-center">
        <div>
            <h1>School Profile</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">School</li>
                </ol>
            </nav>
        </div>
        <div>
            <button class="btn btn-primary" onclick="exportCSV()">
                <i class="bi bi-file-earmark-spreadsheet"></i> Export CSV
            </button>
            <button class="btn btn-success" onclick="exportExcel()">
                <i class="bi bi-file-earmark-excel"></i> Export Excel
            </button>
            <button class="btn btn-danger" onclick="exportPDF()">
                <i class="bi bi-file-earmark-pdf"></i> Export PDF
            </button>
            <button class="btn btn-warning" onclick="printTable()">
                <i class="bi bi-printer"></i> Print Table
            </button>
        </div>

    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">

                <div class="card">
                    <h5 class="card-title p-3">School List
                        <button type="button" class="btn btn-success float-end bi bi-plus-square" data-bs-toggle="modal" data-bs-target="#addSchoolModal">
                            Add School
                        </button>  
                        <div class="dropdown d-inline-block float-end me-2">
                            <button class="btn btn-white border dropdown-toggle" type="button" id="abbrDropdown" data-bs-toggle="dropdown" aria-expanded="false" style="color: black;">
                                ALL
                            </button>
                            <ul class="dropdown-menu p-2" aria-labelledby="abbrDropdown" style="max-height: 200px; overflow-y: auto;">
                                <li>
                                    <input class="form-check-input" type="checkbox" id="selectAllAbbr">
                                    <label class="form-check-label ms-2" for="selectAllAbbr">Select All</label>
                                </li>
                                @foreach ($schools->pluck('abbr')->unique() as $abbr)
                                    <li>
                                        <input class="form-check-input abbr-checkbox" type="checkbox" value="{{ $abbr }}" id="abbr-{{ $abbr }}">
                                        <label class="form-check-label ms-2" for="abbr-{{ $abbr }}">{{ $abbr }}</label>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </h5>

                    <!-- School Table -->
                    <table id="schoolTable" class="table datatable table-striped table-bordered">
                        <thead>
                            <tr>
                                <th style="text-align: center;">No.</th>
                                <th style="text-align: center;">School Name</th>
                                <th style="text-align: center;">Abbreviation</th>
                                <th style="text-align: center;">Barangay</th>
                                <th style="text-align: center;">City/Municipality</th>
                                <th style="text-align: center;">Province</th>
                                <th style="text-align: center;">Type of School</th>
                                <th style="text-align: center;">Options</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($schools as $school)
                                <tr style="text-align: center;">
                                    <td>{{ $school->id }}</td>
                                    <td>{{ $school->name }}</td>
                                    <td class="abbr-column">{{ $school->abbr }}</td>
                                    <td>{{ $school->brgy }}</td>
                                    <td>{{ $school->city }}</td>
                                    <td>{{ $school->prov }}</td>
                                    <td>{{ $school->type }}</td>
                                    <td class="no-print">
                                        <a href="#" class="btn btn-success bi bi-pencil-square" data-bs-toggle="modal" data-bs-target="#editSchoolModal-{{ $school->id }}"></a>
                                        @include('school.edit', ['school' => $school])
                                        <a href="javascript:void(0);" onclick="showSchoolDetails({{ json_encode($school) }})" class="btn btn-info bi bi-eye"></a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    <!-- End School Table -->
                    
                    @include('school.create')
                    
                </div>
            </div>
        </div>
    </section>
</main>

<script>
    document.getElementById('selectAllAbbr').addEventListener('change', function () {
            let checkboxes = document.querySelectorAll('.abbr-checkbox');
            checkboxes.forEach(cb => cb.checked = this.checked);
            applyFilter();
        });

        document.querySelectorAll('.abbr-checkbox').forEach(checkbox => {
            checkbox.addEventListener('change', function () {
                applyFilter();
                document.getElementById('selectAllAbbr').checked = document.querySelectorAll('.abbr-checkbox:checked').length === document.querySelectorAll('.abbr-checkbox').length;
            });
        });

        function applyFilter() {
            let selectedAbbrs = Array.from(document.querySelectorAll('.abbr-checkbox:checked')).map(cb => cb.value.toLowerCase());
            let rows = document.querySelectorAll('.datatable tbody tr');
    
            rows.forEach(row => {
                let abbrCell = row.querySelector('.abbr-column').textContent.toLowerCase();
                if (selectedAbbrs.length === 0 || selectedAbbrs.includes(abbrCell)) {
                    row.style.display = "";
                } else {
                    row.style.display = "none";
                }
            });
        }

    function exportCSV() {
        let table = document.getElementById("schoolTable");
        let rows = table.querySelectorAll("tr");
        let csvContent = "data:text/csv;charset=utf-8,";
        rows.forEach(row => {
            let cols = row.querySelectorAll("th, td");
            let rowData = [];
            cols.forEach(col => rowData.push(col.innerText));
            csvContent += rowData.join(",") + "\n";
        });
        let encodedUri = encodeURI(csvContent);
        let link = document.createElement("a");
        link.setAttribute("href", encodedUri);
        link.setAttribute("download", "schools.csv");
        document.body.appendChild(link);
        link.click();
    }

    function exportExcel() {
        let table = document.getElementById("schoolTable");
        let html = table.outerHTML.replace(/ /g, '%20');
        let url = 'data:application/vnd.ms-excel,' + html;
        let link = document.createElement("a");
        link.href = url;
        link.download = "schools.xls";
        document.body.appendChild(link);
        link.click();
    }

    function exportPDF() {
        let table = document.getElementById("schoolTable");
        let html = table.outerHTML.replace(/ /g, '%20');
        let url = 'data:application/vnd.ms-pdf,' + html;
        let link = document.createElement("a");
        link.href = url;
        link.download = "schools.pdf";
        document.body.appendChild(link);
        link.click();
    }
    function printTable() {
        let printWindow = window.open('', '', 'width=900,height=700');
        let table = document.getElementById("schoolTable").cloneNode(true);

        // Remove the 'Options' column from the cloned table
        let headers = table.querySelectorAll("thead th");
        let rows = table.querySelectorAll("tbody tr");
        headers[headers.length - 1].remove(); // Remove last column header
        rows.forEach(row => row.children[row.children.length - 1].remove()); // Remove last column in each row

        // Get the current date and time
        let now = new Date();
        let month = now.toLocaleString('default', { month: 'long' });
        let year = now.getFullYear();
        let dateTime = now.toLocaleString();
        
        // Print content
        printWindow.document.write(`
        <html>
        <head>
            <style>
                body { 
                    font-family: Arial, sans-serif; 
                    text-align: center; 
                    margin: 0; 
                    padding: 0; 
                }
                .header-table {
                    width: 100%;
                    border-collapse: collapse; /* Ensures no extra spacing */
                }
                .header-table td {
                    padding: 2px;
                    vertical-align: middle;
                    text-align: center;
                    border: 1px solid black;
                }
                .logo {
                    max-width: 80px;
                    height: auto;
                }
                /* ✅ Ensuring No Border Spacing */
                table {
                    width: 100%;
                    margin-top: 15px;
                    border-collapse: collapse; /* Important for no spacing */
                }
                th, td {
                    border: 1px solid black;
                    padding: 5px; /* Adjust as needed */
                    text-align: center;
                }
                th {
                    background-color: #f2f2f2;
                }
            </style>

        </head>
        <body>
            <table class="header-table">
                <tr>
                    <td style="width: 15%;">
                        <img src="img/department-health.png" class="logo" alt="Logo 1">
                    </td>
                    <td style="width: 70%;">
                        <h3 style="margin: 2px;">Republic of the Philippines</h3>
                        <h3 style="margin: 2px;">Department of Health</h3>
                        <h2 style="margin: 2px;">Southern Isabela Medical Center</h2>
                        <h5 style="margin: 2px;">School List as of ${month} ${year}</h5>
                    </td>
                    <td style="width: 15%;">
                        <img src="img/logo.png" class="logo" alt="Logo 2">
                    </td>
                </tr>
            </table>

            ${table.outerHTML}

            <p><strong>Printed on:</strong> ${dateTime}</p>
            <script>window.onload = function() { window.print(); window.close(); }<\/script>
        </body>
        </html>
    `);
    printWindow.document.close();
}
</script>

@endsection

 @extends('layouts.default')
@section('content')

<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.dataTables.min.css">

<!-- jQuery and DataTables JS -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=YOUR_GOOGLE_MAPS_API_KEY&libraries=places"></script>


<main id="main" class="main">

    <div class="pagetitle">
        <h1>Student Data Table</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Tables</li>
                <li class="breadcrumb-item active">Data</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <div class="col-lg-12">
          
                <div class="card">
                    <card-header class="d-flex justify-content-between align-items-center" id="upload">
                        <h5 class="card-title">Student List</h5>

                      
                 
                        <card-tools>
                            <button id="add" class="btn btn-primary btn-sm">
                                <i class="fa fa-plus"></i> Add Student
                            </button>
                            <button class="btn btn-success btn-sm text-white" data-bs-toggle="modal" data-bs-target="#uploadModal">
                                <i class="fa fa-upload"></i> Upload Students
                            </button>
                        </card-tools>
                        
                    </card-header>

                    <div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="uploadModalLabel">Upload Student Data</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <form action="{{ route('import.students') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body">
                                        <input type="file" name="file" class="form-control" required>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-success">Upload</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    
                    <div class="card-body">
                        
                     
                        
                      

                        <!-- Student Table -->
                        <table id="students-table" class="table table-responsive table-bordered table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Last Name</th>
                                    <th>First Name</th>
                                    <th>Middle Name</th>
                                    <th>Gender</th>
                                    <th>Birthday</th>
                                    <th>Address</th>
                                    <th>School</th>
                                    <th>Course</th>
                                    <th>Program</th>
                                    <th>Civil Status</th>
                                    <th>Religion</th>
                                    <th>Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Data will be dynamically inserted here -->
                            </tbody>
                        </table>
                        <!-- End Student Table -->

                    </div>
                </div>

            </div>
        </div>




        <div class="modal fade" id="student-modal" tabindex="-1" aria-labelledby="studentModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="studentModalLabel">Add Student</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="studentForm" method="post">
                            @csrf
                            <div class="mb-3">
                                <label for="lastname" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="lastname" name="lastname">
                            </div>
                            <div class="mb-3">
                                <label for="firstname" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="firstname" name="firstname">
                            </div>
                            <div class="mb-3">
                                <label for="middlename" class="form-label">Middle Name</label>
                                <input type="text" class="form-control" id="middlename" name="middlename">
                            </div>
                            <div class="mb-3">
                                <label for="gender" class="form-label">Gender</label>
                                <select class="form-select" id="gender" name="gender">
                                    <option value="">Select</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="birthday" class="form-label">Birthday</label>
                                <input type="date" class="form-control" id="birthday" name="birthday">
                            </div>
                            <div class="mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" name="address">
                            </div>
                            <div class="mb-3">
                                <label for="school" class="form-label">School</label>
                                <select class="form-control" id="school" name="school">
                                    <option value="">Select a School</option>
                                    <option value="University of La Salette">University of La Salette</option>
                                    <option value="Northeastern College">Northeastern College</option>
                                    <option value="Cagayan Valley Computer and Information Technology College, Inc.">
                                        Cagayan Valley Computer and Information Technology College, Inc.
                                    </option>
                                    <option value="Sistech College">Sistech College</option>
                                    <option value="Our Lady of Pillar Colleges- Cauayan">Our Lady of Pillar Colleges- Cauayan</option>
                                    <option value="Isabela State University Jones">Isabela State University Jones</option>
                                    <option value="Isabela State University Ilagan">Isabela State University Ilagan</option>
                                    <option value="Isabela State University Santiago">Isabela State University Santiago</option>
                                    <option value="Isabela State University Main Echague">Isabela State University Main Echague</option>
                                    <option value="PLT College Inc.">PLT College Inc.</option>
                                    <option value="Far Eastern University">Far Eastern University</option>
                                    <option value="Infant Jesus Montessori School">Infant Jesus Montessori School</option>
                                    <option value="St. Paul University Philippines">St. Paul University Philippines</option>
                                    <option value="Medical Colleges of Northern Philippines">Medical Colleges of Northern Philippines</option>
                                    <option value="Cagayan State University">Cagayan State University</option>
                                    <option value="Quirino State University">Quirino State University</option>
                                    <option value="La Patria Sable College">La Patria Sable College</option>
                                </select>
                            </div>
                            
                            <div class="mb-3">
                                <label for="course" class="form-label">Course</label>
                                <select class="form-control" id="course" name="course">
                                    <option value="">Select a Course</option>
                                    <option value="Bachelor of Science in Nursing">Bachelor of Science in Nursing</option>
                                    <option value="Bachelor of Science in Information Technology">Bachelor of Science in Information Technology</option>
                                    <option value="Bachelor of Science in Business Administration">Bachelor of Science in Business Administration</option>
                                    <option value="Bachelor of Science in Medical Technology">Bachelor of Science in Medical Technology</option>
                                    <option value="Bachelor of Science in Radiologic Technology">Bachelor of Science in Radiologic Technology</option>
                                    <option value="Bachelor of Science in Pharmacy">Bachelor of Science in Pharmacy</option>
                                    <option value="Bachelor of Science in Social Work">Bachelor of Science in Social Work</option>
                                    <option value="Bachelor of Science in Nutrition and Dietetics">Bachelor of Science in Nutrition and Dietetics</option>
                

                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="program" class="form-label">Program</label>
                                <select class="form-control" id="program" name="program">
                                    <option value="">Select</option>                             
                                    <option value="Internship">Internship</option>
                                    <option value="Immersion">Immersion</option>
                                    <option value="Affiliates">Affiliates</option>
                                </select>
                            </div>
                            
                            <div class="mb-3">
                                <label for="civilstatus" class="form-label">Civil Status</label>
                                <select class="form-select" id="civilstatus" name="civilstatus">
                                    <option value="">Select</option>
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                    <option value="Divorced">Divorced</option>
                                    <option value="Widowed">Widowed</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="religion" class="form-label">Religion</label>
                                <input type="text" class="form-control" id="religion" name="religion">
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="saveStudent">Save</button>
                    </div>
                </div>
            </div>
        </div>
        




    </section>

</main>

<script>

    document.getElementById('upload').addEventListener('change', function () {
    let file = this.files[0];
    let fileNameDisplay = document.getElementById('file-name');

    if (file) {
        if (file.name.endsWith('.xlsx')) {
            fileNameDisplay.textContent = "Selected file: " + file.name;
            fileNameDisplay.style.color = "green";
        } else {
            fileNameDisplay.textContent = "Invalid file type! Please upload an .xlsx file.";
            fileNameDisplay.style.color = "red";
            this.value = ""; // Reset file input
        }
    } else {
        fileNameDisplay.textContent = "No file chosen";
        fileNameDisplay.style.color = "";
    }
});

    $(document).ready(function () {

        // Function to fetch student data and populate DataTable
        function getStudents() {
            $.ajax({
                url: 'Student/getStudents', // Correct Laravel API endpoint
                type: 'GET',
                dataType: 'json',
                success: function (response) {
                    let table = $('#students-table').DataTable({
                        destroy: true, // Allows table reinitialization
                        responsive: true,
                        data: response,
                        columns: [
                            { data: 'id' },
                            { data: 'lastname' },
                            { data: 'firstname' },
                            { data: 'middlename' },
                            { data: 'gender' },
                            { data: 'birthday' },
                            { data: 'address' },
                            { data: 'school' },
                            { data: 'course' },
                            { data: 'program' },
                            { data: 'civilstatus' },
                            { data: 'religion' },
                            {
    data: null,
    render: function (data, type, row) {
        return `
            <button class="btn btn-warning btn-sm edit-btn" data-id="${row.id}">Edit</button>
            <button class="btn btn-danger btn-sm delete-btn" data-id="${row.id}">Delete</button>
        `;
    },
    orderable: false
}

                        ],
                        dom: 'Bfrtip', // Enables export buttons
                        buttons: [
                            { extend: 'csv', text: 'Export CSV', className: 'btn btn-primary' },
                            { extend: 'excel', text: 'Export Excel', className: 'btn btn-success' },
                            { extend: 'pdf', text: 'Export PDF', className: 'btn btn-danger' },
                            { extend: 'print', text: 'Print Table', className: 'btn btn-warning' }
                        ]
                    });
                },
                error: function (error) {
                    console.error("Error fetching student data: ", error);
                }
            });
        }

        // Fetch students on page load
        getStudents();

        // Show modal when "Add Student" button is clicked
        $('#add').click(function (e) {
            e.preventDefault();
            $('#student-modal').modal('show');
        });
      

        // Handle form submission via AJAX
        $('#saveStudent').click(function (e) {
    e.preventDefault();

    let studentId = $('#studentForm').attr('data-id'); // Get the student ID
    let url = studentId ? `Student/update/${studentId}` : "Student/add"; // Determine URL

    let formData = $('#studentForm').serialize();
    if (studentId) {
        formData += '&_method=POST'; // Append _method=PUT when updating
    }

    $.ajax({
        type: "POST", // Always use POST
        url: url,
        data: formData,
        dataType: "json",
        success: function (response) {
            alert(response.message);
            getStudents(); // Refresh DataTable
            $('#student-modal').modal('hide'); // Hide modal
            $('#studentForm')[0].reset(); // Reset form fields
            $('#studentForm').removeAttr('data-id'); // Clear data-id attribute
            $('#saveStudent').text('Save'); // Reset button text
        },
        error: function (xhr) {
            alert("Error: " + xhr.responseJSON.message);
        }
    });
});


$(document).on('click', '.delete-btn', function () { 
    let studentId = $(this).data('id'); // Get student ID

    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#d33",
        cancelButtonColor: "#3085d6",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                type: "POST", // Use POST for all AJAX requests
                url: `Student/delete/${studentId}`, // Route URL
                data: {
                    _method: 'post', // Simulate DELETE method
                    _token: $('meta[name="csrf-token"]').attr('content') // Add CSRF token
                },
                dataType: "json",
                success: function (response) {
                    getStudents(); // Refresh DataTable
                    toastr.success(response.message, "Success");
                },
                error: function (xhr) {
                    toastr.error(xhr.responseJSON.message, "Error");
                }
            });
        }
    });
});



$(document).on('click', '.edit-btn', function () {
    let studentId = $(this).data('id'); // Get student ID

    $.ajax({
        url: `Student/${studentId}/edit`,  // API endpoint to fetch student data
        type: "GET",
        success: function (response) {
            $('#studentForm').attr('data-id', response.id);
            $('#lastname').val(response.lastname);
            $('#firstname').val(response.firstname);
            $('#middlename').val(response.middlename);
            $('#gender').val(response.gender);
            $('#birthday').val(response.birthday);
            $('#address').val(response.address);
            $('#school').val(response.school);
            $('#course').val(response.course);
            $('#program').val(response.program);
            $('#civilstatus').val(response.civilstatus);
            $('#religion').val(response.religion);

            // Change button text for update
            $('#saveStudent').text('Update').attr('id', 'updateStudent');

            // Show the modal
            $('#student-modal').modal('show');
        },
        error: function (xhr) {
            alert("Error: " + xhr.responseJSON.message);
        }
    });
});


    });

    //excel

   
    
</script>



@endsection



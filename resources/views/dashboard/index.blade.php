  @extends('layouts.default')
  @section('content')


  <main id="main" class="main">
    @if (session('success'))
    <script>
        toastr.success("{{ session('success') }}");
    </script>
@endif

  </div><!-- End Page Title -->

         

  <section class="section dashboard">
    <div class="row">

      <!-- Left side columns -->
      <div class="col-lg-8">
        <div class="row">

          <!-- Sales Card -->
          <div class="col-xxl-4 col-md-6">
            <div class="card info-card sales-card">

              <div class="filter">
                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                  <li class="dropdown-header text-start">
                    <h6>Filter</h6>
                  </li>

                  <li><a class="dropdown-item" href="#">Today</a></li>
                  <li><a class="dropdown-item" href="#">This Month</a></li>
                  <li><a class="dropdown-item" href="#">This Year</a></li>
                </ul>
              </div>

              <div class="card-body">
                <h5 class="card-title">Total <span>| Students </span></h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-duffle"></i>

                  </div>
                  <div class="ps-3">
                    <h6 id="student-count">0</h6>

                  </div>
                </div>
              </div>

            </div>
          </div><!-- End Sales Card -->

          <!-- Revenue Card -->
          <div class="col-xxl-4 col-md-6">
            <div class="card info-card revenue-card">

              <div class="filter">
                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                  <li class="dropdown-header text-start">
                    <h6>Filter</h6>
                  </li>

                  <li><a class="dropdown-item" href="#">Today</a></li>
                  <li><a class="dropdown-item" href="#">This Month</a></li>
                  <li><a class="dropdown-item" href="#">This Year</a></li>
                </ul>
              </div>

              <div class="card-body">
                <h5 class="card-title">INTERNSHIP <span>| Simc</span></h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-people"></i>
                  </div>
                  <div class="ps-3">
                    <h6 id="intern-count">0</h6>

                  </div>
                </div>
              </div>

            </div>
          </div><!-- End Revenue Card -->

          <!-- Customers Card -->
          <div class="col-xxl-4 col-xl-12">

            <div class="card info-card customers-card">

              <div class="filter">
                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                  <li class="dropdown-header text-start">
                    <h6>Filter</h6>
                  </li>

                  <li><a class="dropdown-item" href="#">Today</a></li>
                  <li><a class="dropdown-item" href="#">This Month</a></li>
                  <li><a class="dropdown-item" href="#">This Year</a></li>
                </ul>
              </div>

              <div class="card-body">
                <h5 class="card-title">IMMERSION <span>| Simc</span></h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-gitlab"></i>
                  </div>
                  <div class="ps-3">
                    <h6 id="immersion-count">0</h6>

                  </div>
                </div>

              </div>
            </div>

          </div><!-- End Customers Card -->

          <div class="col-xxl-4 col-xl-12">

            <div class="card info-card customers-card">

              <div class="filter">
                <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                  <li class="dropdown-header text-start">
                    <h6>Filter</h6>
                  </li>

                  <li><a class="dropdown-item" href="#">Today</a></li>
                  <li><a class="dropdown-item" href="#">This Month</a></li>
                  <li><a class="dropdown-item" href="#">This Year</a></li>
                </ul>
              </div>

              <div class="card-body">
                <h5 class="card-title">AFFILIATES <span>| Simc</span></h5>

                <div class="d-flex align-items-center">
                  <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-activity"></i>

                  </div>
                  <div class="ps-3">
                    <h6 id="affiliate-count">0</h6>
                    {{-- <span class="text-success small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">decrease</span> --}}

                  </div>
                </div>

              </div>
            </div>

          </div><!-- End Customers Card -->

          <div class="col-xxl-4 col-xl-12">
            <div class="card info-card customers-card">
                <div class="filter">
                    <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        <li class="dropdown-header text-start">
                            <h6>Filter</h6>
                        </li>
                        <li><a class="dropdown-item" href="#">Today</a></li>
                        <li><a class="dropdown-item" href="#">This Month</a></li>
                        <li><a class="dropdown-item" href="#">This Year</a></li>
                    </ul>
                </div>
        
                <div class="card-body">
                    <h5 class="card-title">MALE <span>| Simc</span></h5>
        
                    <div class="d-flex align-items-center">
                        <div class="card-icon male rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-gender-male"></i>
                        </div>
                        <div class="ps-3">
                            <h6 id="male-count">0</h6>
                            {{-- <span class="text-muted small pt-2 ps-1">increase</span> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xxl-4 col-xl-12">
            <div class="card info-card customers-card">
                <div class="filter">
                    <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                        <li class="dropdown-header text-start">
                            <h6>Filter</h6>
                        </li>
                        <li><a class="dropdown-item" href="#">Today</a></li>
                        <li><a class="dropdown-item" href="#">This Month</a></li>
                        <li><a class="dropdown-item" href="#">This Year</a></li>
                    </ul>
                </div>
        
                <div class="card-body">
                    <h5 class="card-title">FEMALE <span>| Simc</span></h5>
        
                    <div class="d-flex align-items-center">
                        <div class="card-icon female rounded-circle d-flex align-items-center justify-content-center">
                            <i class="bi bi-gender-female"></i>
                        </div>
                        <div class="ps-3">
                            <h6 id="female-count">0</h6>
                            {{-- <span class="text-success small pt-1 fw-bold">12%</span> 
                            <span class="text-muted small pt-2 ps-1">increase</span> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card-body pb-0">
          <table class="table table-striped align-middle school-table">
              <thead class="bg-dark text-white">
                  <h5 class="card-title d-flex align-items-center border-bottom pb-2">
                      <i class="bi bi-building text-primary me-2"></i>
                      <span class="fw-bold text-dark" style="font-size: 1.5rem;">Schools</span>
                      <span class="text-muted ms-2" style="font-size: 1.1rem;">| list</span>
                  </h5>
              </thead>
              <tbody>
                  @php
                      $schools = [
                          "University of La Salette",
                          "Northeastern College",
                          "Cagayan Valley Computer and Information Technology College, Inc.",
                          "Sistech College",
                          "Our Lady of Pillar Colleges - Cauayan",
                          "Isabela State University Jones",
                          "Isabela State University Ilagan",
                          "Isabela State University Santiago",
                          "Isabela State University Main Echague",
                          "PLT College Inc.",
                          "Far Eastern University"
                      ];
                      $colors = ['green', 'red', 'blue', 'cyan', 'yellow', 'purple', 'orange', 'pink'];
                  @endphp
        
                  @foreach ($schools as $index => $school)
                      <tr class="school-row fade-in">
                          <th scope="row">
                              <span class="dot {{ $colors[$index % count($colors)] }}"></span>
                          </th>
                          <td class="fw-bold text-dark school-name" style="font-size: 1.1rem;">
                              {{ $school }}
                          </td>
                          <td class="text-end fw-bold text-dark student-count" style="font-size: 1rem;">
                              <i class="bi bi-people-fill student-icon" data-color-index="{{ $index % count($colors) }}"></i>
                              <span class="count">0</span>
                          </td>
                      </tr>
                  @endforeach
              </tbody>
          </table>
        </div>
        
      
      
      
  
      
     
  {{-- school --}}
  
      
        
        

        </div>
      </div><!-- End Left side columns -->

      <div class="col-lg-4">

      
   
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body p-4">
              
                <h5 class="card-title fw-bold text-dark">
                    📚 Course <span class="text-primary">| List</span>
                </h5>
                <ul class="list-group list-group-flush mt-3" id="course-list">
                    <!-- Courses will be loaded dynamically here -->
                </ul>
            </div>
        </div>

        
        <!-- Budget Report -->
          <div class="card">
            <div class="filter">
              <a class="icon" href="#" data-bs-toggle="dropdown"><i class="bi bi-three-dots"></i></a>
              <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow">
                <li class="dropdown-header text-start">
                  <h6>Filter</h6>
                </li>

                <li><a class="dropdown-item" href="#">Today</a></li>
                <li><a class="dropdown-item" href="#">This Month</a></li>
                <li><a class="dropdown-item" href="#">This Year</a></li>
              </ul>
            </div>

            <div class="card-body pb-0">
              <h5 class="card-title">Progress <span>| This Month</span></h5>

              <div id="budgetChart" style="min-height: 400px;" class="echart"></div>

              <script>
                document.addEventListener("DOMContentLoaded", () => {
                  var budgetChart = echarts.init(document.querySelector("#budgetChart")).setOption({
                    legend: {
                      data: ['Allocated Budget', 'Actual Spending']
                    },
                    radar: {
                      // shape: 'circle',
                      indicator: [{
                          name: 'Internship',
                          max: 6500
                        },
                        {
                          name: 'Immersion',
                          max: 16000
                        },
                        {
                          name: 'Internship',
                          max: 30000
                        },
                        {
                          name: 'Affiliates',
                          max: 38000
                        },
                        {
                          name: 'Development',
                          max: 52000
                        },
                        {
                          name: 'Marketing',
                          max: 25000
                        }
                      ]
                    },
                    series: [{
                      name: 'Budget vs spending',
                      type: 'radar',
                      data: [{
                          value: [4200, 3000, 20000, 35000, 50000, 18000],
                          name: 'Allocated Budget'
                        },
                        {
                          value: [5000, 14000, 28000, 26000, 42000, 21000],
                          name: 'Actual Spending'
                        }
                      ]
                    }]
                  });
                });
              </script>

            </div>
          </div>
    </div>

    

    </div>
    <script>
      fetch('/count-students')
          .then(response => response.json())
          .then(data => {
              document.getElementById('student-count').innerText = data.studentCount;
          })
          .catch(error => console.error('Error fetching student count:', error));


          fetch('/count-programs')
          .then(response => response.json())
          .then(data => {
              document.getElementById('intern-count').innerText = data.interns;
              document.getElementById('immersion-count').innerText = data.immersion;
              document.getElementById('affiliate-count').innerText = data.affiliates;
          })
          .catch(error => console.error('Error fetching counts:', error));
  
      fetch('/count-gender')
          .then(response => response.json())
          .then(data => {
              document.getElementById('male-count').innerText = data.male;
              document.getElementById('female-count').innerText = data.female;
          })
          .catch(error => console.error('Error fetching gender counts:', error));



          document.addEventListener("DOMContentLoaded", function() {
        fetch('/dashboard/courses')
            .then(response => response.json())
            .then(data => {
                let courseList = document.getElementById('course-list');
                courseList.innerHTML = ''; 
                
                let colors = ['success', 'danger', 'primary', 'info', 'warning', 'secondary', 'dark', 'muted'];

                data.forEach((course, index) => {
                    let color = colors[index % colors.length]; 
                    courseList.innerHTML += `
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span><i class="bi bi-circle-fill text-${color} me-2"></i>
                                <strong>${course.course}</strong>
                            </span>
                            <span class="badge bg-${color} text-white rounded-pill px-3 py-2">${course.count}</span>
                        </li>
                    `;
                });
            })
            .catch(error => console.error('Error fetching courses:', error)); 
            




    });
    $(document).ready(function () {
      $.ajax({
    url: "{{ route('getStudentBySchools') }}", // Correct route reference
    method: "GET",
            success: function (data) {
                $("tbody tr").each(function () {
                    let schoolName = $(this).find(".school-name").text().trim();
                    let count = data[schoolName] || 0; // Default to 0 if not found
                    $(this).find(".student-count").html('<i class="bi bi-people-fill"></i> ' + count);
                });
            },
            error: function () {
                console.log("Failed to fetch student count.");
            }
        });
    });
    
    document.addEventListener("DOMContentLoaded", function() {
    let successMessage = document.getElementById("success-message");

    if (successMessage) { 
        setTimeout(() => {
            successMessage.classList.add("fade-out");
            setTimeout(() => successMessage.remove(), 500); // Remove from DOM after fade-out
        }, 3000); // Display for 3 seconds before fading out
    }
});
function updateDateTime() {
        const now = new Date();
        const options = { 
            weekday: 'long', 
            month: 'long', 
            day: 'numeric', 
            hour: '2-digit', 
            minute: '2-digit', 
            second: '2-digit', 
            hour12: true 
        };
        document.getElementById('datetime').textContent = now.toLocaleDateString('en-US', options);
    }
    setInterval(updateDateTime, 1000);
    updateDateTime();

  </script>



  </section>

  </main>
  @endsection
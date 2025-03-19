@extends('layouts.userdefault')

@section('content')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<!-- Toastr CSS & JS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<main id="main" class="main">
    @if (session('success'))
    <script>
        toastr.success("{{ session('success') }}");
    </script>
    @endif

    <section class="section dashboard">
        <div class="container-fluid">
            <div class="row">
                <main class="col-md-10 main-content">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2 class="fw-bold">Welcome, {{ auth()->check() ? auth()->user()->name : 'Guest' }}  
                            <i class="bi bi-person-check-fill"></i>
                        </h2>
                        <p class="text-muted">All systems are running smoothly!</p>
                    </div>

                    <!-- Weather & Video Section -->
                    <div class="row mb-4">
                        <div class="col-lg-6">
                            <div class="card weather-card shadow-lg p-4" style="border-radius: 16px; background: linear-gradient(135deg, #4f8aff, #1e90ff); color: #fff; position: relative; overflow: hidden;">
                                <!-- Weather Top Section -->
                                <div class="d-flex align-items-center justify-content-between">
                                    <div class="d-flex align-items-center">
                                        <!-- Weather Icon -->
                                        <img id="weather-icon" src="https://cdn-icons-png.flaticon.com/128/1163/1163661.png" width="50" height="50" alt="Weather Icon" class="me-3">
                                        <div>
                                            <h3 id="weather-temp" class="fw-bold mb-0"></h3>
                                            <small class="text-light" id="weather-condition">Light Rain with Thunder</small>
                                        </div>
                                    </div>
                                    <div class="text-end">
                                        <small class="text-light d-block">
                                            <i class="bi bi-geo-alt-fill"></i> Southern Isabela Medical Center
                                        </small>
                                        <h2 id="datetime" class="fw-bold mt-2" style="font-family: 'Digital', sans-serif;">18:09</h2>
                                    </div>
                                </div>
                        
                                <!-- Additional Weather Details -->
                                <div class="d-flex justify-content-between mt-3">
                                    <small class="text-light">23° / 27°</small>
                                    <small class="text-light">Wind: South, Lv. 3</small>
                                </div>
                        
                                <!-- Map Section -->
                                <div id="map" class="mt-3" style="height: 250px; border-radius: 12px; box-shadow: inset 0 0 10px rgba(255, 255, 255, 0.3);"></div>
                            </div>
                        </div>
                        

                        <div class="col-lg-6">
                            <div class="row g-3">
                                @foreach([
                                    ['title' => 'Total Hours', 'value' => $user->stats->total_hours ?? 'N/A', 'desc' => $user->stats->total_hours ?? 'N/A', 'color' => 'blue-card'],
                                    ['title' => 'Productivity Score', 'value' => $user->stats->productivity_score ?? 'N/A', 'desc' => $user->stats->productivity_score ?? 'N/A', 'color' => 'grey-card'],
                                    ['title' => 'Concern', 'value' => $user->stats->concern ?? 'N/A', 'desc' => $user->stats->concern ?? 'N/A', 'color' => 'light-blue-card'],
                                    ['title' => 'Special Task', 'value' => $user->stats->special_task ?? 'N/A', 'desc' => $user->stats->special_task ?? 'N/A', 'color' => 'green-card']
                                ] as $stat)
                                <div class="col-md-6">
                                    <div class="card stats-card {{ $stat['color'] }}">
                                        <h5>{{ $stat['title'] }}</h5>
                                        <p>{{ $stat['desc'] }}</p>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        
                        
                    </div>

                    <!-- Order & Sales Report -->
                    <div class="row mt-4">
                        <div class="col-lg-6">
                            <div class="card report-card p-3 shadow-sm border-0 ios-blur-card">
                                <h5 class="fw-bold text-center">Google Search</h5>
                                <p class="text-center text-muted">Search anything on Google instantly.</p>

                                <!-- Google Search Form -->
                                <form action="https://www.google.com/search" method="GET" target="_blank">
                                    <div class="d-flex align-items-center px-3 search-box">
                                        <img src="{{ asset('img/ggs.png') }}" alt="Google" width="20" height="20" class="me-2" />
                                        <input type="text" id="searchInput" name="q" class="form-control border-0 bg-transparent" placeholder="Search Google..." required>
                                        <img src="{{ asset('img/voice.png') }}" id="voiceSearch" alt="Voice Image" width="25" height="25" class="mx-2 voice-icon" />
                                        <a href="https://lens.google.com/" target="_blank">
                                            <img src="{{ asset('img/lens.png') }}" alt="Lens Image" width="25" height="25" class="lens-icon"/>
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="card report-card shadow-sm">
                                <h5>Latest News</h5>
                                <p>OJT Nagnakaw ng Ubas.</p>
                                <a href="#" class="report-link">View All Reports →</a>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </section>
</main>

<script>
    // Get Current Date and Time
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
    // Fetch Weather Data (Placeholder API)
    function fetchWeather() {
        $("#weather-temp").text("Fetching...");
        $.get("https://api.open-meteo.com/v1/forecast?latitude=16.88&longitude=121.75&current_weather=true", function(data) {
            $("#weather-temp").html(`${data.current_weather.temperature}&deg;C`);
        }).fail(() => {
            $("#weather-temp").text("N/A");
        });
    }
    fetchWeather();
</script>

@endsection

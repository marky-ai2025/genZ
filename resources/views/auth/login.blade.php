<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>Login - SIMC</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ asset('assets/img/favicon.png') }}" rel="icon">
    <link href="{{ asset('assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

    <link href="https://fonts.gstatic.com" rel="preconnect">
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <link href="{{ asset('assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
    <link href="{{asset('assets/css/login.css')}}" rel="stylesheet">

    
</head>

<body>
 
    <main>
        
        <div class="login-container" id="login-container"> 
            <div class="ocean">
                <div class="wave"></div>
                <div class="wave"></div>
            </div>
            <div class="login-card" id="login-card">
                
                <!-- Logo Section -->
                <div class="logo animated-child">
                    <img src="img/logo.png" alt="SIMC Logo">
                    <span>InternSphere</span>
                </div>
                            
                        <!-- @if ($errors->has('authorization')) -->
                        
                            <!--       {{ $errors->first('authorization') }} -->
                            <!--   </div> -->
                            <!-- @endif -->
                    
                            <!-- @if($errors->has('credential')) -->
                        
                            <!--       {{ $errors->first('credential') }} -->
                            <!--   </div> -->
                            <!-- @endif -->
                    
                            <!-- @if (session('success')) -->
                        
                            <!--       {{ session('success') }} -->
                            <!--   </div> -->
                            <!-- @endif -->
                                    <!-- Login Title -->
                <h5 class="animated-child">Login to Your Account</h5>
                <p class="animated-child">Enter your email and password to access your account</p>
        
                <!-- Login Form -->
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <div class="input-group">
                        <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required>
                    </div>
                    <div class="input-group">
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                    </div>
                    
                    <div class="remember-me">
                        <input type="checkbox" name="remember" id="rememberMe">
                        <label for="rememberMe">Remember me</label>
                    </div>
        
                    <button type="submit" class="btn btn-primary">Login</button>
                </form>
        
                <!-- Register Link -->
                <div class="register-link text-center mt-3 animated-child">
                    <p class="small" style="color: rgba(255, 255, 255, 0.8);">
                        Don't have an account? 
                        <a href="pages-register.html" style="color: #4a90e2;">Create one</a>
                        
                    </p>
                </div>
        
             
          
            </div>
         
        
              <!-- Include jQuery (required for Toastr) -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

            <!-- Toastr CSS & JS -->
            <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
            <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

                
            @if (session('error'))
                <script>
                    toastr.error("{{ session('error') }}");
                </script>
            @endif

            @if (session('logout'))
                <script>
                    toastr.info("{{ session('logout') }}");
                </script>
            @endif

            @if (session('success'))
                <script>
                    toastr.success("{{ session('success') }}");
                </script>
            @endif

            @if ($errors->any())
                <script>
                    @foreach ($errors->all() as $error)
                        toastr.error("{{ $error }}");
                    @endforeach
                </script>
            @endif
           
        </div>
    </main>
    
  
    <a href="#" class="back-to-top">
      <i class="bi bi-arrow-up-short"></i>
    </a>
  
    <script>
      document.addEventListener('DOMContentLoaded', function() {
        setTimeout(function() {
          document.getElementById('login-container').classList.add('animate');
          document.getElementById('login-card').classList.add('animate');
        }, 200);
      });
    </script>
  </body>
  </html>

<script>
    document.addEventListener("DOMContentLoaded", () => {
    
        gsap.from(".login-card", {
            opacity: 0,
            y: 50,
            duration: 1.2,
            ease: "power3.out"
        });

        
        gsap.from(".logo img", {
            opacity: 0,
            y: -20,
            duration: 1,
            delay: 0.5,
            ease: "power2.out"
        });

        gsap.from(".form-control", {
            opacity: 0,
            y: 20,
            duration: 1,
            stagger: 0.2,
            delay: 0.8
        });

        gsap.from(".btn-primary", {
            opacity: 0,
            scale: 0.9,
            duration: 1,
            delay: 1.2,
            ease: "elastic.out(1, 0.5)"
        });

        gsap.to(".login-card", {
            y: -5,
            duration: 3,
            repeat: -1,
            yoyo: true,
            ease: "sine.inOut"
        });

        document.addEventListener("mousemove", (e) => {
            let x = (e.clientX / window.innerWidth) - 0.5;
            let y = (e.clientY / window.innerHeight) - 0.5;
            gsap.to("body::before", {
                x: x * 10,
                y: y * 10,
                duration: 0.5
            });
        });
    });
    document.addEventListener("mousemove", (e) => {
    let x = (e.clientX / window.innerWidth - 0.5) * 10;
    let y = (e.clientY / window.innerHeight - 0.5) * 10;
    document.querySelector(".spiral-bg").style.transform = `rotate(${x}deg) translate(${y}px, ${y}px)`;
});
let angle = 0;
function animateSpiral() {
    angle += 0.1;
    document.querySelector(".spiral-bg").style.transform = `rotate(${angle}deg)`;
    requestAnimationFrame(animateSpiral);
}
animateSpiral();

    document.addEventListener("DOMContentLoaded", function () {
        let messages = document.querySelectorAll(".alert");
        
        messages.forEach((message) => {
            // Delay the smooth fade-in effect
            setTimeout(() => {
                message.classList.add("show");
            }, 300);

            // Auto-hide after 4 seconds
            setTimeout(() => {
                message.classList.remove("show");
            }, 4000);
        });
    });

</script>





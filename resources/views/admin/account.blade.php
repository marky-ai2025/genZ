@extends('layouts.default')
@section('content')

<main id="main" class="main">

    <div class="pagetitle">
        <h1>Profile</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                <li class="breadcrumb-item">Users</li>
                <li class="breadcrumb-item active">Profile</li>
            </ol>
        </nav>
    </div><!-- End Page Title -->

    <section class="section profile">
        <div class="row">
            <div class="col-xl-4">
                <div class="card">
                    <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                        <img src="img/logo.png" alt="Profile" class="rounded-circle">
                        <h2> {{ auth()->check() ? auth()->user()->name : 'Guest' }} </h2>
                        <h3>Web Designer</h3>
                        <div class="social-links mt-2">
                            <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
                            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
                            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
                            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-8">
                <div class="card">
                    <div class="card-body pt-3">
                        <!-- Bordered Tabs -->
                        <ul class="nav nav-tabs nav-tabs-bordered">
                            <li class="nav-item">
                                <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#profile-overview">Overview</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit Profile</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-settings">Settings</button>
                            </li>
                            <li class="nav-item">
                                <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-change-password">Change Password</button>
                            </li>
                        </ul>

                        <div class="tab-content pt-2">
                            <!-- Profile Overview -->
                            <div class="tab-pane fade show active" id="profile-overview">
                                <h5 class="card-title">About</h5>
                                <h5 class="card-title">Profile Details</h5>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Full Name</div>
                                    <div class="col-lg-9 col-md-8">{{ $profile->full_name ?? 'N/A' }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Country</div>
                                    <div class="col-lg-9 col-md-8">{{ $profile->country ?? 'N/A' }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Address</div>
                                    <div class="col-lg-9 col-md-8">{{ $profile->address ?? 'N/A' }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Phone</div>
                                    <div class="col-lg-9 col-md-8">{{ $profile->phone ?? 'N/A' }}</div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-3 col-md-4 label">Email</div>
                                    <div class="col-lg-9 col-md-8">{{ $profile->email ?? 'N/A' }}</div>
                                </div>
                            </div>

                            <!-- Profile Edit Form -->
                            <div class="tab-pane fade" id="profile-edit">
                              <div class="container">
                                  <h2 class="title">Edit Profile</h2>
                          
                                  @if(session('success'))
                                      <div class="alert alert-success">{{ session('success') }}</div>
                                  @endif
                          
                                  <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data" class="profile-form">
                                      @csrf
                          
                                      <div class="form-group profile-image">
                                          <label class="form-label">Profile Image</label>
                                          <input type="file" name="profile_image" class="form-control">
                                      </div>
                          
                                      <table class="profile-table">
                                          <tr>
                                              <td><label class="form-label">Full Name</label></td>
                                              <td><input type="text" name="full_name" value="{{ old('full_name', $profile->full_name ?? '') }}" required class="form-control"></td>
                                          </tr>
                                          <tr>
                                              <td><label class="form-label">Email</label></td>
                                              <td><input type="email" name="email" value="{{ old('email', $profile->email ?? '') }}" required class="form-control"></td>
                                          </tr>
                                          <tr>
                                              <td><label class="form-label">About</label></td>
                                              <td><textarea name="about" class="form-control">{{ old('about', $profile->about ?? '') }}</textarea></td>
                                          </tr>
                                          <tr>
                                              <td><label class="form-label">Company</label></td>
                                              <td><input type="text" name="company" value="{{ old('company', $profile->company ?? '') }}" class="form-control"></td>
                                          </tr>
                                          <tr>
                                              <td><label class="form-label">Position</label></td>
                                              <td><input type="text" name="position" value="{{ old('position', $profile->position ?? '') }}" class="form-control"></td>
                                          </tr>
                                          <tr>
                                              <td><label class="form-label">Country</label></td>
                                              <td><input type="text" name="country" value="{{ old('country', $profile->country ?? '') }}" class="form-control"></td>
                                          </tr>
                                          <tr>
                                              <td><label class="form-label">Address</label></td>
                                              <td><input type="text" name="address" value="{{ old('address', $profile->address ?? '') }}" class="form-control"></td>
                                          </tr>
                                          <tr>
                                              <td><label class="form-label">Phone</label></td>
                                              <td><input type="text" name="phone" value="{{ old('phone', $profile->phone ?? '') }}" class="form-control"></td>
                                          </tr>
                                      </table>
                          
                                      <button type="submit" class="save-button">Save Changes</button>
                                  </form>
                              </div>
                          </div>
                          
                        </div><!-- End Bordered Tabs -->
                    </div>
                </div>
            </div>
        </div>
    </section>
</main><!-- End #main -->

@endsection

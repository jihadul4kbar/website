@extends('layouts.app')

<main id="main" class="main">

    <div class="pagetitle">
      <h1> {{ __('Profile') }}</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Pages</li>
          <li class="breadcrumb-item active"> {{ __('Profile') }}</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title"> {{ __('Profile') }}</h5>
              @include('profile.partials.update-profile-information-form')
              @include('profile.partials.update-password-form')
              @include('profile.partials.delete-user-form') 
            </div>
          </div>

        </div>
      </div>
    </section>

  </main><!-- End #main -->


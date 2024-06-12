<template>
    <div>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <a class="navbar-brand" href="/dashboard">Admin Dashboard</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
            <NuxtLink to="/berita" class="nav-link" >Berita</NuxtLink>
        </li>
        <li class="nav-item">
            <NuxtLink to="/logout" class="nav-link" >Logout</NuxtLink>
        </li>
      </ul>
    </div>
  </div>
</nav>
    </div>
</template>
<template>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <a class="navbar-brand" href="/">Wisata Lombok</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
            <NuxtLink to="/tentang" class="nav-link" >Tentang</NuxtLink>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Wisata
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><a class="dropdown-item" href="#">Alam</a></li>
            <li><a class="dropdown-item" href="#">Pantai</a></li>
            <li><a class="dropdown-item" href="#">Kota</a></li>
            <li><hr class="dropdown-divider"></li>
            <li><a class="dropdown-item" href="#">Paket Wisata</a></li>
            <li><a class="dropdown-item" href="#">Liburan Keluarga</a></li>
          </ul>
        </li>
        <li class="nav-item">
            <NuxtLink to="/login" class="nav-link" >Login</NuxtLink>
        </li>
        <li class="nav-item">
            <NuxtLink to="/register" class="nav-link" >Register</NuxtLink>
        </li>
      </ul>
    </div>
  </div>
</nav>
</template>
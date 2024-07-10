<script setup>
import { RouterLink, RouterView } from 'vue-router'
</script>

<template>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <RouterLink to="/" class="navbar-brand">Wisata Lombok</RouterLink>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <RouterLink to="/tentang" class="nav-link">Tentang</RouterLink>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Wisata
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
            <li><RouterLink to="/" class="dropdown-item">Alam</RouterLink></li>
            <li><RouterLink to="/" class="dropdown-item">Pantai</RouterLink></li>
            <li><RouterLink to="/" class="dropdown-item">Kota</RouterLink></li>
            <li><hr class="dropdown-divider"></li>
            <li><RouterLink to="/" class="dropdown-item">Paket Wisata</RouterLink></li>
            <li><RouterLink to="/" class="dropdown-item">Liburan Keluarga</RouterLink></li>
          </ul>
        </li>
        <div v-if="!token">
          <li class="nav-item">
              <RouterLink to="/login" class="nav-link">Login</RouterLink>
          </li>
          <li class="nav-item">
              <RouterLink to="/register" class="nav-link" >Register</RouterLink>
          </li>
        </div>
        <div v-else>
          <li @click.prevent="logout" class="nav-link" style="cursor:pointer">Logout</li>
        </div>
      </ul>
    </div>
  </div>
</nav>
<div class="container">
  <RouterView />
</div>
<footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Wisata Lombok 2024</p></div>
        </footer>
</template>

<style scoped>
</style>

<script>
import { onMounted, ref } from 'vue'
import { useRouter } from 'vue-router'
import axios from 'axios'
    export default {
        setup() {
            //state token
            const token = localStorage.getItem('token')
            //inisialisasi vue router on Composition API
            const router = useRouter()
            //state user
            const user = ref('')
            //mounted properti
            onMounted(() =>{
                //check Token exist
                if(!token) {
                    return router.push({
                        name: 'login'
                    })
                }
                //get data user
                axios.defaults.headers.common.Authorization = `Bearer ${token}`
                const API_URL = import.meta.env.VITE_API_URL+'user'
                // axios.get('http://127.0.0.1:8000/api/user')
                axios.get(API_URL)
                .then(response => {
                    console.log(response.data.name)
                    user.value = response.data
                })
                .catch(error => {
                    console.log(error.response.data)
                })
            })
            //method logout
            function logout() {
                //logout
                axios.defaults.headers.common.Authorization = `Bearer ${token}`
                const API_URL = import.meta.env.VITE_API_URL+'logout'
                axios.post(API_URL)
                .then(response => {
                    if(response.data.success) {
                        //remove localStorage
                        localStorage.removeItem('token')
                        //redirect ke halaman login
                        return router.push({
                            name: 'home'
                        })
                    }
                })
                .catch(error => {
                    console.log(error.response.data)
                })
            }
            return {
                token,      // <-- state token
                user,       // <-- state user
                logout      // <-- method logout
            }
        }
    }
</script>

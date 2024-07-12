<template>
    <div class="p-3 p-md-4 p-xl-5">
      <div class="container">
        <div class="row">
          <div class="col-12 col-md-6 bsb-tpl-bg-platinum">
            <div class="d-flex flex-column justify-content-between h-100 p-3 p-md-4 p-xl-5">
              <h3 class="m-0">Welcome!</h3>
              <img class="img-fluid rounded mx-auto my-4" loading="lazy" src="../assets/img/lombok.jpg" width="100%" alt="Lombok">
              <p class="mb-0">Belum terdaftar? <a href="/register" class="link-secondary text-decoration-none">Silahkan daftar</a></p>
            </div>
          </div>
        <div class="col-12 col-md-6 bsb-tpl-bg-lotion">
          <div class="p-3 p-md-4 p-xl-5">
            <div class="row">
              <div class="col-12">
                <div class="mb-5">
                  <h3>Log in</h3>
                </div>
              </div>
            </div>
            <div v-if="loginFailed" class="alert alert-danger">
                        Email atau Password Anda salah.
                    </div>
        <form @submit.prevent="login">
          <div class="row gy-3 gy-md-4 overflow-hidden">
              <div class="col-12">
                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                <input v-model="user.email" class="form-control" type="email" placeholder="Email" />
              </div>
              <div v-if="validation.email" class="mt-2 alert alert-danger">
                {{ validation.email[0] }}
              </div>
              <div class="col-12">
                <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                <input v-model="user.password" class="form-control" type="password" placeholder="Password" />
              </div>
              <div v-if="validation.password" class="mt-2 alert alert-danger">
                {{ validation.password[0] }}
              </div>
              <div class="col-12">
                <div class="d-grid">
                  <button class="btn btn-primary" type="submit">Login</button>
                </div>
              </div>
          </div>
        </form>
        </div>
      </div>
      </div>
    </div>
    </div>
</template>
<script>
    import { reactive, ref } from 'vue'
    import { useRouter } from 'vue-router'
    import axios from 'axios'

    export default {
        setup() {
            //inisialisasi vue router on Composition API
            const router = useRouter()
            //state user
            const user = reactive({
                email: '',
                password: '',
            })
            //state validation
            const validation = ref([])
            //state loginFailed
            const loginFailed = ref(null)
            //method login
            function login() {
                //define variable 
                let email = user.email
                let password = user.password
                const API_URL = import.meta.env.VITE_API_URL+'login'
                //send server with axios
                //axios.post('http://127.0.0.1:8000/api/login', {
                axios.post(API_URL, {
                        email,
                        password,
                })
                .then(response => {
                    if(response.data.success) {
                        //set token
                        localStorage.setItem('token', response.data.token)
                        //redirect ke halaman dashboard
                        return router.push({
                            name: 'dashboard'
                        })
                    }
                    //set state loggedIn to true
                    loginFailed.value = true
                }).catch(error => {
                    //set validation dari error response
                    validation.value = error.response.data
                })
            }
            return {
                user,           // <-- state user
                validation,     // <-- state validation 
                loginFailed,    // <-- state loggedIn
                login           // <-- method login
            }
        }
    }
</script>
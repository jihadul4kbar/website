<template>
    <div>
    <Header/>
    <div class="p-3 p-md-4 p-xl-5">
      <div class="container">
        <div class="row">
          <div class="col-12 col-md-6 bsb-tpl-bg-platinum">
            <div class="d-flex flex-column justify-content-between h-100 p-3 p-md-4 p-xl-5">
              <h3 class="m-0">Welcome!</h3>
              <img class="img-fluid rounded mx-auto my-4" loading="lazy" src="~/assets/img/lombok.jpg" width="100%" alt="Lombok">
              <p class="mb-0">Not a member yet? <a href="#!" class="link-secondary text-decoration-none">Register now</a></p>
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
        <form @submit.prevent="login">
          <div class="row gy-3 gy-md-4 overflow-hidden">
              <div class="col-12">
                <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                <input v-model="email" class="form-control" type="email" placeholder="Email" />
              </div>
              <div class="col-12">
                <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
                <input v-model="password" class="form-control" type="password" placeholder="Password" />
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
    <Footer />
    </div>
  </template>
  
  <script>
      export default {
      data() {
        return {
          email: '',
          password: ''
        }
      },
      methods: {
        async login() {
          try {
            const response = await this.$auth.loginWith('local', {
              data: {
                email: this.email,
                password: this.password
              }
            });
            // console.log('Login Response:', response); // Debug log
            // console.log('Token:', this.$auth.strategy.token.get()); // Debug log
            // console.log('Data', response.data.data.name);
            // console.log('User', $auth.loggedIn);
            console.log(this.$auth.user);
            localStorage.setItem('token', response.data.data.token);
            localStorage.setItem('name', JSON.stringify(response.data.data.name)); // Menyimpan informasi pengguna
            localStorage.setItem('email', JSON.stringify(response.data.data.email)); // Menyimpan informasi pengguna
            this.$axios.setToken(response.data.data.token, 'Bearer');
            this.$router.push(this.$auth.redirect('home') || '/dashboard');
          } catch (error) {
            console.error('Error during login:', error);
          }
        }
      }
    }
  </script>
  
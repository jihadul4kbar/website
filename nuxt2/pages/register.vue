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
            </div>
          </div>
        <div class="col-12 col-md-6 bsb-tpl-bg-lotion">
          <div class="p-3 p-md-4 p-xl-5">
            <div class="row">
              <div class="col-12">
                <div class="mb-5">
                  <h3>Register</h3>
                </div>
              </div>
            </div>
      <form @submit.prevent="register">
        <div class="row gy-3 gy-md-4 overflow-hidden">
          <div class="col-12">
            <label for="email" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
            <input v-model="name" class="form-control" type="text" placeholder="Name" />
          </div>
          <div class="col-12">
            <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
            <input v-model="email" class="form-control" type="email" placeholder="Email" />
          </div>
          <div class="col-12">
            <label for="email" class="form-label">Password <span class="text-danger">*</span></label>
            <input v-model="password" class="form-control" type="password" placeholder="Password" />
          </div>
          <div class="col-12">
            <label for="email" class="form-label">Comfirm Password <span class="text-danger">*</span></label>
            <input v-model="c_password" class="form-control" type="password" placeholder="Confirm Password" />
          </div>
          <div class="col-12">
            <div class="d-grid">
              <button class="btn btn-primary btn-block" type="submit">Register</button>
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
        name: '',
        email: '',
        password: '',
        c_password: ''
      }
    },
    methods: {
      async register() {
        try {
          await this.$axios.post('/register', {
            name: this.name,
            email: this.email,
            password: this.password,
            c_password: this.c_password,
          });
          this.$router.push('/login');
        } catch (error) {
          console.error('Error during registration:', error);
        }
      }
    }
  }
  </script>
  
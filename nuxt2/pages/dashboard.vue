
import AdminFooter from '../../components/admin/AdminFooter.vue';

import AdminHeader from '../../components/admin/AdminHeader.vue';
<template>
    <div>
        <AdminHeader />
        <header class="py-5">
            <div class="container px-lg-5">
                <div class="p-4 p-lg-5 bg-light rounded-3 text-center">
                    <div class="m-4 m-lg-5">
                        <UserInfo />
                        <div v-if="$auth.loggedIn">
      <p>Hello, {{ user.name }} ({{ user.email }})</p>
      <p>Token: {{ token }}</p>
      <button @click="logout">Logout</button>
    </div>
    <div v-else>
      <p>You are not logged in. Please <nuxt-link to="/login">login</nuxt-link>.</p>
    </div>
                        <h1 class="display-5 fw-bold">Selamat Datang Di Dashboard Wisata Lombok</h1>
                        <p class="fs-4">Lorem ipsum, dolor sit amet consectetur adipisicing elit. Aut voluptates repellat hic consequatur culpa. Soluta ullam tempora necessitatibus explicabo repudiandae nesciunt, magnam aliquam, itaque rerum id, hic quas architecto alias.</p>
                        <!-- <a class="btn btn-primary btn-lg" href="#!">Exprlore</a> -->
                    </div>
                </div>
            </div>
        </header>
        <AdminFooter />
    </div>
</template>
<script>
import UserInfo from '~/components/admin/UserInfo.vue';
export default{
    components: {
    UserInfo
  },
  // middleware: 'auth',
  computed: {
    user() {
      return this.$auth.user
    },
    token() {
      return localStorage.getItem('auth._token.local')
    }
  },
  methods: {
    async logout() {
      try {
        await this.$auth.logout()
        this.$router.push('/login')
      } catch (err) {
        console.error(err)
      }
    }
  }
}

</script>
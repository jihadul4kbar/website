import AdminFooter from '../../components/admin/AdminFooter.vue';
import AdminHeader from '../../components/admin/AdminHeader.vue';
<template>
    <div>
        <AdminHeader />
        <div class="container">
      <h1>Berita</h1>
      <button @click="$router.push('/berita/create')">Tambah Berita</button>
      <ul>
        <li v-for="beriaItem in berita" :key="beriaItem.id">
          {{ beriaItem.judul }}
          <button @click="$router.push(`/berita/${beriaItem.id}/edit`)">Edit</button>
          <button @click="deleteBerita(beriaItem.id)">Delete</button>
        </li>
      </ul>
      </div>
      <AdminFooter />
    </div>
  </template>
  
  <script>
  export default {
    // middleware: 'auth',
    data() {
      return {
        berita: []
      }
    },
    async fetch() {
      const response = await this.$axios.get('/berita');
      this.berita = response.data;
      console.log(response.data);
    },
    methods: {
      async deleteBerita(id) {
        await this.$axios.delete(`/berita/${id}`);
        this.berita = this.berita.filter(berita => berita.id !== id);
      }
    }
  }
  </script>
  
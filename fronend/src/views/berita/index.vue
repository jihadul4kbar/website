<template>
    <div>
        <div class="container">
            <div class="row m-5">
                <div class="col-3">
                    <ul class="list-group">
                        <li class="list-group-item"><RouterLink to="/dashboard">Dashboard</RouterLink></li>
                        <li class="list-group-item"><RouterLink to="/berita">Berita</RouterLink></li>
                        <li @click.prevent="logout" class="list-group-item" style="cursor:pointer">Logout</li>
                    </ul>
                </div>
                <div class="col-9">
                    <h1> Berita</h1>
                    <router-link :class="['btn btn-md btn-info mb-2']" to="/tambahBerita">Tambah Berita</router-link>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Judul</th>
                                <th>Isi</th>
                                <th>Gambar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="row in berita" :key="row.id">
                                <td>{{row.judul}}</td>
                                <td>{{row.isi}}</td>
                                <td>{{row.gambar}}</td>
                                <td>
                                    <RouterLink :to="{name: 'editBerita', params: { id: row.id }}" class="btn btn-sm btn-primary mr-2">EDIT</RouterLink>
                                    <button @click.prevent="BeritaDelete(row.id, index)" class="btn btn-sm btn-danger">HAPUS</button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
import { onMounted, ref } from 'vue'
import { useRouter } from 'vue-router'
import axios from 'axios'
export default {
    data(){
        return{
            berita: []
        }
    },
    created() {
        const token = localStorage.getItem('token')
            if(!token) {
                return router.push({
                    name: 'login'
                })
            }
        axios.defaults.headers.common.Authorization = `Bearer ${token}`
        const API_URL = import.meta.env.VITE_API_URL+'berita'
        axios.get(API_URL).then(response => {
            this.berita = response.data.data;
        }).catch(error => {
                console.log(error.response.data)
        });
    },
    methods: {
            BeritaDelete(id, index)
            {
                const token = localStorage.getItem('token')
                if(!token) {
                        return router.push({
                            name: 'login'
                        })
                    }
                axios.defaults.headers.common.Authorization = `Bearer ${token}`
                const API_URL = import.meta.env.VITE_API_URL+'berita'
                axios.delete(API_URL+`/${id}`)
                    .then(response => {
                        this.berita.splice(index, 1);
                        console.log(response);
                    }).catch(error => {
                    console.log(error.response);
                });
            }
        }

}
</script>
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
                    <div v-if="errors.length">
                        <div v-for="error in errors" :key="error.index" class="alert alert-danger mt-1" role="alert">
                            {{ error }}
                        </div>
                    </div>
                        <div class="card-body">
                            <form @submit.prevent="BeritaUpdate">

                                <div class="form-group">
                                    <label>Judul</label>
                                    <input type="text" class="form-control" v-model="berita.judul" placeholder="Masukkan Judul">
                                </div>

                                <div class="form-group">
                                    <label>Isi</label>
                                    <textarea class="form-control" v-model="berita.isi" rows="5" placeholder="Masukkan Konten"></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Gambar</label>
                                    <input type="text" class="form-control" v-model="berita.gambar" placeholder="Masukkan Gambar">
                                </div>
                                <button type="submit" class="btn btn-md btn-success mr-2">SIMPAN</button>
                                <button type="reset" class="btn btn-md btn-danger">RESET</button>

                            </form>
                        </div>

                </div>
            </div>
        </div>
    </div>
</template>
<script>
    import axios from 'axios'
    export default {
        data() {
            return {
                berita: {},
                errors: []
            }
        },
        created() {
            const token = localStorage.getItem('token')
            axios.defaults.headers.common.Authorization = `Bearer ${token}`
            const API_URL = import.meta.env.VITE_API_URL+'berita'
            // axios.get(API_URL+`/${this.$route.params.id}`)
            axios.get(`http://127.0.0.1:8000/api/berita/${this.$route.params.id}`)
                .then((response) => {
                    this.berita = response.data.data;
                    console.log("tes")
                });
        },
        methods: {
            BeritaUpdate(e) {

                if (this.berita.judul && this.berita.isi && this.berita.gambar) {
                    const token = localStorage.getItem('token')
                    axios.defaults.headers.common.Authorization = `Bearer ${token}`
                    const API_URL = import.meta.env.VITE_API_URL+'berita'
                    axios.put(API_URL+`/${this.$route.params.id}`, this.berita)
                        .then((response) => {
                            this.$router.push({
                                name: 'berita'
                            });
                            console.log(response);
                        }).catch(error => {
                            console.log(error.response.data.data);
                        });
                }

                this.errors = [];

                if (!this.berita.judul) {
                    this.errors.push('Masukkan Judul Berita.');
                }

                if (!this.berita.isi) {
                    this.errors.push('Masukkan Isi Berita.');
                }
                if (!this.berita.gambar) {
                    this.errors.push('Masukkan Gambar Berita.');
                }

                e.preventDefault()
            }
        }
    }
</script>
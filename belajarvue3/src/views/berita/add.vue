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
                            <form @submit.prevent="BeritaStore">

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
    import { useRouter } from 'vue-router'
    import axios from 'axios'

    export default {
        data() {
            return {
                berita: {},
                errors: []
            }
        },
        methods: {
            BeritaStore(e) {
                if (this.berita.judul && this.berita.isi && this.berita.gambar) {
                    const token = localStorage.getItem('token')
                    axios.defaults.headers.common.Authorization = `Bearer ${token}`
                    const API_URL = import.meta.env.VITE_API_URL+'berita'
                    axios.post(API_URL, this.berita)
                        .then(() => {
                            this.$router.push({
                                name: 'berita'
                            });
                        }).catch(error => {
                            console.log(error.response);
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
                    this.errors.push('Masukkan Isi Gambar.');
                }

                e.preventDefault();

            }
        }
    }
</script>

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
                    <h1> Dahsboard</h1>
                    Selamat Datang <strong>{{ user.name }}</strong>
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
                    //console.log(response.data.name)
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
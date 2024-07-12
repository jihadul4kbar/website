<template>
    <div class="p-3 p-md-4 p-xl-5">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6 bsb-tpl-bg-platinum">
                    <div class="d-flex flex-column justify-content-between h-100 p-3 p-md-4 p-xl-5">
                    <h3 class="m-0">Welcome!</h3>
                    <img class="img-fluid rounded mx-auto my-4" loading="lazy" src="../assets/img/lombok.jpg" width="100%" alt="Lombok">
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
                                    <input v-model="user.name" class="form-control" type="text" placeholder="Name" />
                                </div>
                                <div v-if="validation.name" class="mt-2 alert alert-danger">
                                        {{ validation.name[0] }}
                                    </div>
                                <div class="col-12">
                                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                    <input v-model="user.email" class="form-control" type="email" placeholder="Email" />
                                </div>
                                <div v-if="validation.email" class="mt-2 alert alert-danger">
                                        {{ validation.email[0] }}
                                    </div>
                                <div class="col-12">
                                    <label for="email" class="form-label">Password <span class="text-danger">*</span></label>
                                    <input v-model="user.password" class="form-control" type="password" placeholder="Password" />
                                </div>
                                <div v-if="validation.password" class="mt-2 alert alert-danger">
                                        {{ validation.password[0] }}
                                    </div>
                                <div class="col-12">
                                    <label for="email" class="form-label">Comfirm Password <span class="text-danger">*</span></label>
                                    <input v-model="user.password_confirmation" class="form-control" type="password" placeholder="Confirm Password" />
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
                name: '',
                email: '',
                password: '',
                password_confirmation: ''
            })
            //state validation
            const validation = ref([])
            //method register
            function register() {
                //define variable 
                let name = user.name
                let email = user.email
                let password = user.password
                let password_confirmation = user.password_confirmation
                const API_URL = import.meta.env.VITE_API_URL+'register'
                //send server with axios
                axios.post(API_URL, {
                        name,
                        email,
                        password,
                        password_confirmation
                })
                .then(() => {
                    //redirect ke halaman login
                    return router.push({
                        name: 'login'
                    })
                }).catch(error => {
                    //set validation dari error response
                    validation.value = error.response.data
                })
            }
            return {
                user, // <-- state user
                validation, // <-- state validation 
                register // <-- method register
            }

        }

    }
</script>
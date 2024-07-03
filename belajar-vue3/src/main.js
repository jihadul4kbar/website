import './assets/main.css'
import '../node_modules/bootstrap/dist/css/bootstrap.min.css'
import 'bootstrap'

import vue, { render } from 'vue'
import App from './App.vue'
import router from './router'

Vue.config.productionTip = false

new Vue({
    router,
    render:h => h(App),
}).$mount('#app');
// import { createApp } from 'vue'
// createApp(App).mount('#app')

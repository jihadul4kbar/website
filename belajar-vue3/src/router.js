import Vue from "vue";
import Router from "vue-router";

Vue.use(Router);

export default new Router({
    mode: "history",
    routes:[
        {
            path: "/",
            alias: "/halamanutama",
            name : "halamanutama",
            component: () => import("./components/SlideUtama.vue")
            },
        {
            path: "/",
            alias: "/berita",
            name : "berita",
            component: () => import("./components/berita/IndexBerita.vue")
        }
    ]
})
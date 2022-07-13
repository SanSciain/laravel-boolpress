import Vue from 'vue';
import VueRouter from 'vue-router';
Vue.use(VueRouter);


import Home from "./pages/Home";
import PostsPage from "./pages/PostsPage";
import About from "./pages/About";
import NotFound from "./pages/NotFound";

const router = new VueRouter({
    mode: "history",
    routes: [
        {
            path: "/",
            name: "home",
            component: Home
        },
        {
            path: "/posts",
            name: "posts",
            component: PostsPage
        },
        {
            path: "/about",
            name: "about",
            component: About
        },
        {
            path: "/*",
            component: NotFound
        }
    ]
});

export default router;
<template>
    <div>
        <nav>
            <ul>
                <li><router-link :to="{ name: 'home' }">Home</router-link></li>
                <li>
                    <router-link :to="{ name: 'about' }">About</router-link>
                </li>
                <li>
                    <router-link :to="{ name: 'posts' }">Posts</router-link>
                </li>
            </ul>
        </nav>
        <h1>FrontOffice</h1>
        <router-view></router-view>
    </div>
</template>

<script>
import Posts from "../components/Posts.vue";

export default {
    name: "App",
    components: {
        Posts,
    },
};
</script>

<style></style>

<template>
    <div class="container">
        <p>Posts Found: {{ totalPosts }}</p>

        <select
            class="form-select"
            aria-label="Default select example"
            v-model="itemsPerPage"
            @change="getPosts(1)"
        >
            <option selected>Open this select menu</option>
            <option value="4">4</option>
            <option value="6">6</option>
        </select>

        <div class="row flex-column">
            <div class="card my-3" v-for="item in posts" :key="item.id">
                <div class="card-body">
                    <h5 class="card-title">{{ item.title }}</h5>
                    <p class="card-text">
                        {{ item.content }}
                    </p>
                    <router-link
                        :to="{
                            name: 'single-post',
                            params: { slug: item.slug },
                        }"
                        >Show More</router-link
                    >
                </div>
            </div>
        </div>

        <nav aria-label="...">
            <ul class="pagination">
                <li class="page-item" :class="{ disabled: currentPage === 1 }">
                    <a
                        @click="getPosts(currentPage - 1)"
                        class="page-link"
                        href="#"
                        tabindex="-1"
                        >Previous</a
                    >
                </li>
                <li
                    v-for="n in lastPage"
                    :key="n"
                    class="page-item"
                    :class="{ active: currentPage === n }"
                >
                    <a @click="getPosts(n)" class="page-link" href="#">{{
                        n
                    }}</a>
                </li>
                <li
                    class="page-item"
                    :class="{ disabled: currentPage === lastPage }"
                >
                    <a
                        @click="getPosts(currentPage + 1)"
                        class="page-link"
                        href="#"
                        >Next</a
                    >
                </li>
            </ul>
        </nav>
    </div>
</template>

<script>
export default {
    name: "Posts",
    data() {
        return {
            posts: [],
            currentPage: 1,
            lastPage: 0,
            totalPosts: 0,
            itemsPerPage: 4,
        };
    },
    created() {
        this.getPosts(1);
    },
    methods: {
        getPosts(nPage) {
            axios
                .get("/api/posts", {
                    params: {
                        page: nPage,
                        items_per_page: this.itemsPerPage,
                    },
                })
                .then((resp) => {
                    this.posts = resp.data.results.data;
                    this.currentPage = resp.data.results.current_page;
                    this.lastPage = resp.data.results.last_page;
                    this.totalPosts = resp.data.results.total;
                });
        },
    },
};
</script>

<style></style>

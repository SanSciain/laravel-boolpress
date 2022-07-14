<template>
    <div>
        <section v-if="post">
            <div class="card-body">
                <h5 class="card-title">{{ post.title }}</h5>
                <h6>
                    Category: {{ post.category ? post.category.name : "none" }}
                </h6>
                <div class="tags">
                    <span v-for="tag in post.tags" :key="tag.id">{{
                        tag.name
                    }}</span>
                </div>
                <p class="card-text">
                    {{ post.content }}
                </p>
            </div>
        </section>
        <section v-else>Loading...</section>
    </div>
</template>

<script>
export default {
    name: "SinglePost",
    data() {
        return {
            post: null,
        };
    },
    created() {
        this.getDetails();
    },
    methods: {
        getDetails() {
            const slug = this.$route.params.slug;
            axios.get(`/api/posts/${slug}`).then((resp) => {
                console.log(resp.data);
                if (resp.data.success) {
                    this.post = resp.data.results;
                } else {
                    this.$router.push({ name: "not-found" });
                }
            });
        },
    },
};
</script>

<style></style>

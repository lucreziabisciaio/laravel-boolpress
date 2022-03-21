<template>
  <div>
      <h1>{{ post.title }}</h1>
      <!-- <img :src="post.cover" alt=""> -->

      <div v-html="post.content"></div>
  </div>
</template>

<script>
import axios from "axios";

export default {
    data() {
        return {
            post: {}
        }
    },
    methods: {
        async fetchPost() {
            try {
                const resp = await axios.get("/api/posts/" + this.$route.params.post);
                this.post = resp.data;
            } catch (er) {
                this.$router.replace({ name: "error" });
            }
        },
    },
    mounted() {
        console.log(this.$route.params.post);
        this.fetchPost();
    }

}
</script>

<style>

</style>
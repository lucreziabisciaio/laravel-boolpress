<template>
  <div>
      <div>
        <button class="btn btn-primary" @click="fetchPosts">refresh</button>
      </div>

      <div class="row row-cols-1 row-cols-md-2 g-4">
        <PostCard
          v-for="post of posts"
          :key="post.id"
          :post="post"
          >
        </PostCard>
      </div>

      <nav aria-label="Page navigation example">
        <ul class="pagination">
          <li class="page-item">
            <a
              class="page-link"
              @click="fetchPosts(pagination.current_page - 1)"
              >Previous</a
            >
          </li>
          <li class="page-item">
            {{ pagination.current_page }} su {{ pagination.last_page }}
          </li>
          <li class="page-item">
            <a
              class="page-link"
              @click="fetchPosts(pagination.current_page + 1)"
              >Next</a
            >
          </li>
        </ul>
      </nav>
  </div>
</template>

<script>
import PostCard from "../components/PostCard.vue";
import axios from "axios";

export default {
    components: {
        PostCard,
    },
    data() {
        return {
        posts: [],
        pagination: {},
        };
    },
    methods: {
        async fetchPosts(page = 1) {
            if (page < 1) {
                page = 1;
            }
            if (page > this.pagination.last_page) {
                page = this.pagination.last_page;
            }

            const resp = await axios.get("http://127.0.0.1:8000/api/posts?page=" + page);
            this.pagination = resp.data;
            this.posts = resp.data.data;
        },
    },
    mounted() {
        this.fetchPosts();
    },
}
</script>

<style>

</style>
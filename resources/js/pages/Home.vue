<template>
  <div>
    <div class="py-2">
      <button class="btn btn-secondary" @click="fetchPosts"><i class="far fa-redo"></i></button>
    </div>

    <div class="row row-cols-1 row-cols-md-2 g-4">
      <PostCard
        v-for="post of posts"
        :key="post.id"
        :post="post"
        >
      </PostCard>
    </div>

    <div class="container d-flex justify-content-center pt-4 pb-2">
      <nav aria-label="Page navigation example">
        <ul class="pagination container d-flex align-items-center">
          <li class="page-item">
            <a
              class="page-link"
              @click="fetchPosts(pagination.current_page - 1)"
              >Previous</a
            >
          </li>
          <li class="page-item px-2">
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
  .btn i {
    font-family: "Font Awesome 5 Free";
    font-weight: 700;
  }
</style>
<template>
  <div class="col">
    <div class="card">
      <img :src="post.cover" class="card-img-top" alt="..." />
      <div class="card-body">
        <h5 class="card-title">{{ post.title }}</h5>
        <p class="card-text" v-html="post.content"></p>

        <em>Autore: {{ post.user.name }}; Data: {{ formatDate(post.created_at) }}</em><br />
        <strong v-if="post.category">{{ post.category.code }}</strong>
      </div>

      <div class="card-footer">
        <router-link :to="{ name:'posts.show', params: { post: post.slug } }">Dettagli</router-link>
      </div>
    </div>
  </div>
</template>

<script>
import dayjs from "dayjs";

export default {
  props: {
    post: Object,
  },
  methods: {
    // getPostCover(post) {
    //   return (
    //     post.cover ?? "https://www.logistec.com/wp-content/uploads/2017/12/placeholder.png"
    //   );
    // },
    formatDate(date) {
      return dayjs(date).format('DD/MM/YYYY HH:mm')
    },
  },
};
</script>
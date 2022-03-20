<template>
  <div class="col">
    <div class="card">
      <img :src="getPostCover(post)" class="card-img-top" alt="..." />
      <div class="card-body">
        <h5 class="card-title">{{ post.title }}</h5>
        <p class="card-text" v-html="post.content"></p>

        <em>Autore: {{ post.user.name }}; Data: {{ post.created_at }}</em><br />
        <strong v-if="post.category">{{ post.category.code }}</strong>
      </div>

      <div class="card-footer">
        <a href="#">Dettagli</a>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    post: Object,
  },
  methods: {
    getPostCover(post) {
      return (
        post.coverImg ??
        "https://www.logistec.com/wp-content/uploads/2017/12/placeholder.png"
      );
    },
  },
};
</script>
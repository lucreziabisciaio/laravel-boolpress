<template>
  <div>
    <TheNavbar></TheNavbar>

    <div class="container py-4">
      <!-- home.vue -->
      <router-view></router-view>
    </div> 

    <TheFooter></TheFooter>
  </div>
</template>

<script>
import TheNavbar from "../components/TheNavbar.vue";
import TheFooter from "../components/TheFooter.vue";

export default {
  components: {
    TheNavbar,
    TheFooter,
  },
};
</script>

<style></style>
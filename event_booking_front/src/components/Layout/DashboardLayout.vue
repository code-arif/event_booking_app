<script setup>
import Navbar from '@/components/Includes/Navbar.vue'
</script>

<template>
  <Navbar/>

  <div class="container mt-5 bg-light">
    <slot></slot>
  </div>

</template>

<style scoped>

</style>

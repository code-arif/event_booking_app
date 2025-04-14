<script setup>
import {RouterView, RouterLink} from "vue-router";
</script>

<template>
  <div class="wrapper">
    <!-- Sidebar  -->
    <nav id="sidebar">
      <div class="sidebar-header">
        <h3>Bootstrap Sidebar</h3>
      </div>

      <ul class="list-unstyled components">
        <p>Dummy Heading</p>
        <li class="active">
          <RouterLink :to="{name: 'Home'}">Home</RouterLink>
        </li>
        <li>
          <RouterLink :to="{name: 'About'}">About</RouterLink>
        </li>
        <li>
          <RouterLink :to="{name: 'Contact'}">Contact</RouterLink>
        </li>
        <li>
          <RouterLink :to="{name: 'Blog'}">Blog</RouterLink>
        </li>
        <li>
          <RouterLink to="post/1">Post 1</RouterLink>
        </li>
        <li>
          <RouterLink to="post/2">Post 2</RouterLink>
        </li>
        <li>
          <RouterLink to="post/3">Post 3</RouterLink>
        </li>
      </ul>
    </nav>

    <!-- Page Content  -->
    <div id="content">
      <RouterView/>
    </div>
  </div>
</template>

<style scoped>

</style>

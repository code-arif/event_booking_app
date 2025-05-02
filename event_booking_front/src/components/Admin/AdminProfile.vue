<script setup></script>
<template>
  <ul class="list-unstyled" v-if="loggedUser">
    <li>Name: {{ loggedUser.name }}</li>
    <li>Email: {{ loggedUser.email }}</li>
    <li>Image:
      <img
          :src="imagePreview"
          alt="User image"
          width="50px"
          class="img-fluid rounded"
      />
    </li>
  </ul>
</template>

<script setup>
import {ref, computed, onMounted} from 'vue';

const loggedUser = ref(null);
const apiUrl = 'http://127.0.0.1:8000';

onMounted(() => {
  const user = localStorage.getItem('user');
  loggedUser.value = JSON.parse(user);
});

// Computed property use kore dynamic image show korbo
const imagePreview = computed(() => {
  if (loggedUser.value && loggedUser.value.image) {
    return `${apiUrl}/storage/${loggedUser.value.image}`;
  } else {
    return 'https://img.freepik.com/free-vector/blue-circle-with-white-user_78370-4707.jpg';
  }
});
</script>
<template>
  <DashboardLayout>
    <div class="row p-3">
      <div class="col-md-4">
        Home
      </div>
      <div class="col-md-8">
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
      </div>
    </div>
  </DashboardLayout>
</template>

<script setup>
import DashboardLayout from "@/components/Layout/DashboardLayout.vue";
import { ref, computed, onMounted } from 'vue';

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

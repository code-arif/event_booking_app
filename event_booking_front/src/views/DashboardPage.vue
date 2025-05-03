<template>
  <DashboardLayout>
    <div class="row p-3">
      <div class="col-md-12 mb-2 pb-2 pt-2" style="border: 1px solid #ddd">
        <h4> Member Dashboard </h4>
      </div>
      <div class="col-md-12" style="border: 1px solid #ddd">
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
import {ref, computed, onMounted} from 'vue';
import {useToast} from "vue-toast-notification";

const loggedUser = ref(null);
const apiUrl = 'http://127.0.0.1:8000';
const toast = useToast();

onMounted(() => {
  const user = localStorage.getItem('user');
  loggedUser.value = JSON.parse(user);

  const channel = window.Echo.channel('first_broadcast')
  channel.listen('.booking-status', (data) => {
    const message = data.bookingData.user.name + ' event ' + data.bookingData.event.title + 'booking ' + data.bookingData.status
    toast.success(message);
  });
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

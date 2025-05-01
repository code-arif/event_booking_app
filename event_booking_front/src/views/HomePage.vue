<script setup>
import GuestLayout from '@/components/Layout/GuestLayout.vue'
import api from '@/api/axios';
import { onMounted, ref } from "vue";
import { useRouter } from "vue-router";
import { useToast } from 'vue-toast-notification';


const router = useRouter();
const events = ref([]);
const toast = useToast();


onMounted(async () => {
  try {
    const res = await api.get('/event');
    if (res.status) {
      events.value = res.data.data;
    }
  } catch (error) {
    console.log(error);
  }
});

const formatedDate = (date) => {
  const d = new Date(date);
  return d.toLocaleString();
}

//booking-handling
const handleBooking = (event) => {
  const loggedInUser = localStorage.getItem('user');

  if (!loggedInUser) {
    toast.error('User not found');
  } else {
    toast.success(`User was logged in`);
  }
}
</script>

<template>
  <GuestLayout>
    <div class="container">
      <div class="row">
        <div class="col-md-3" v-for="event in events" :key="event.id">
          <div class="card mt-5" style="width: 18rem;">
            <div class="card-body">
              <h5 class="card-title">{{ event?.title }}</h5>
              <p class="card-text">{{ event?.description }}</p>
              <p class="card-text">{{ formatedDate(event?.start_date) }}</p>
              <p class="card-text">{{ formatedDate(event?.end_date) }}</p>
              <button @click="handleBooking(event)" class="btn btn-primary">Book</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </GuestLayout>
</template>

<template>
  <div class="card-header">
    <h5 class="card-title mb-3 mt-3 text-center">Booking status update</h5>
    <hr>
  </div>
  <div class="card-body p-3">
    <form @submit.prevent="bookingUpdate()">
      <!--  booking status -->
      <div class="mb-3">
        <label for="status" class="form-label">Booking status</label>
        <select v-model="booking_status.status" class="form-select">
          <option value="pending">Pending</option>
          <option value="confirmed">Confirmed</option>
          <option value="cancelled">Cancel</option>
        </select>
      </div>
      <button type="submit" class="btn btn-primary">
        Save changes
      </button>
    </form>
  </div>
</template>

<script setup>
import {useRoute, useRouter} from "vue-router";
import {ref, onMounted} from 'vue';
import api from "@/api/axios.js";
import {useToast} from "vue-toast-notification";

const loggedUser = ref(null);
const booking_status = ref({});
const route = useRoute();
const router = useRouter();
const toast = useToast();

onMounted(() => {
  const user = localStorage.getItem('user');
  loggedUser.value = JSON.parse(user);

  const booking_id = route.params.id;
  if (booking_id) {
    api.get(`/booking/by/${booking_id}`).then((response) => {
      booking_status.value = response.data.data;
      // console.log(booking_status.value);
    });
  }
});

//update booking status
const bookingUpdate = () => {
  const bookingId = route.params.booking_id;
  api.put(`/booking/status-change/${bookingId}`,booking_status.value).then((response) => {
    toast.success(response.data.message);
    setTimeout(() => {
      router.push("/admin/bookings");
    }, 2000)
  })
}
</script>

<template>
  <DashboardLayout>
    <div class="p-3">
      <div class="col-12 mb-3 p-3" style="border: 1px solid #ddd;">
        Booking confirmation
      </div>

      <div class="col-12 p-3" style="border: 1px solid #ddd;">
        <h3>User Information</h3>
        <ul class="list-unstyled" v-if="loggedUser">
          <li>Name: {{ loggedUser.name }}</li>
          <li>Email: {{ loggedUser.email }}</li>
          <li>Image:
            <img :src="imagePreview" alt="User image" width="50px" class="img-fluid rounded"/>
          </li>
        </ul>
      </div>

      <div class="col-12 mt-3 p-3" style="border: 1px solid #ddd;">
        <div class="row">
          <div class="col-md-6 p-3">
            <h3>Event Information</h3>
            <ul class="list-unstyled">
              <li>Name: {{ event?.title }}</li>
              <li>Email: {{ event?.description }}</li>
              <li>Ticket Price: {{ event?.ticket_price }}</li>
              <li>Start Date: {{ event?.start_date }}</li>
              <li>End Date: {{ event?.end_date }}</li>
            </ul>
          </div>

          <div class="col-md-6 p-3">
            <h3>Booking Confirm</h3>
            <form @submit.prevent="bookingConfirm()">
              <div class="mb-3">
                <label for="ticket_qty" class="form-label">Ticket qty</label>
                <input type="number" class="form-control" id="ticket_qty" placeholder="Enter ticket qty"
                       v-model="ticket_qty"/>
              </div>
              <button type="submit" class="btn btn-primary">
                Confirm
              </button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </DashboardLayout>
</template>

<script setup>
import DashboardLayout from "@/components/Layout/DashboardLayout.vue";
import {ref, computed, onMounted} from 'vue';
import api from "@/api/axios.js";
import {useToast} from "vue-toast-notification";
import {useRoute} from "vue-router";

const loggedUser = ref(null);
const apiUrl = 'http://127.0.0.1:8000';
const event = ref({});
const route = useRoute();
const ticket_qty = ref(1);
const toast = useToast();

onMounted(() => {
  const user = localStorage.getItem('user');
  loggedUser.value = JSON.parse(user);
  const event_id = route.query.event_id;
  if (event_id) {
    api.get(`/event/${event_id}`).then((response) => {
      event.value = response.data.data;
      // console.log(event.value);
    });
  }

});

// Computed property use kore dynamic image show korbo
const imagePreview = computed(() => {
  if (loggedUser.value && loggedUser.value.image) {
    return `${apiUrl}/storage/${loggedUser.value.image}`;
  } else {
    return 'https://img.freepik.com/free-vector/blue-circle-with-white-user_78370-4707.jpg';
  }
});

//booking confirm
const bookingConfirm = () => {
  api.post(`/booking/create`, {
    user_id: loggedUser.value.id,
    event_id: event.value.id,
    ticket_qty: ticket_qty.value,
  }).then((response) => {
    toast.success("Booking confirmed successfully!");
  }).catch((error) => {
    toast.error("Booking failed!");
  });
};
</script>
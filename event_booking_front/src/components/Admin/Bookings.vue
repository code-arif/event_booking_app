<template>
  <div class="card-header">
    <h5 class="card-title mb-3 mt-3 text-center">All bookings with users</h5>
    <hr>
  </div>

  <div class="card-body p-3">
    <table class="table" v-if="bookings">
      <thead>
      <tr>
        <th scope="col">SN</th>
        <th scope="col">Member Name</th>
        <th scope="col">Title</th>
        <th scope="col">Start Date</th>
        <th scope="col">End Date</th>
        <th scope="col">Ticket Price</th>
        <th scope="col">Ticket qty</th>
        <th scope="col">Total Price</th>
        <th scope="col">Status</th>
        <th scope="col">Action</th>
      </tr>
      </thead>
      <tbody>
      <tr v-for="(booking, index) in bookings" :key="booking.id">
        <th scope="row">{{ index + 1 }}</th>
        <td>{{ booking?.user?.name }}</td>
        <td>{{ booking?.event?.title }}</td>
        <td>{{ formatedDate(booking?.event?.start_date) }}</td>
        <td>{{ formatedDate(booking?.event?.end_date) }}</td>
        <td>{{ booking?.event?.ticket_price }}</td>
        <td>{{ booking?.ticket_qty }}</td>
        <td>{{ booking?.total_price }}</td>
        <td :class="statusClass(booking.status)">
          {{ booking?.status }}
        </td>
        <td>
          <RouterLink class="btn btn-sm btn-warning" :to="`/admin/booking/edit/${booking.id}`"> Edit
          </RouterLink>
        </td>
      </tr>
      </tbody>
    </table>
  </div>
</template>

<script setup>
import api from '@/api/axios';
import {onMounted, ref} from "vue";

const bookings = ref([]);
const loggedInUser = ref(null);

onMounted(async () => {
  const user = localStorage.getItem("user");
  loggedInUser.value = JSON.parse(user);
  try {
    const res = await api.get(`booking`);
    if (res.status) {
      bookings.value = res.data.data;
    }
  } catch (error) {
    console.log(error);
  }
});

//date fomration
const formatedDate = (date) => {
  const d = new Date(date);
  return d.toLocaleString();
}

const statusClass = (status) => {
  switch (status) {
    case 'confirmed':
      return 'text-success'; // green
    case 'cancelled':
      return 'text-danger'; // red
    case 'pending':
      return 'text-warning'; // yellow
    default:
      return '';
  }
}
</script>
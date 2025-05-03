<script setup>
import DashboardLayout from "@/components/Layout/DashboardLayout.vue";
import api from '@/api/axios';
import {onMounted, ref} from "vue";

const bookings = ref([]);
const loggedInUser = ref(null);

onMounted(async () => {
  const user = localStorage.getItem("user");
  loggedInUser.value = JSON.parse(user);
  try {
    const res = await api.get(`booking/member/${loggedInUser.value.id}`);
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
</script>

<template>
  <DashboardLayout>
    <div class="container mt-5 bg-light p-3">
      <div class="card-body">
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
            <td>{{ booking?.status }}</td>
          </tr>
          </tbody>
        </table>
      </div>
    </div>
  </DashboardLayout>
</template>
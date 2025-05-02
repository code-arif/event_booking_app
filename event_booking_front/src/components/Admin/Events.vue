<script setup>
import api from '@/api/axios';
import {onMounted, ref} from "vue";
import {RouterLink} from "vue-router";

const events = ref([]);


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

//date fomration
const formatedDate = (date) => {
  const d = new Date(date);
  return d.toLocaleString();
}
</script>

<template>
  <div class="card-body">
    <table class="table" v-if="events">
      <thead>
      <tr>
        <th scope="col">SN</th>
        <th scope="col">Title</th>
        <th scope="col">Start Date</th>
        <th scope="col">End Date</th>
        <th scope="col">Ticket Price</th>
        <th scope="col">Action</th>
      </tr>
      </thead>
      <tbody>
      <tr v-for="(event, index) in events" :key="event.id">
        <th scope="row">{{ index + 1 }}</th>
        <td>{{ event.title }}</td>
        <td>{{ formatedDate(event?.start_date) }}</td>
        <td>{{ formatedDate(event?.end_date) }}</td>
        <td>{{ event?.ticket_price }}</td>
        <td>
          <RouterLink class="btn btn-sm btn-warning" :to="`/admin/event/edit/${event.id}`"> Edit
          </RouterLink>
        </td>
      </tr>
      </tbody>
    </table>
  </div>
</template>
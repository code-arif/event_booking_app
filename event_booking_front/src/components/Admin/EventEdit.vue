<template>
  <div class="card-header">
    <h5 class="card-title mb-3 mt-3 text-center">Event update</h5>
    <hr>
  </div>
  <div class="card-body p-3">
    <form @submit.prevent="eventUpdate()">
      <!--      event title-->
      <div class="mb-3">
        <label for="title" class="form-label">Event title</label>
        <input type="text" class="form-control" id="title" placeholder="Enter Full Name" v-model="event.title"/>
        <div class="text-danger" v-if="event.title"></div>
      </div>

      <!--      event description-->
      <div class="mb-3">
        <label for="title" class="form-label">Event description</label>
        <textarea type="text" class="form-control" id="title" placeholder="Enter event description"
                  v-model="event.description"/>
        <div class="text-danger" v-if="event.description"></div>
      </div>

      <!--      event ticket price-->
      <div class="mb-3">
        <label for="ticket_price" class="form-label">Event ticket price</label>
        <input type="text" class="form-control" id="ticket_price" placeholder="Enter ticket price"
               v-model="event.ticket_price"/>
      </div>

      <!--      event start date-->
      <div class="mb-3">
        <label for="title" class="form-label">Event start date</label>
        <input type="text" class="form-control" id="title" placeholder="Enter event start date"
               v-model="event.start_date"/>
        <div class="text-danger" v-if="event.start_date"></div>
      </div>

      <!--      event end date-->
      <div class="mb-3">
        <label for="title" class="form-label">Event start date</label>
        <input type="text" class="form-control" id="title" placeholder="Enter event end date"
               v-model="event.end_date"/>
        <div class="text-danger" v-if="event.end_date"></div>
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
const event = ref({});
const route = useRoute();
const router = useRouter();
const toast = useToast();

onMounted(() => {
  const user = localStorage.getItem('user');
  loggedUser.value = JSON.parse(user);

  const event_id = route.params.id;
  if (event_id) {
    api.get(`/event/${event_id}`).then((response) => {
      event.value = response.data.data;
      // console.log(event.value);
    });
  }
});

//update event
const eventUpdate = () => {
  const eventId = route.params.event_id;
  api.put(`/event/update/${eventId}`,event.value).then((response) => {
    toast.success(response.data.message);
    setTimeout(() => {
    router.push("/admin/events");
    }, 2000)
  })
}
</script>

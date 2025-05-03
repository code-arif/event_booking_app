<script setup>
import DashboardLayout from "@/components/Layout/DashboardLayout.vue";
import {RouterLink, RouterView} from "vue-router";
</script>
<template>
  <DashboardLayout>
    <div class="row p-3">
      <div class="col-md-12 mb-2 pb-2 pt-2" style="border: 1px solid #ddd">
        <h4> Admin Dashboard </h4>
      </div>
      <div class="col-md-12" style="border: 1px solid #ddd">
        <div class="row">

          <div class="col-md-2" style="border: 1px solid #ddd">
            <ul class="list-unstyled">
              <li>
                <RouterLink to="/admin/admin-profile"> Profile </RouterLink>
              </li>
              <li>
                <RouterLink to="/admin/events"> Events </RouterLink>
              </li>
              <li>
                <RouterLink to="/admin/bookings"> Bookings </RouterLink>
              </li>
            </ul>
          </div>

          <div class="col-md-10" style="border: 1px solid #ddd">
            <RouterView></RouterView>
          </div>
        </div>
      </div>
    </div>
  </DashboardLayout>
</template>


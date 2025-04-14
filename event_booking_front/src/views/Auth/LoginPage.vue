<script setup>
import GuestLayout from '@/components/Layout/GuestLayout.vue'
import {ref} from "vue";
import api from "@/api/axios";
import {useRouter} from "vue-router";
import {useToast} from 'vue-toast-notification';

const email = ref("");
const password = ref("");
const router = useRouter();
const toast = useToast();
const errors = ref({});
const loading = ref(false);

const login = async () => {
  loading.value = true;
  try {
    const res = await api.post("/login", {
      email: email.value,
      password: password.value
    });
    if (res.status) {
      localStorage.setItem("token", res.data.token);
      localStorage.setItem("user", res.data);
      toast.success("Login successfully");
      router.push("/");
    }
  } catch (err) {
    if (err.response && err.response.status === 422) {
      errors.value = err.response.data.error;
    } else {
      toast.error('Something went wrong', {
        position: 'top-right',
      });
    }
  } finally {
    loading.value = false;
  }
}
</script>
<template>
  <GuestLayout>
    <div class="container">
      <div class="row">
        <div class="col-md-6 offset-md-3">
          <div class="card mt-5">
            <div class="card-header">
              <h3 class="card-title mb-0">User Login</h3>
            </div>
            <div class="card-body">
              <form @submit.prevent="login">
                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" class="form-control" id="email" placeholder="Enter Email" v-model="email"/>
                  <div class="text-danger" v-if="errors.email">{{ errors.email[0] }}</div>
                </div>
                <div class="mb-3">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" class="form-control" id="password" placeholder="Enter Password"
                         v-model="password"/>
                  <div class="text-danger" v-if="errors.password">{{ errors.password[0] }}</div>
                </div>
                <button type="submit" class="btn btn-primary" :disabled="loading">
                  {{ loading ? 'Loading...' : 'Login' }}
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </GuestLayout>
</template>
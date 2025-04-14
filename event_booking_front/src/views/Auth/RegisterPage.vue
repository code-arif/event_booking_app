<script setup>
import GuestLayout from '@/components/Layout/GuestLayout.vue'
import {ref} from "vue";
import api from '@/api/axios';
import {useRouter} from "vue-router";
import {useToast} from 'vue-toast-notification';

const loading = ref(false);
const router = useRouter();
const toast = useToast();
const errors = ref({});

const initialForm = () => ({
  name: '',
  email: '',
  phone: '',
  password: '',
  password_confirmation: '',
  image: ''
});

const form = ref(initialForm());

const imageHandle = (event) => {
  form.value.image = event.target.files[0];
}

const register = async () => {
  loading.value = true; // Loading start
  try {
    const formdata = new FormData();
    for (const key in form.value) {
      formdata.append(key, form.value[key]);
    }

    const res = await api.post('/user-registration', formdata, {
      headers: {
        'Content-Type': 'multipart/form-data',
      }
    });
    toast.success(res.data.message);
    // Form reset after successful submission
    form.value = initialForm();
    router.push('/login');
  } catch (err) {
    if (err.response && err.response.status === 422) {
      errors.value = err.response.data.error;
    } else {
      toast.error('Something went wrong', {
        position: 'top-right',
      });
    }
  } finally {
    loading.value = false; // Loading end
  }
}
</script>

<template>
  <GuestLayout>
    <div class="container">
      <div class="row">
        <div class="col-md-6 offset-md-3">
          <div class="card mt-5 mb-5">
            <div class="card-header">
              <h3 class="card-title mb-0">User Registration</h3>
            </div>
            <div class="card-body">
              <form @submit.prevent="register">
                <div class="mb-3">
                  <label for="name" class="form-label">Full Name</label>
                  <input type="text" class="form-control" id="name" placeholder="Enter Full Name" v-model="form.name"/>
                  <div class="text-danger" v-if="errors.name">{{ errors.name[0] }}</div>
                </div>

                <div class="mb-3">
                  <label for="email" class="form-label">Email</label>
                  <input type="email" class="form-control" id="email" placeholder="Enter Email" v-model="form.email"/>
                  <div class="text-danger" v-if="errors.email">{{ errors.email[0] }}</div>
                </div>

                <div class="mb-3">
                  <label for="phone" class="form-label">Phone</label>
                  <input type="tel" class="form-control" id="phone" placeholder="Enter Phone Number"
                         v-model="form.phone"/>
                  <div class="text-danger" v-if="errors.phone">{{ errors.phone[0] }}</div>
                </div>
                <div class="mb-3">
                  <label for="password" class="form-label">Password</label>
                  <input type="password" class="form-control" id="password" placeholder="Enter Password"
                         v-model="form.password"/>
                  <div class="text-danger" v-if="errors.password">{{ errors.password[0] }}</div>
                </div>
                <div class="mb-3">
                  <label for="c_password" class="form-label">Confirm Password</label>
                  <input type="password" class="form-control" id="c_password" placeholder="Enter Confirm Password"
                         v-model="form.password_confirmation"/>
                  <div class="text-danger" v-if="errors.password">{{ errors.password[0] }}</div>
                </div>
                <div class="mb-3">
                  <label for="image" class="form-label">Image</label>
                  <input type="file" class="form-control" id="image" @change="imageHandle"/>
                  <div class="text-danger" v-if="errors.image">{{ errors.image[0] }}</div>
                </div>
                <button type="submit" class="btn btn-primary" :disabled="loading">
                  {{ loading ? 'Loading...' : 'Registration' }}
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </GuestLayout>
</template>

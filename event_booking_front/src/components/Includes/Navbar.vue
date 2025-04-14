<script setup>
import {RouterView, RouterLink} from "vue-router";
import {useRouter} from "vue-router";
const router = useRouter();

const loggedUser = () => {
  return localStorage.getItem("token") ? true : false;
};

const logout = () => {
  localStorage.removeItem("token");
  localStorage.removeItem("user");
  router.push("/login");
}
</script>
<template>
  <div class="container">
    <div class="row">
      <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <RouterLink class="nav-link" :to="{name: 'home'}" active-class="active" exact-active-class="active">Home</RouterLink>
              </li>
              <template v-if="!loggedUser()">
                <li class="nav-item">
                  <RouterLink class="nav-link" :to="{name: 'login'}" active-class="active" exact-active-class="active">Login</RouterLink>
                </li>
                <li class="nav-item">
                  <RouterLink class="nav-link" :to="{name: 'register'}" active-class="active" exact-active-class="active">Registration</RouterLink>
                </li>
              </template>

              <template v-else>
                <li class="nav-item">
                  <RouterLink class="nav-link" :to="{name: 'dashboard'}">Dashboard</RouterLink>
                </li>
                <li class="nav-item">
                  <button class="btn btn-primary" @click="logout">Logout</button>
                </li>
              </template>
            </ul>
          </div>
        </div>
      </nav>
    </div>
  </div>
</template>
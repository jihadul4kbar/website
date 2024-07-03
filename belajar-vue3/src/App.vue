<script setup>
import AppHeader from './components/AppHeader.vue'
import AppFooter from './components/AppFooter.vue'
</script>

<template>
  <main>
    <AppHeader />
      <div class="container mt-3">
        <router-view />
      </div>
    <AppFooter />
  </main>
</template>

<style scoped>
</style>

<template>
    <div>
      <p v-if="data">Welcome, {{ data.name }}</p>
      <p v-else>Welcome, Guest</p>
    </div>
  </template>
  
  <script>
  export default {
    computed: {
      data() {
        // console.log($auth);
        return this.$auth.data;
      }
    }
  }
  </script>
  
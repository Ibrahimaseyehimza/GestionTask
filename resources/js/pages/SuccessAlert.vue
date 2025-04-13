<template>
    <transition name="fade">
      <div v-if="visible" class="fixed top-5 right-5 bg-green-500 text-white px-4 py-2 rounded shadow-lg z-50">
        ✅ {{ message }}
      </div>
    </transition>
  </template>

  <script>
  export default {
    props: {
      message: String,
    },
    data() {
      return {
        visible: true,
      };
    },
    mounted() {
      setTimeout(() => {
        this.visible = false;
      }, 3000); // L'alerte disparaît après 3 secondes
    },
  };
  </script>

  <style scoped>
  .fade-enter-active, .fade-leave-active {
    transition: opacity 0.5s;
  }
  .fade-enter, .fade-leave-to {
    opacity: 0;
  }
  </style>

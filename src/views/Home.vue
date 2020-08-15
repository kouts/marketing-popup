<template>
  <div class="container">
    <div class="text-center">
      <img alt="Vue logo" src="../assets/logo.png" class="text-center">
      <div class="mb-4">
        <button type="button" class="btn btn-primary" @click="showModalContainer = !showModalContainer">Toggle modal container</button>
      </div>
    </div>
    <modal-container v-if="showModalContainer" />
  </div>
</template>

<script>
import ModalContainer from '@/components/ModalContainer';

export default {
  name: 'Home',
  components: {
    ModalContainer
  },
  data() {
    return {
      showModalContainer: true
    };
  }
};
</script>

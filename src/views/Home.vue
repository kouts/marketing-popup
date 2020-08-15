<template>
  <div class="container">
    <div class="text-center">
      <img alt="Vue logo" src="../assets/logo.png" class="text-center">
    </div>
    <modal-container />
  </div>
</template>

<script>
import ModalContainer from '@/components/ModalContainer';

export default {
  name: 'Home',
  components: {
    ModalContainer
  },
  data: function() {
    return {
      showModal: false
    };
  }
};
</script>

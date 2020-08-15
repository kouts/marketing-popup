<template>
  <div class="row">
    <div class="col text-center">
      <h1 class="heading">Modal container</h1>
      <p>
        A project setup using vue-cli, created to easily scaffold new Vue.js projects.<br />
        Find out more at <a class="custom" href="https://cli.vuejs.org" target="_blank" rel="noopener">vue-cli documentation</a>.
      </p>
      <button type="button" class="btn btn-primary" @click="showModal=true">
        Open a modal
      </button>
      <Modal v-model="showModal" title="My first modal">
        <p>Modal content goes here...</p>
      </Modal>
    </div>
  </div>
</template>

<script>
import { createExitIntent } from '@/common/exit-intent';
import Modal from '@kouts/vue-modal';

export default {
  components: {
    Modal
  },
  data: function() {
    return {
      showModal: false
    };
  },
  mounted() {
    this.exitIntent = createExitIntent({
      onTrigger() {
        console.log('triggered!');
      }
    });
    this.exitIntent.init();
  },
  beforeDestroy() {
    this.exitIntent.destroy();
  }
};
</script>

<style lang="scss" scoped>
  h1.heading {
    color: $gray-900;
  }
</style>

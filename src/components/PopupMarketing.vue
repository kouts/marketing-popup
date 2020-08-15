<template>
  <div>
    <modal
      v-model="modalTrigger"
      title="My first modal"
      @after-open="afterModalOpen"
      @closing="closingModal"
    >
      <p>Modal content goes here...</p>
    </modal>
  </div>
</template>

<script>
import { createExitIntent } from '@/common/exit-intent';
import { createScrollPercent } from '@/common/scroll-percent';
import Modal from '@kouts/vue-modal';

export default {
  components: {
    Modal
  },
  props: {
    name: {
      type: String,
      required: true
    },
    exitIntent: {
      type: Boolean,
      default: false
    },
    waitMinutes: {
      type: Number,
      default: 0
    },
    scrollPercent: {
      type: Number,
      default: 0
    }
  },
  data: function() {
    return {
      modalTrigger: false,
      modalOpened: false
    };
  },
  mounted() {
    if (this.exitIntent) {
      this.exitIntentSvc = createExitIntent({
        onTrigger: () => this.showModal()
      });
    }
    this.scrollPercentSvc = createScrollPercent({
      percent: this.scrollPercent,
      onTrigger: () => this.showModal()
    });
  },
  beforeDestroy() {
    if (this.exitIntent) {
      this.exitIntentSvc.destroy();
    }
  },
  methods: {
    afterModalOpen() {
      document.body.classList.add('overflow-hidden');
    },
    closingModal() {
      document.body.classList.remove('overflow-hidden');
    },
    showModal() {
      if (this.modalOpened) {
        console.warn('Modal opened already once.');
        return;
      }
      this.modalOpened = true;
      const timeout = Math.floor(this.waitMinutes * 60 * 1000);
      console.log(timeout);
      setTimeout(() => {
        this.modalTrigger = true;
      }, timeout);
    }
  }
};
</script>

<style lang="scss" scoped>
  h1.heading {
    color: $gray-900;
  }
</style>

<template>
  <div>
    <modal
      v-model="modalTrigger"
      :title="popupTitle"
      @after-open="afterModalOpen"
      @closing="closingModal"
    >
      <slot></slot>
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
    popupId: {
      type: String,
      required: true
    },
    popupTitle: {
      type: String,
      default: 'Marketing Popup'
    },
    showAfterMinutes: {
      type: Number,
      default: 0
    },
    showAfterScrollPercent: {
      type: Number,
      default: 0
    },
    showOnExitIntent: {
      type: Boolean,
      default: false
    }
  },
  data: function() {
    return {
      modalTrigger: false,
      modalOpened: false,
      timeout: null
    };
  },
  mounted() {
    if (this.showAfterMinutes) {
      this.showModalTimer();
    }
    if (this.showAfterScrollPercent) {
      this.scrollPercentSvc = createScrollPercent({
        percent: this.showAfterScrollPercent,
        onTrigger: () => this.showModal()
      });
    }
    if (this.showOnExitIntent) {
      this.exitIntentSvc = createExitIntent({
        onTrigger: () => this.showModal()
      });
    }
  },
  beforeDestroy() {
    if (this.showAfterMinutes) {
      this.clearModalTimer();
    }
    if (this.showAfterScrollPercent) {
      this.scrollPercentSvc.destroy();
    }
    if (this.showOnExitIntent) {
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
      this.modalTrigger = true;
    },
    showModalTimer() {
      if (this.showAfterMinutes <= 0) {
        return;
      }
      this.timeout = Math.floor(this.showAfterMinutes * 60 * 1000);
      setTimeout(() => {
        this.showModal();
        this.clearModalTimer();
      }, this.timeout);
    },
    clearModalTimer() {
      window.clearTimeout(this.timeout);
    }
  }
};
</script>

<style lang="scss" scoped>
  h1.heading {
    color: $gray-900;
  }
</style>

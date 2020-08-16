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
import { setObject, getObject } from '@/common/storage';
import Modal from '@kouts/vue-modal';

function unixNow() {
  const now = new Date();
  return now.getTime();
}

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
    if (this.expiration) {
      console.log('expiration set');
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
      if (this.modalOpened()) {
        console.warn('Modal opened already once.');
        return;
      }
      // Store opened time in localStorage
      const timeNow = unixNow();
      setObject(this.popupId, {
        opened: timeNow
      });

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
    },
    modalOpened() {
      const timeNow = unixNow();
      const popupInfo = getObject(this.popupId);
      if (!popupInfo) {
        return false;
      }
      if (popupInfo.opened < timeNow) {
        return true;
      }
    }
  }
};
</script>

<style lang="scss" scoped>
  h1.heading {
    color: $gray-900;
  }
</style>

<template>
  <div>
    <modal
      v-model="modalTrigger"
      :title="popupTitle"
      @after-open="onAfterModalOpen"
      @closing="onClosingModal"
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
  // Timestamp in seconds
  return Math.floor(Date.now() / 1000);
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
    },
    showFrequency: {
      type: Number,
      default: 0
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
      this.showModalUsingTimer();
    }
    if (this.showAfterScrollPercent) {
      this.scrollPercentSvc = createScrollPercent({
        percent: this.showAfterScrollPercent,
        onTrigger: () => this.showModal()
      });
    }
    if (this.showOnExitIntent) {
      this.exitIntentSvc = createExitIntent({
        onTrigger: () => {
          if (this.shouldModalOpen()) {
            this.exitIntentSvc.preventUnload(true);
          } else {
            this.exitIntentSvc.preventUnload(false);
          }
          this.showModal();
        }
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
    onAfterModalOpen() {
      document.body.classList.add('overflow-hidden');
    },
    onClosingModal() {
      document.body.classList.remove('overflow-hidden');
    },
    showModal() {
      if (this.shouldModalOpen() === false) {
        console.info(`Modal entitled "${this.popupTitle}" opened already once.`);
        return;
      }
      // Store opened time in localStorage
      const now = unixNow();
      setObject(this.popupId, {
        opened: now
      });

      this.modalTrigger = true;
    },
    shouldModalOpen() {
      const now = unixNow();
      const popupInfo = getObject(this.popupId);
      if (!popupInfo) {
        return true;
      }
      if (now > popupInfo.opened + this.showFrequency) {
        return true;
      }
      return false;
    },
    showModalUsingTimer() {
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

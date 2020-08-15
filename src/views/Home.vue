<template>
  <div class="container">
    <div class="text-center">
      <img alt="Vue logo" src="../assets/logo.png" class="text-center">
      <div class="mb-4">
        <button type="button" class="btn btn-primary" @click="showPopupMarketing = !showPopupMarketing">Toggle modal container</button>
        <button type="button" class="btn btn-primary ml-2" @click="$refs['marketing-popup-1'].showModal()">
          Open a modal
        </button>
      </div>
    </div>
    <div class="row" style="margin-bottom: 1000px;">
      <div class="col text-center">
        <h1 class="heading">Modal container</h1>
        <p>
          A project setup using vue-cli, created to easily scaffold new Vue.js projects.<br />
          Find out more at <a class="custom" href="https://cli.vuejs.org" target="_blank" rel="noopener">vue-cli documentation</a>.
        </p>
        <popup-marketing
          v-if="showPopupMarketing"
          ref="marketing-popup-1"
          popup-id="marketing-popup-1"
          popup-title="Marketing Popup"
          :show-after-minutes="0.05"
          :show-after-scroll-percent="25"
          :show-on-exit-intent="true"
        >
          <div>Popup content goes here...</div>
        </popup-marketing>
      </div>
    </div>
  </div>
</template>

<script>
import PopupMarketing from '@/components/PopupMarketing';

export default {
  components: {
    PopupMarketing
  },
  data() {
    return {
      showPopupMarketing: true
    };
  }
};
</script>

<template>
  <div class="container">
    <h1 class="mb-4">Popups configuration</h1>
    <div class="row">
      <div v-if="!loading" class="col-sm-12">
        <popup-card
          v-for="item in popups"
          :id="item.id"
          :key="item.id"
          :title="item.title"
          :timer-enable="!!item.timer_enable"
          :timer-text="getFromList(lovs.timer, item.timer_value)"
          :scrolling-trigger-enable="!!item.scrolling_trigger_enable"
          :scrolling-trigger-text="getFromList(lovs.scrolling_trigger, item.scrolling_trigger_value)"
          :exit-intent-enable="!!item.exit_intent_enable"
          :frequency-text="getFromList(lovs.frequency, item.frequency_value)"
          @edit="popupEdit"
          @delete="popupDelete"
        />
      </div>
    </div>
    <popup-details
      :id="popup.id"
      :show-modal="showModal"
      :title="popup.title"
      :content="popup.content"
      :timer-enable="!!popup.timer_enable"
      :timer-list="lovs.timer"
      :timer-value="popup.timer_value"
      :scrolling-trigger-enable="!!popup.scrolling_trigger_enable"
      :scrolling-trigger-list="lovs.scrolling_trigger"
      :scrolling-trigger-value="popup.scrolling_trigger_value"
      :exit-intent-enable="!!popup.exit_intent_enable"
      :frequency-list="lovs.frequency"
      :frequency-value="popup.frequency_value"
      @modal-closed="showModal = false"
    />
  </div>
</template>

<script>
import { mapActions, mapState } from 'vuex';
import { getFromList } from '@/common/utils';
import PopupCard from '@/components/PopupCard.vue';
import PopupDetails from '@/components/PopupDetails.vue';

export default {
  components: {
    PopupCard,
    PopupDetails
  },
  data() {
    return {
      loading: false,
      showModal: false
    };
  },
  computed: {
    ...mapState({
      popups: 'popups',
      popup: 'popup',
      lovs: 'listOfValues'
    })
  },
  async mounted() {
    this.loading = true;
    await Promise.all([
      this.fetchPopups(),
      this.fetchListOfValues(['timer', 'scrolling_trigger', 'frequency'])
    ]);
    this.loading = false;
  },
  methods: {
    ...mapActions(['fetchPopups', 'fetchPopup', 'fetchListOfValues']),
    getFromList,
    async popupEdit(id) {
      await this.fetchPopup(id);
      this.showModal = true;
    },
    popupDelete(id) {
      alert(id);
    }
  }
};
</script>

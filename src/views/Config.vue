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
          @delete="deletePopup"
        />
        <div v-if="!loading && popups.length === 0" class="text-center">
          <h2>No popups found</h2>
        </div>
      </div>
    </div>
    <popup-details
      :id="popup.id"
      :show-modal="showModal"
      :loading="loadingModal"
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
      @save="savePopup"
    />
  </div>
</template>

<script>
import { mapActions, mapState } from 'vuex';
import { getFromList } from '@/common/utils';
import { updatePopup, deletePopup } from '@/api/popup';
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
      loadingModal: false,
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
    ...mapActions(['fetchPopups', 'fetchPopup', 'updatePopup', 'fetchListOfValues']),
    getFromList,
    async popupEdit(id) {
      this.loadingModal = true;
      await this.fetchPopup(id);
      this.showModal = true;
      this.loadingModal = false;
    },
    async deletePopup(id) {
      try {
        await deletePopup(id);
      } catch (error) {
        console.log(error);
      }
    },
    async savePopup(popupData) {
      try {
        await updatePopup(popupData.id, popupData);
      } catch (error) {
        console.log(error);
      }
      this.showModal = false;
    }
  }
};
</script>

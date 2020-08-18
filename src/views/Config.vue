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
      @modal-closed="showModal = false"
    />
    <div class="row mt-2">
      <div class="form-group col-sm-12">
        <select class="custom-select">
          <option selected>Open this select menu</option>
          <option value="1">One</option>
          <option value="2">Two</option>
          <option value="3">Three</option>
        </select>
      </div>
    </div>
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
    ...mapActions(['fetchPopups', 'fetchListOfValues']),
    getFromList,
    popupEdit(id) {
      this.showModal = true;
    },
    popupDelete(id) {
      alert(id);
    }
  }
};
</script>

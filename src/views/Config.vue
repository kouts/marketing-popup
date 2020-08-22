<template>
  <div class="container">
    <div class="d-flex flex-row justify-content-between align-items-center">
      <h1 class="mb-4">Popups configuration</h1>
      <button type="button" class="btn btn-primary" :disabled="popups.length > 2" @click="createPopup">
        Create popup
      </button>
    </div>
    <div class="row">
      <div v-if="loading" class="col-sm-12">
        <div v-for="card in [1, 2]" :key="card" class="card mb-2">
          <div class="card-body">
            <div class="shimmer-bg" style="height: 98px;"></div>
          </div>
        </div>
      </div>
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
          class="mb-2"
          @edit="editPopup"
          @delete="idToDelete = item.id; showDeleteModal = true;"
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
    <modal ref="conf" v-model="showDeleteModal" title="Confirmation">
      <div class="row">
        <div class="col-sm-12">Are you sure you want to delete this popup?</div>
      </div>
      <hr class="full-hr" />
      <div class="row">
        <div class="col-sm-12">
          <div class="float-right">
            <button type="button" class="btn btn-primary" autofocus @click="deletePopup">Ok</button>
            <button type="button" class="btn btn-link ml-2" @click="showDeleteModal = false">Cancel</button>
          </div>
        </div>
      </div>
    </modal>
  </div>
</template>

<script>
import { mapActions, mapState } from 'vuex';
import { getFromList } from '@/common/utils';
import { createPopup, updatePopup, deletePopup } from '@/api/popup';
import PopupCard from '@/components/PopupCard.vue';
import PopupDetails from '@/components/PopupDetails.vue';
import Modal from '@kouts/vue-modal';

export default {
  components: {
    PopupCard,
    PopupDetails,
    Modal
  },
  data() {
    return {
      loading: false,
      loadingModal: false,
      showModal: false,
      showDeleteModal: false,
      idToDelete: null
    };
  },
  computed: {
    ...mapState({
      popups: 'popups',
      popup: 'popup',
      lovs: 'listOfValues'
    })
  },
  async created() {
    this.loading = true;
    await this.fetchPageData();
    this.loading = false;
  },
  methods: {
    ...mapActions([
      'fetchPopups',
      'fetchPopup',
      'updatePopup',
      'initializePopup',
      'fetchListOfValues'
    ]),
    getFromList,
    fetchPageData() {
      return Promise.all([
        this.fetchPopups(),
        this.fetchListOfValues(['timer', 'scrolling_trigger', 'frequency'])
      ]);
    },
    createPopup() {
      this.initializePopup();
      this.showModal = true;
    },
    async editPopup(id) {
      this.loadingModal = true;
      await this.fetchPopup(id);
      this.showModal = true;
      this.loadingModal = false;
    },
    async deletePopup() {
      const id = this.idToDelete;
      try {
        await deletePopup(id);
        this.fetchPageData();
        this.showDeleteModal = false;
        this.idToDelete = null;
      } catch (error) {
        console.log(error);
      }
    },
    async savePopup(popupData) {
      try {
        if (!popupData.id) {
          await createPopup(popupData);
        } else {
          await updatePopup(popupData.id, popupData);
        }
        this.showModal = false;
        this.fetchPageData();
      } catch (error) {
        this.handleError(error);
      }
    },
    handleError(error) {
      if (error.response && error.response.status === 422) {
        for (const msgArr in error.response.data) {
          const msg = error.response.data[msgArr][0];
          this.$notyf.error(msg);
        }
      } else {
        console.log(error);
      }
    }
  }
};
</script>

<style lang="scss" scoped>
.shimmer-bg {
  animation-duration: 2.2s;
  animation-fill-mode: forwards;
  animation-iteration-count: infinite;
  animation-name: shimmer;
  animation-timing-function: linear;
  background: #ddd;
  background: linear-gradient(to right, #f6f6f6 8%, #f0f0f0 18%, #f6f6f6 33%);
  background-size: 1200px 100%;
}

@-webkit-keyframes shimmer {
  0% {
    background-position: -100% 0;
  }
  100% {
    background-position: 100% 0;
  }
}

@keyframes shimmer {
  0% {
    background-position: -1200px 0;
  }
  100% {
    background-position: 1200px 0;
  }
}
</style>

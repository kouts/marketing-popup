<template>
  <modal
    v-model="open"
    title="Popup settings"
    modal-class="popup-details-modal"
    @after-open="afterModalOpen"
    @closing="closingModal"
  >
    <div class="pt-2 px-2">
      <div class="form-group row">
        <label for="popupTitle" class="col-sm-2 col-form-label">Title</label>
        <div class="col-sm-10">
          <input id="popupTitle" type="text" class="form-control">
        </div>
      </div>
      <div class="form-group row">
        <label for="popupContent" class="col-sm-2 col-form-label">Content</label>
        <div class="col-sm-10">
          <textarea id="popupContent" class="form-control" rows="3"></textarea>
        </div>
      </div>
      <h5 class="mb-0">Automatically show</h5>
      <hr class="mt-1" />
      <div class="form-group row d-flex align-items-center">
        <div class="col-sm-3 mb-2 mb-sm-0">
          <div class="custom-control custom-checkbox">
            <input id="showOnTimer" type="checkbox" class="custom-control-input">
            <label class="custom-control-label" for="showOnTimer">Show on a timer</label>
          </div>
        </div>
        <div class="col-sm-5">
          <select class="custom-select">
            <option selected>Open this select menu</option>
          </select>
        </div>
      </div>
      <div class="form-group row d-flex align-items-center">
        <div class="col-sm-3 mb-2 mb-sm-0">
          <div class="custom-control custom-checkbox">
            <input id="showAfterScrolling" type="checkbox" class="custom-control-input">
            <label class="custom-control-label" for="showAfterScrolling">Show after scrolling</label>
          </div>
        </div>
        <div class="col-sm-5">
          <select class="custom-select">
            <option selected>Open this select menu</option>
          </select>
        </div>
      </div>
      <div class="form-group row">
        <div class="col-sm-3">
          <div class="custom-control custom-checkbox">
            <input id="showOnExitIntent" type="checkbox" class="custom-control-input">
            <label class="custom-control-label" for="showOnExitIntent">Show on exit intent</label>
          </div>
        </div>
      </div>
      <div class="form-group row d-flex align-items-center">
        <div class="col-sm-3">
          <div class="custom-control custom-checkbox">
            <label class="custom-control-label dummy-custom-control-label">Show at most every</label>
          </div>
        </div>
        <div class="col-sm-5">
          <select class="custom-select">
            <option selected>Open this select menu</option>
          </select>
        </div>
      </div>
    </div>
    <hr class="full-hr" />
    <div class="row">
      <div class="col-sm-12">
        <div class="float-right">
          <button type="button" class="btn btn-primary" @click="open = false">Ok</button>
          <button type="button" class="btn btn-secondary ml-2" @click="open = false">Close</button>
        </div>
      </div>
    </div>
  </modal>
</template>

<script>
import Modal from '@kouts/vue-modal';

export default {
  components: {
    Modal
  },
  props: {
    loading: {
      type: Boolean,
      default: true
    },
    showModal: {
      type: Boolean,
      default: false
    },
    id: {
      type: Number,
      default: null
    },
    title: {
      type: String,
      default: ''
    },
    content: {
      type: String,
      default: ''
    }
  },
  data() {
    return {

    };
  },
  computed: {
    open: {
      get() {
        return this.showModal;
      },
      set(newValue) {
        if (newValue === false) {
          this.$emit('modal-closed');
        }
      }
    }
  },
  methods: {
    afterModalOpen() {
      document.body.classList.add('overflow-hidden');
    },
    closingModal() {
      document.body.classList.remove('overflow-hidden');
    }
  }
};
</script>

<style lang="scss">
.dummy-custom-control-label::before {
  border-color: transparent;
}
.popup-details-modal {
  max-width: 900px;
  min-height: 250px;
}
</style>

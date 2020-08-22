<template>
  <modal
    v-model="open"
    :title="!id ? 'New Popup' : title"
    modal-class="popup-details-modal"
    @before-open="beforeModalOpen"
    @after-open="afterModalOpen"
    @closing="closingModal"
  >
    <div v-if="!loading">
      <div class="pt-2 px-2">
        <div class="form-group row">
          <label for="popupTitle" class="col-sm-2 col-form-label required">Title</label>
          <div class="col-sm-10">
            <input id="popupTitle" v-model="form.title" type="text" class="form-control" maxlength="70">
          </div>
        </div>
        <div class="form-group row">
          <label for="popupContent" class="col-sm-2 col-form-label required">Content</label>
          <div class="col-sm-10">
            <textarea id="popupContent" v-model="form.content" class="form-control" rows="3"></textarea>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-sm-2 col-form-label required">Show at most every</label>
          <div class="col-sm-5">
            <select v-model="form.frequencyValue" class="custom-select">
              <option value="">-- Please select --</option>
              <option v-for="o in form.frequencyList" :key="o.value" :value="o.value">
                {{ o.text }}
              </option>
            </select>
          </div>
        </div>
        <h5 class="mb-0">Automatically show</h5>
        <hr class="mt-1" />
        <div class="form-group row d-flex align-items-center">
          <div class="col-sm-3 mb-2 mb-sm-0">
            <div class="custom-control custom-checkbox">
              <input id="showOnTimer" v-model="form.timerEnable" type="checkbox" class="custom-control-input" @change="timerCheckChanged($event)">
              <label class="custom-control-label" for="showOnTimer">Show on a timer</label>
            </div>
          </div>
          <div :class="['col-sm-5', !form.timerEnable && 'invisible d-none d-sm-block']">
            <select v-model="form.timerValue" class="custom-select">
              <option value="">-- Please select --</option>
              <option v-for="o in form.timerList" :key="o.value" :value="o.value">
                {{ o.text }}
              </option>
            </select>
          </div>
        </div>
        <div class="form-group row d-flex align-items-center">
          <div class="col-sm-3 mb-2 mb-sm-0">
            <div class="custom-control custom-checkbox">
              <input id="showAfterScrolling" v-model="form.scrollingTriggerEnable" type="checkbox" class="custom-control-input" @change="scrollingCheckChanged($event)">
              <label class="custom-control-label" for="showAfterScrolling">Show after scrolling</label>
            </div>
          </div>
          <div :class="['col-sm-5', !form.scrollingTriggerEnable && 'invisible d-none d-sm-block']">
            <select v-model="form.scrollingTriggerValue" class="custom-select">
              <option value="">-- Please select --</option>
              <option v-for="o in form.scrollingTriggerList" :key="o.value" :value="o.value">
                {{ o.text }}
              </option>
            </select>
          </div>
        </div>
        <div class="form-group row">
          <div class="col-sm-3">
            <div class="custom-control custom-checkbox">
              <input id="showOnExitIntent" v-model="form.exitIntentEnable" type="checkbox" class="custom-control-input">
              <label class="custom-control-label" for="showOnExitIntent">Show on exit intent</label>
            </div>
          </div>
        </div>
      </div>
      <hr class="full-hr" />
      <div class="row">
        <div class="col-sm-12">
          <div class="float-right">
            <button type="button" class="btn btn-primary" @click="save">Ok</button>
            <button type="button" class="btn btn-secondary ml-2" @click="open = false">Close</button>
          </div>
        </div>
      </div>
    </div>
  </modal>
</template>

<script>
import Modal from '@kouts/vue-modal';
import { clone } from '@/common/utils';

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
    },
    timerEnable: {
      type: Boolean,
      default: false
    },
    timerList: {
      type: Array,
      default: () => []
    },
    timerValue: {
      type: String,
      default: ''
    },
    scrollingTriggerEnable: {
      type: Boolean,
      default: false
    },
    scrollingTriggerList: {
      type: Array,
      default: () => []
    },
    scrollingTriggerValue: {
      type: String,
      default: ''
    },
    exitIntentEnable: {
      type: Boolean,
      default: false
    },
    frequencyList: {
      type: Array,
      default: () => []
    },
    frequencyValue: {
      type: String,
      default: ''
    }
  },
  data() {
    return {
      form: {}
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
    beforeModalOpen() {
      this.form = clone(this.$props);
    },
    afterModalOpen() {
      document.body.classList.add('overflow-hidden');
    },
    closingModal() {
      document.body.classList.remove('overflow-hidden');
    },
    exportFormDataForSave() {
      let form = clone(this.form);
      form = Object.assign({}, form, {
        timerEnable: !form.timerValue ? false : form.timerEnable,
        scrollingTriggerEnable: !form.scrollingTriggerValue ? false : form.scrollingTriggerEnable
      });
      delete form.timerList;
      delete form.scrollingTriggerList;
      delete form.frequencyList;
      return form;
    },
    save() {
      // Perform validations here
      this.$emit('save', this.exportFormDataForSave());
    },
    timerCheckChanged(e) {
      if (e.target.checked === false) {
        this.form.timerValue = '';
      }
    },
    scrollingCheckChanged(e) {
      if (e.target.checked === false) {
        this.form.scrollingTriggerValue = '';
      }
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
label.required::before {
  content: "*";
  font-weight: normal;
  color: $danger;
  vertical-align: top;
  display: inline-block;
  line-height: 0.875rem;
}
</style>

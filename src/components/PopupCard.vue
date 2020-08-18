<template>
  <div class="card">
    <div class="card-body">
      <div class="d-flex flex-row align-items-center flex-wrap">
        <div class="flex-grow-1">
          <h2 class="card-title">{{ title }}</h2>
        </div>
        <div>
          <button type="button" class="btn btn-primary btn-sm" @click="$emit('edit', id)">
            Edit
          </button>
          <button type="button" class="btn btn-primary btn-sm ml-2" @click="$emit('delete', id)">
            Delete
          </button>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-12">
          <span class="text-muted">Timer:</span> {{ timerEnable ? timerText : 'Not enabled' }}<br />
          <span class="text-muted">Scrolling:</span>  {{ scrollingTriggerEnable ? scrollingTriggerText : '-' }}<br />
          <span class="text-muted">Exit intent:</span> {{ exitIntentEnable ? 'Enabled' : 'Not enabled' }}<br />
          <span class="text-muted">Triggered at most every:</span> {{ frequencyText }}
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: {
    id: {
      type: Number,
      required: true
    },
    title: {
      type: String,
      required: true
    },
    timerEnable: {
      type: Boolean,
      default: false
    },
    timerText: {
      type: String,
      default: ''
    },
    scrollingTriggerEnable: {
      type: Boolean,
      default: false
    },
    scrollingTriggerText: {
      type: String,
      default: ''
    },
    exitIntentEnable: {
      type: Boolean,
      default: false
    },
    frequencyText: {
      type: String,
      default: ''
    }
  }
};
</script>

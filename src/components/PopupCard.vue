<template>
  <div class="card">
    <div class="card-body">
      <div class="d-flex flex-row flex-wrap">
        <div class="flex-grow-1">
          <h2 class="card-title">{{ title }}</h2>
        </div>
        <div class="mb-2 mb-sm-0">
          <button type="button" class="btn btn-primary btn-sm" @click="$emit('edit', id)">
            Edit
          </button>
          <button type="button" class="btn btn-primary btn-sm ml-2" @click="$emit('delete', id)">
            Delete
          </button>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <div class="d-flex align-items-center" :title="`Timer ${timerEnable ? timerText : 'not enabled'}`">
            <i class="gg-timer mr-1"></i><div>{{ timerEnable ? timerText : 'Not enabled' }}</div>
          </div>
          <div class="d-flex align-items-center" :title="`Scrolling trigger ${scrollingTriggerEnable ? scrollingTriggerText : 'not enabled'}`">
            <i class="gg-scroll-v ml-1 mr-2"></i><div>{{ scrollingTriggerEnable ? scrollingTriggerText : 'Not enabled' }}</div>
          </div>
        </div>
        <div class="col-md-6">
          <span class="text-muted">Exit intent detection:</span> {{ exitIntentEnable ? 'Enabled' : 'Not enabled' }}<br />
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

<style lang="scss" scoped>
// https://css.gg/
.gg-scroll-v,
.gg-scroll-v::after,
.gg-scroll-v::before {
    display: block;
    box-sizing: border-box;
    width: 6px;
    height: 6px
}
.gg-scroll-v {
    position: relative;
    transform: scale(var(--ggs,1));
    border: 2px solid;
    border-radius: 10px
}
.gg-scroll-v::after,
.gg-scroll-v::before {
    content: "";
    position: absolute;
    transform: rotate(-45deg);
    left: -2px
}
.gg-scroll-v::after {
    border-bottom: 2px solid;
    border-left: 2px solid;
    bottom: -8px
}
.gg-scroll-v::before {
    border-top: 2px solid;
    border-right: 2px solid;
    top: -8px
}

.gg-timer,
.gg-timer::before {
  border: 2px solid;
  width: 18px;
  height: 18px;
  border-radius: 40px
}
.gg-timer {
  background:
    linear-gradient(to left,
        currentColor 10px,transparent 0)
        no-repeat 6px -2px/2px 6px;
  box-sizing: border-box;
  transform: scale(var(--ggs,1));
  position: relative;
  display: block;
  border-top-color: transparent
}
.gg-timer::after,
.gg-timer::before {
  content: "";
  display: block;
  box-sizing: border-box;
  position: absolute
}
.gg-timer::before {
  border-right-color: transparent;
  border-left-color: transparent;
  border-bottom-color: transparent;
  right: -2px;
  top: -2px;
  transform: rotate(45deg)
}
.gg-timer::after {
  width: 2px;
  height: 6px;
  background: currentColor;
  transform: rotate(-50deg);
  left: 4px;
  bottom: 5px;
  border-radius: 100px
}
</style>

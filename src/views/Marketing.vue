<template>
  <div class="container">
    <div class="text-center">
      <h1 class="mb-4">Marketing Page</h1>
      <div class="mb-4">
        <button type="button" class="btn btn-primary" @click="showPopupMarketingSection = !showPopupMarketingSection">
          Toggle marketing modals function
        </button>
        <button type="button" class="btn btn-primary ml-2" @click="showModal">
          Open a modal
        </button>
        <button type="button" class="btn btn-primary ml-2" @click="clearLocalStorage">
          Clear localStorage!
        </button>
      </div>
    </div>
    <div class="row">
      <div class="mx-auto col-lg-10 col-xl-8">
        <p class="lead mb-5">As am hastily invited <strong>settled at limited</strong> civilly fortune me. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.</p>
      </div>
    </div>
    <div class="row">
      <div class="mx-auto col-xl-10"><img src="/img/photo1.jpg" alt="Photo 1" class="img-fluid mb-5"></div>
    </div>
    <div class="row">
      <div class="mx-auto col-lg-10 col-xl-8">
        <div class="text-content">
          <p><strong>Pellentesque habitant morbi tristique</strong> senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. <em>Aenean ultricies mi vitae est.</em> Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, <code>commodo vitae</code>, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. <a href="#">Donec non enim</a> in turpis pulvinar facilisis. Ut felis.</p>
          <figure class="figure mb-3">
            <img src="/img/photo2.jpg" alt="Example blog post alt." class="figure-img img-fluid">
            <figcaption class="figure-caption text-center">Photo by Jack Tran, New York </figcaption>
          </figure>
          <h2>Header Level 2</h2>
          <ol>
            <li>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</li>
            <li>Aliquam tincidunt mauris eu risus.</li>
          </ol>
          <blockquote class="blockquote blockquote-primary bg-gray-100 p-5">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus magna. Cras in mi at felis aliquet congue. Ut a est eget ligula molestie gravida. Curabitur massa. Donec eleifend, libero at sagittis mollis, tellus est malesuada tellus, at luctus turpis elit sit amet quam. Vivamus pretium ornare est.</blockquote>
          <h3>Header Level 3</h3>
          <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi. Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. Donec non enim in turpis pulvinar facilisis. Ut felis. Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus</p>
          <ul>
            <li>Lorem ipsum dolor sit amet, consectetuer adipiscing elit.</li>
            <li>Aliquam tincidunt mauris eu risus.</li>
          </ul>
          <p>
            <img src="/img/photo3.jpg" alt="Example blog post" class="img-fluid">
          </p>
          <p>Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo. Quisque sit amet est et sapien ullamcorper pharetra. Vestibulum erat wisi, condimentum sed, commodo vitae, ornare sit amet, wisi. </p>
          <p>Aenean fermentum, elit eget tincidunt condimentum, eros ipsum rutrum orci, sagittis tempus lacus enim ac dui. Donec non enim in turpis pulvinar facilisis. Ut felis. Praesent dapibus, neque id cursus faucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus </p>
        </div>
      </div>
    </div>
    <template v-if="showPopupMarketingSection">
      <popup-marketing
        v-for="(popup, index) in popups"
        :key="popup.id"
        :ref="'popup-' + index"
        :popup-id="'popup-' + popup.id"
        :popup-title="popup.title"
        :show-after-minutes="Number(popup.timer_value)"
        :show-after-scroll-percent="Number(popup.scrolling_trigger_value)"
        :show-on-exit-intent="!!popup.exit_intent_enable"
        :show-frequency="Number(popup.frequency_value)"
        :updated-at="popup.updated_at"
      >
        <div> {{ popup.content }}</div>
      </popup-marketing>
    </template>
  </div>
</template>

<script>
import { mapActions, mapState } from 'vuex';
import PopupMarketing from '@/components/PopupMarketing';

export default {
  components: {
    PopupMarketing
  },
  data() {
    return {
      showPopupMarketingSection: true
    };
  },
  computed: {
    ...mapState(['popups'])
  },
  created() {
    this.fetchPopups();
  },
  methods: {
    ...mapActions(['fetchPopups']),
    clearLocalStorage() {
      localStorage.clear();
    },
    showModal() {
      this.$refs['popup-0'][0].showModal();
    }
  }
};
</script>

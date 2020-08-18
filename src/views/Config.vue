<template>
  <div class="container">
    <h1 style="margin-bottom: 1000px;">This is the configuration page</h1>
  </div>
</template>

<script>
import { mapActions } from 'vuex';

export default {
  components: {
  },
  data() {
    return {
      loading: false
    };
  },
  async mounted() {
    this.loading = true;
    await this.fetchPopups();
    this.loading = false;
  },
  methods: {
    ...mapActions(['fetchPopups'])
  }
};
</script>

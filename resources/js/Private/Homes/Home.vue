<template>
  <div class="card private-card-wrapper">
    <div class="card-body private-card">
      <h1 class="title">{{ __("home") }}</h1>
      <div class="row">
        <div class="col-12">
          <h1>Hola mundo</h1>
        </div>
      </div>
    </div>
  </div>
</template>

<script>

export default {
  name: "Home",
  props: {
    isoCode: String,
  },
  setup() {

    return {
    };
  },
};
</script>
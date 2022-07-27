<template>
    <div class="form-group bmd-form-group is-filled">
        <label class="bmd-label-floating">{{label}}</label>
        <div class="form-control div-control"><slot /></div>
    </div>
</template>
<script>
  export default{
    name: "DivLabeled",
    props: {
      label: String
    }
  }
</script>

<style lang="scss">
  .div-control{
    background: white !important;
    height: auto;
  }
</style>

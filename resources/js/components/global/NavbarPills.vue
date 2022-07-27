<template>
  <div>
    hallo
    <template v-for="slot, key in $slots" :slot="key">slot</template>
  </div>
</template>

<script>
  export default{
    name: "NavbarPills",
    mounted(){
      console.log(this.$slots)
    }
  }

</script>

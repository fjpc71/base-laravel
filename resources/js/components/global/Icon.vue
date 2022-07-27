<template>
<span @click="(e) => $emit('click', e)"
  ref="icon"
  class="material-icons-outlined icon">{{name}}</span>
</template>

<script>
export default
{
    name: "Icon",
    props:
    {
        name: String
    },
}
</script>

<style scoped>
@import url('https://fonts.googleapis.com/icon?family=Material+Icons+Outlined');
.icon{
  user-select: none;
}
</style>

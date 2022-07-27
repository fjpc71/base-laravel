<template>
<div class="form-group bmd-form-group textarea-float" :class='{"is-filled": !!modelValue, "is-focused": focused}'>
  <label class="bmd-label-floating">{{title}}</label>
  <textarea class="form-control"
    :required="required"
    :value="modelValue"
    @input="handleChange"
    @focus="focused= true"
    @blur="focused = false"
    @invalid="handleInvalid"
    :rows="rows" />
</div>
</template>

<script>
export default
{
  name: "TextareaFloat",
  props:
  {
    rows:
    {
      type: Number,
      default: 4
    },
    required:
    {
      type: Boolean,
      default: false
    },
    title: {
      type: String,
      default: "title"
    },
    modelValue: String,
  },
  data() {
    return {
      focused: false
    }
  },
  methods:
  {
    handleChange( e )
    {
      this.$emit( "update:modelValue", e.target.value )
      //this.$emit( "update:", e.target.value )
    },
    handleInvalid(e){
      e.preventDefault();
    }
  }
}
</script>
<style lang="scss" scoped>
  textarea{padding-top: 20px;}
</style>
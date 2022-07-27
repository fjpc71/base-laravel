<template>
<div class="checkbox"
  :class="{checked: modelValue, disabled: disabled}">
    <label>
        <input type="checkbox"
          class="checkbox-input"
          @click="handleChange" />
        <icon v-if="modelValue"
          name="checked" />
        <slot />
    </label>

</div>
</template>

<script>
export default
{
    name: "Checkbox",
    props:
    {
        name:
        {
            default: '',
            type: String
        },
        modelValue:
        {
            type: Boolean,
            default: false
        },
        disabled:
        {
            type: Boolean,
            default: false
        }
    },
    watch:
    {
        modelValue:
        {
            handler()
            {
                this.val = this.modelValue
            },
            immediate: true
        },
    },
    methods:
    {
        handleChange( e )
        {
            this.$emit( "update:modelValue", !this.modelValue )
        }
    }
}
</script>

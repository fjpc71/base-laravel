<template>
<div class="form-group bmd-form-group is-filled input-toggler">
  <div class="bmd-label-floating"
    :class="{checked: modelValue}">{{title}}</div>
  <label class="switch"
    :class="{checked: modelValue}">
    <div class="toggler-label label-yes">
      <div class="toggler-text">{{yes_label}}</div>
    </div>
    <div class="toggler-label label-no">
      <div class="toggler-text">{{no}}</div>
    </div>
    <input type="checkbox"
      :value="modelValue"
      @input="$emit('update:modelValue', !modelValue)"
      class="toggler">
    <span class="slider"></span>
  </label>
</div>
</template>

<script>
export default
{
  name: "ToggleLabel",
  props:
  {
    modelValue:
    {
      type: Boolean,
      default: false
    },
    yes:
    {
      type: String,
      default: "Si"
    },
    no:
    {
      type: String,
      default: "No"
    },
    title:
    {
      type: String,
      default: "label"
    }
  },
  computed: {
    yes_label: function(){
      if(this.yes && this.yes != ''){
        return this.yes
      }
      //return "Si"
    }
  }
}
</script>

<style lang="scss">
@import "../../../sass/variables"; // Variables
.input-toggler {

    /* The switch - the box around the slider */
    .switch {
        position: relative;
        display: block;
        width: 100%;
        height: 34px;
        cursor: pointer;
        margin-top: 5px;
        top: 14px;
    }

    &.is-filled {
        .bmd-label-floating {
            top: -5px;
        }
    }
    .bmd-label-floating {
        &.checked {
            color: $grey-ghost-3;
        }
    }

    .toggler-label {
        position: absolute;
        top: 0;
        bottom: 0;
        width: 50%;
        z-index: 9;
        text-align: center;
        display: flex;
        font-size: 0.9em;
        transition: color 0.4s ease;
        &.label-yes {
            left: 0;
            right: auto;
        }
        &.label-no {
            left: auto;
            right: 0;
        }
        .toggler-text {
            margin: auto;
            color: #e3e3e3;
        }
    }

    .checked {
        .label-yes {
            color: $white;
        }
        .label-no {
            color: #e3e3e3;
        }
    }

    /* Hide default HTML checkbox */
    .switch input {
        opacity: 0;
        width: 0;
        height: 0;
    }

    /* The slider */
    .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: $white;
        transition: 0.4s;
        border: 1px solid #e3e3e3;
    }

    .slider:before {
        position: absolute;
        content: "";
        height: 34px;
        width: 50%;
        left: auto;
        top: 0;
        right: 0;
        bottom: 0;
        background-color: $primary;
        -webkit-transition: 0.4s;
        transition: 0.4s;
    }

    .checked {
        .slider {
            background-color: $white;
            border: 1px solid #e3e3e3;
        }
        .slider:before {
            transform: translateX(-100%);
        }
    }

    input: checked;
}
</style>

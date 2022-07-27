<template>
<div class="bmd-form-group form-group select-float"
  v-bind:class="{ 'is-focused' : focused, 'is-filled': !!modelValue, 'invalid': submited && !modelValue}"
  @mouseover="hovered = true"
  @mouseout="hovered = false">
  <div class="select-wrapper">
    <label :for="id"
      class="bmd-label-floating">{{title}}</label>
    <select :value="modelValue"
      @input="e => handleSelect(e.target.value)"
      :id="id"
      @focus="handleFocus"
      class="form-control"
      @invalid="handleInvalid"
      :required="required"
      :disabled="disabled">
      <option v-for="item in list" :key="item.id" :style="(hovered ? 'display:none' : '')"
        :selected="modelValue == item.id"
        :value="item.id">{{item.name}}</option>
    </select>
    <ul class="dropdown-menu custom-dropdown"
      :class="{show: focused}">
      <li v-for="item in list" :key="item.id"
        :class="{selected: item.id === v}">
        <div @click="handleSelect(item.id)">{{item.name}}</div>
      </li>
    </ul>
    <span class="arrow-down"></span>
    <!-- <icon name="keyboard_arrow_down"
      class="arrow-down" /> -->
  </div>
  <toggle-height>
    <div class="error-msg"
      v-if="submited && !modelValue">{{errorMsg}}</div>
  </toggle-height>
</div>
</template>

<script>
export default
{
  name: "SelectFloat",
  props:
  {
    id: String,
    disabled:
    {
      type: Boolean,
      default: false
    },
    title:
    {
      type: String,
      default: "title"
    },
    list: Array,
    modelValue:
    {
      type: Number,
      default: 0
    },
    required:
    {
      type: Boolean,
      default: false
    },
    errorMsg:
    {
      type: String,
      default: "Este campo es obligatorio."
    },
  },
  data()
  {
    return {
      v: '',
      focused: false,
      hovered: false,
      submited: false,
      valid: true,
      selected: false
    }
  },
  mounted()
  {
    window.addEventListener( "click", e =>
    {
      if ( this.selected )
      {
        this.selected = false
      }
      else
      {
        if ( this.hovered )
        {
          this.focused = true
        }
        else
        {
          this.focused = false
        }

      }
    } )
  },
  methods:
  {
    handleFocus( e )
    {
      if(this.hovered){
        e.target.blur()
      }
    },
    handleSelect( e )
    {
      this.$emit( "update:modelValue", e )
      this.focused = false
      this.selected = true
    },
    handleInvalid( e )
    {
      this.submited = true
      this.valid = false
      e.preventDefault();
    },
  }

}
</script>

<style lang="scss">
@import "../../../sass/variables"; // Variables
.select-float {

    .arrow-down {
        position: absolute;
        top: 14px;
        right: 5px;
        font-size: 35px;
        line-height: 35px;
        color: #000;
        pointer-events: none;
        border-radius: 5px;
        height: 36px;
        &::after{
                content: "";
                background-image: url(/images/icons/icon-arrow.svg);
                height: 20px;
                width: 20px;
                background-size: cover;
                background-repeat: no-repeat;
                transform: rotate(271deg);
                padding: 0;
                margin: 0;
                display: block;
                transition: transform 0.3s ease;
            }
    }
}
.form-control:read-only{
  background-image: none;
}
.custom-dropdown {
    width: 100%;
    max-height: 0;
    transition: max-height 0.1s ease;
    overflow-y: auto;
    display: block;
    border-radius: 0;
    color: #000;
    box-shadow: 0px 6px 20px #999BA871;
    margin-top: 10px;
    &.show {
        max-height: 300px;
    }
    li {
        margin: 0 15px;
        padding: 6px 14px;
        cursor: pointer;
        font-size: 14px;
        &.selected {
            color: $primary;
        }
        &:hover {
            color: $white;
            background-color: $primary;
        }
    }
}
.error-msg{
  color: $red;
}
</style>

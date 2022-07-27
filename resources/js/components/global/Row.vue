<template>
<div class="row"
  :class="classes">
  <slot />
</div>
</template>

<script>
export default
{
  name: "Row",
  props:
  {
    justifyContent:
    {
      type: String,
      default: ""
    },
    noGutters:
    {
      type: Boolean,
      default: false
    },
    alignSelf:
    {
      type: String,
      default: ""
    },
    alignItems:
    {
      type: String,
      default: ""
    }
  },
  computed:
  {
    classes: function ()
    {
      let c = {}
      if ( this.justifyContent !== "" )
      {
        c[ "justify-content-" + this.justifyContent ] = true
      }
      if ( this.alignSelf !== "" )
      {
        c[ "align-self-" + this.alignSelf ] = true
      }
      if ( this.alignItems !== "" )
      {
        c[ "align-items-" + this.alignItems ] = true
      }
      if ( this.noGutters )
      {
        c[ "no-gutters" ] = true
      }
      return c
    }
  }
}
</script>

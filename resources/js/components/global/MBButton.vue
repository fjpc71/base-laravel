<template>
  <component
    :is="as"
    class="btn"
    :class="classes"
    :href="href"
    :type="type"
    @click="handleClick"
    :disabled="disabled"
  >
    <slot />
  </component>
</template>

<script>
export default {
  name: "MBButton",
  props: {
    type: {
      type: String,
      default: "button",
    },
    href: {
      type: String,
      default: "",
    },
    variant: {
      type: String,
      default: "primary",
    },
    disabled: {
      type: Boolean,
      default: false,
    },
    small: {
      type: Boolean,
      default: false,
    },
    as: {
      type: String,
      default: "button",
    },
    block: {
      type: Boolean,
      default: false,
    },
    outline: {
      type: Boolean,
      default: false,
    },
  },
  computed: {
    classes: function () {
      let classes = "";
      classes = `btn-${this.variant} `;

      if (this.small) {
        classes += " btn-small";
      }

      if (this.disabled) {
        classes += " disabled";
      }
      if (this.block) {
        classes += " btn-block";
      }
      if (this.outline) {
        classes += ` btn-outline`;
      } else {
        classes += " btn-raised";
      }
      return classes;
    },
  },
  methods: {
    handleClick(e) {
      // this.$emit( "click", e.target )
    },
  },
};
</script>

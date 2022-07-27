<template>
<transition :mode="mode"
  name="expand"
  :tag="tag"
  :duration="speed"
  @enter="enter"
  @after-enter="afterEnter"
  @leave="leave">
    <slot />
</transition>
</template>

<script>
export default
{
    name: "ToggleHeight",
    props:
    {
        tag:
        {
            type: String,
            default: "span"
        },
        speed:
        {
            type: Number,
            default: 300
        },
        mode:
        {
            type: String,
            default: ""
        },
        maxHeight:
        {
            type: String,
            default: "auto"
        },
        height: {
          type: String,
          default: null
        }
    },
    methods:
    {
        enter( element )
        {
            const width = getComputedStyle( element )
                .width;

            element.style.width = width;
            element.style.position = 'absolute';
            element.style.visibility = 'hidden';
            element.style.height = this.maxHeight;

            const height = getComputedStyle( element )
                .height;

            element.style.width = null;
            element.style.position = null;
            element.style.visibility = null;
            element.style.height = 0;

            // Force repaint to make sure the
            // animation is triggered correctly.
            getComputedStyle( element )
                .height;

            // Trigger the animation.
            // We use `requestAnimationFrame` because we need
            // to make sure the browser has finished
            // painting after setting the `height`
            // to `0` in the line above.
            requestAnimationFrame( () =>
            {
                element.style.height = height;
            } );
        },
        afterEnter( element )
        {
          if(this.height){
            element.style.height = this.height
          }
          else{
            element.style.height = 'auto';

          }
        },
        leave( element )
        {

            const height = getComputedStyle( element )
                .height;

            element.style.height = height;

            // Force repaint to make sure the
            // animation is triggered correctly.
            getComputedStyle( element )
                .height;

            requestAnimationFrame( () =>
            {
                element.style.height = 0;
            } );
        },
    }
}
</script>

<style>
.expand-enter-active,
.expand-leave-active
{
    transition-timing-function: ease;
    transition-property: all;
    transition-duration: .3s;
    overflow: hidden;
}

.expand-enter,
.expand-leave-to
{
    height: 0;
    opacity: 0;
}
</style>

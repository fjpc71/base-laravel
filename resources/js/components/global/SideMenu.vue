<template>
<div class="side-menu"
  :class="{show: show}">
    <div class="close"
      @click="handleClose">
        <icon name="close" />
    </div>
    <h3>{{title}}</h3>
    <slot />
</div>
</template>

<script>
import
{
    Inertia
}
from '@inertiajs/inertia';
export default
{
    name: "SideMenu",
    props:
    {
        show: Boolean,
        title:
        {
            default: "Title",
            type: String,
            listener: null
        }
    },
    mounted()
    {
        this.listener = Inertia.on( "invalid", ( event ) =>
        {
            const res = event.detail.response
            //check if response is valid
            if ( res.status === 200 )
            {
                const data = event.detail.response.data
                if ( data.success )
                {
                    this.handleClose()
                }
            }
        } )
    },
    methods:
    {
        handleClose()
        {

            this.$emit( "update:show", true );
            this.$emit( "clear-form" );
        }
    }

}
</script>

<style lang="scss">
.side-menu {
    height: 100vh;
    width: 400px;
    position: fixed;
    right: 0;
    top: 0;
    bottom: 0;
    left: auto;
    box-shadow: 0 0 30px darken(#0062FF33, 5%);
    background-color: white;
    z-index: 9999;
    padding: 1.5rem;
    transition: transform 0.5s ease;
    transform: translateX(110%);
    overflow-y: auto;
    &.show {
        transform: translateX(0);
    }
}
</style>

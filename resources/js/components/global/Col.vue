<template>
<div :class="classes">
    <slot />
</div>
</template>

<script>
export default
{
    name: "Col",
    props:
    {
        size:
        {
            type: String,
            default: null
        },
        xm:
        {
            type: String,
            default: null
        },
        md:
        {
            type: String,
            default: null
        },
        lg:
        {
            type: String,
            default: null
        },
        xl:
        {
            type: String,
            default: null
        }
    },
    computed:
    {
        classes: function ()
        {
            let c = {
                "col": !this.size
            }
            if ( this.size )
            {
                c[ "col-" + this.size ] = true
            }
            if ( this.xm )
            {
                c[ "col-xm-" + this.xm ] = true
            }
            if ( this.md )
            {
                c[ "col-md-" + this.md ] = true
            }
            if ( this.lg )
            {
                c[ "col-lg-" + this.lg ] = true
            }
            if ( this.xl )
            {
                c[ "col-xl-" + this.xl ] = true
            }
            return c;
        }
    }
}
</script>

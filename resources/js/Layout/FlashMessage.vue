<template>
<transition name="bottom-up">
    <div class="flash-message alert"
      v-if="visible"
      :class="'alert-' + messages.type">
        <div class="mb-3" v-for="message in messages.msg" :key="message">{{message}}</div>
        <button class="btn btn-back" @click="hide">{{ __("accept") }}</button>
    </div>
</transition>
</template>

<script>
import
{
    Inertia
}
from '@inertiajs/inertia';

export default
{
    name: "FlashMessage",
    props:
    {
        id: String,
        time:
        {
            type: Number,
            default: 5000,
        },
        flash: String
    },
    data()
    {
        return {
            messages: {},
            listener: null,
            visible: false,
            type: "primary",
            timer: null
        }
    },
    deleted()
    {
        this.listener()
    },
    mounted()
    {
        this.listener = Inertia.on( "invalid", ( event ) =>
        {
            event.preventDefault()
            const res = event.detail.response
            //check if response is valid
            if ( res.status === 200 )
            {
                const data = event.detail.response.data
                if(data.message){
                  this.show( data.message, "success" )
                }
                if(data.redirect){
                  this.$inertia.get(data.redirect);
                }
            }
            else if ( res )
            {
                // this is for the errors
                const data = event.detail.response.data
                this.show( data.message, "danger" )
            }
        } )
    },
    methods:
    {
        show( message, type )
        {
            const msgArr = message.split(".");
            this.messages = 
            {
                msg: msgArr,
                type: type
            }
            if ( !this.visible )
            {
                this.visible = true;
            }
        },
        check()
        {
            if ( this.messages != null )
            {
                this.visible = true
            }
        },
        hide()
        {
            this.visible = false;

        }
    }
}
</script>

<style lang="scss" scoped>
@import "../../sass/variables"; // Variables
.flash-message {
    top: 50%;
    left: 50%;
    position: fixed;
    pointer-events: all;
    z-index: 9999;
    transform: translate(-50%, -50%);
    background-color: $white;
    padding: 20px;
    min-width: 50%;
    min-height: 20px;
    text-align: center;
    .btn{
        margin: 0 auto;
    }
}
</style>

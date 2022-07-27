<template>
<transition name="fade-layout">
    <div class="background">
        <transition name="fade"
          mode="out-in">
            <div v-if="data.ready" class="h-100">
                <div class="w-100"
                  :class="{'disabled': data.loading}">
                    
                    <div class="total-height d-flex justify-content-center p-lg-5">
                      <div class="d-flex align-items-center"><!-- Content -->
                        <slot />
                      </div>
                  
                    </div>
                      
                </div>
            </div>
        </transition>
        <flash-message />
    </div>
</transition>
</template>

<script>
import { Inertia } from '@inertiajs/inertia';
import { ref, onMounted } from "vue";
import FlashMessage from "../FlashMessage";

export default
{
    name: "PublicLayout",
    components: {
        FlashMessage,
    },
    setup(){

      const data = ref({
            ready: false,
            loading: true,
            transition: false,
            success: [],
            error: []
      });


      onMounted( () => {

        data.value.ready = true;
        data.value.loading = false;

        Inertia.on( 'start', ( event ) =>
        {
            if ( !event.detail.visit.preserveState )
            {
                data.value.ready = false;
            }
        } ),
        Inertia.on( 'finish', ( event ) =>
        {
            data.value.ready = true;
            data.value.loading = false;
        });
        
        });

        return {
            data
        }
    } 
}
</script>

<style lang="scss">
@import "../../../sass/variables"; // Variables
#app{
  overflow-x: hidden;
}
.total-height{
  height: 100vh;
}
</style>

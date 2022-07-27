<template>
  <div v-if="links.length > 3">
    <div class="pagination d-flex flex-wrap justify-content-center">
        <div v-for="(link, index) in links" :key="index">
          <div v-if="link.url === null"  class="pag-link" :class="[(index == links.length - 1) ? 'last-item' : '', (index == 0) ? 'first-item' : '']" v-html="link.label" />
          <inertia-link v-else class="pag-link" :class="[{ 'active': link.active }, (index == links.length - 1) ? 'last-item' : '', (index == 0) ? 'first-item' : '']" :href="link.url" v-html="link.label" />
        </div>
    </div>
  </div>
</template>
  
<script>
export default {
    name: "Pagination",
  props: {
    links: Object,
  },
}
</script>
<style lang="scss" scoped>
@import "../../../sass/variables"; // Variables
  .pag-link{
    width: 36px;
    height: 36px;
    font-size: 14px;
    color: $primary;
    display: flex;
    align-items: center;
    justify-content: center;
    letter-spacing: -0.6px;
    margin-right: 10px;
    margin-left: 10px;
    &.active{
      background-color: $primary;
      color: $white;
      font-weight: 600;
    }
    &:hover{
        text-decoration: none;
        font-weight: 600;
      }
    &:not(.first-item, .last-item){
      &:hover{
        border: 1px solid $primary;
      }
    } 
    &.first-item{
      margin-right: 37px;
      &::before{
                content: "";
                background-image: url(/images/icons/icon-arrow.svg);
                height: 20px;
                width: 20px;
                background-size: cover;
                background-repeat: no-repeat;
                transform: rotate(0deg);
                padding: 0;
                margin: 0;
                display: block;
                transition: transform 0.3s ease;
                position: relative;
                right: 30px;
            }
    }
    &.last-item{
      margin-left: 37px;
      &::after{
                content: "";
                background-image: url(/images/icons/icon-arrow.svg);
                height: 20px;
                width: 20px;
                background-size: cover;
                background-repeat: no-repeat;
                transform: rotate(180deg);
                padding: 0;
                margin: 0;
                display: block;
                transition: transform 0.3s ease;
                position: relative;
                left: 30px;
            }
    }
  }
</style>
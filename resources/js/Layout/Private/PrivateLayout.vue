<template>
<div id="layout-wrapper">
  <transition name="main-menu">
    <private-header :loading="loading" />
  </transition>
  <div class="private-main-wrapper">
    <Private-menu v-model="expanded" />
    <div class="private-wrapper"
      :class="{disabled: loading, expanded: expanded}">
      <transition name="change-content"
        mode="out-in">
        <div class="content-wrapper container-fluid"
          v-if="ready">
          <main id="main-content">
            <slot />
          </main>
        </div>
      </transition>
    </div>

  </div>
  <flash-message />
</div>
</template>

<script>
import PrivateMenu from "./PrivateMenu";
import PrivateHeader from "./PrivateHeader";
import FlashMessage from "../FlashMessage";
import { Inertia } from '@inertiajs/inertia';

export default
{
  name: "PrivateLayout",
  components:
  {
    PrivateMenu,
    FlashMessage,
    PrivateHeader
  },
  data()
  {
    return {
      collapsed: true,
      ready: false,
      pageLoaded: false,
      loading: false,
      currentPage: "",
      hideTime: 2000,
      listeners: [],
      menu_show: false,
      expanded: false,
    }
  },
  methods:
  {
    scrollToTop()
    {
      window.scrollTo(
      {
        top: 0,
        left: 0,
        behavior: 'smooth'
      } );
    }
  },
  mounted()
  {
    this.ready = true;
    this.pageLoaded = true;
    this.currentPage = ""

    const listenerStart = Inertia.on( 'start', ( event ) =>
    {
      this.menu_show = false
      if ( !event.detail.visit.preserveScroll )
      {
        this.scrollToTop();
      }
      if ( !event.detail.visit.preserveState )
      {
        this.ready = false;
      }
      this.collapsed = true
      this.loading = true;
      /// KEEP THIS PATH WHERE THE LOGOUT PATH IS
      // when logout the menu will also hide
      if ( event.detail.visit.url.pathname === "/logout" )
      {
        this.pageLoaded = false
        this.loading = false
      }
    } )
    const listenerSuccess = Inertia.on( 'success', ( event ) =>
    {
      this.currentPage = event.detail.page.url
    } )
    const listenerFinish = Inertia.on( "finish", () =>
    {
      this.loading = false;
      this.ready = true
    } )
    this.listeners = [ listenerStart, listenerFinish, listenerSuccess ];
  },
  destroyed()
  {
    for ( let listener of this.listeners )
    {
      listener()
    }
  }
}
</script>

<style lang="scss" scoped>
@import "../../../sass/variables"; // Variables
.private-wrapper {
    margin: auto;
    min-height: calc(100vh - 90px);
    padding-top: 30px;
    margin: auto;
    padding-left: 88px;
    padding-right: 10px;
    transition: padding .3s ease;
    width: 100%;
    background-color: $color-background;
    &.expanded{
      padding-left: 220px;
    }
}
.private-main-wrapper{
  position: relative;
  padding-top: 70px;
  display: flex;
}
</style>

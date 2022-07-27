<template>
<div class="menu"
  :class="{expanded: modelValue}">
    <img v-if="modelValue" class="main-logo" src="/images/test_logo.jpeg" alt="logo"/>
    <img v-else class="main-logo" src="/images/test_logo.jpeg" alt="logo"/>
    <div class="expander-wrapper">
        <icon @click="handleExpand()"
          name="keyboard_arrow_right" />
    </div>
    <div v-for="(parent, key) of routes"
        :key="key"
        :class="key"
      class="link-group">
        <div v-for="(elem, idx) of parent" :key="idx">
            <div class="link-wrapper"
              :class="{'active': checkActive(elem.route)}">
                <div class="single-link">
                    <inertia-link preserve-state
                      preserve-scroll
                      :href="elem.route">
                        <div class="img-wrapper">
                            <img :src="'/images/icons/' + elem.icon + '.svg'" />
                            <!-- <i :class="elem.icon"></i> -->
                        </div>
                        <div class="link-text">{{elem.name}}</div>
                    </inertia-link>
                    <div class="child-toggler"
                      :class="{'child-expanded': elem.showChild}"
                      v-if="elem.children"
                      @click="handleExpandElement(elem)">
                        <!-- <icon name="keyboard_arrow_down" /> -->
                    </div>
                </div>
                <toggle-height>
                    <div v-if="elem.children && elem.showChild">
                        <ul>
                            <li v-for="child of elem.children"
                                :key="child.name"
                                class="link-wrapper">
                                <inertia-link preserve-state
                                  preserve-scroll
                                  :href="child.route">{{child.name}}</inertia-link>
                            </li>
                        </ul>
                    </div>
                </toggle-height>
            </div>
        </div>
    </div>
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
    name: "PrivateMenu",
    props:
    {
        modelValue: Boolean
    },
    data()
    {
        return {
            currentPage: "",
            routes: [],
            singleBlocked: false
        }
    },
    mounted()
    {
        this.routes = JSON.parse( JSON.stringify( this.$page.props.routes ) )
        this.currentPage = window.location.pathname
        Inertia.on( 'success', ( event ) =>
        {
            this.currentPage = event.detail.page.url
        } )
    },
    methods:
    {
        checkActive( route )
        {
            // return false
            return this.currentPage.includes( route ) && ( route != '/' && this.currentPage != '' )
        },
        handleExpand()
        {
            if ( this.modelValue )
            {
                for ( const [ idx, child ] of Object.entries( this.$page.props.routes ) )
                {
                    if ( child.showChild )
                    {
                        child.showChild = false
                    }
                }
            }
            this.$emit( "update:modelValue", !this.modelValue )
        },
        handleExpandElement( elem )
        {
            if ( !this.singleBlocked )
            {
                this.singleBlocked = true
                elem.showChild = !elem.showChild
                const self = this
                setTimeout( () =>
                {
                    self.singleBlocked = false
                }, 400 )
            }
        }
    }

}
</script>

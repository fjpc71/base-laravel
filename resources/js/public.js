// resources/js/app.js
require("./bootstrap");

import { createApp, h } from 'vue'

import { 
    App as InertiaApp,
    plugin as InertiaPlugin
} from '@inertiajs/inertia-vue3'

import store from "./store"

import {
    components
} from "./global-components"

import PublicLayout from "./Layout/Public/PublicLayout"
//import VueSidebarMenu from 'vue-sidebar-menu'

const el = document.getElementById("app")

const app = createApp({
        render: () => h(InertiaApp, {
            initialPage: JSON.parse(el.dataset.page),
            resolveComponent: (name) => {

                const page = require(`./Public/${name}`).default
                
                if (!page.layout) {
                    page.layout = PublicLayout
                }
                
                return page
            },
        })
    })
    .use(InertiaPlugin)
    //.use(VueSidebarMenu)
    .mixin(require('./language'))
app.use(store)

components(app)
app.mount(el)
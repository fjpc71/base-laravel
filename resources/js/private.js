// resources/js/app.js
require("./bootstrap");

import {
    createApp,
    h
} from 'vue'

import {
    App as InertiaApp,
    plugin as InertiaPlugin
} from '@inertiajs/inertia-vue3'

import store from "./store"

import {
    components
} from "./global-components"

import PrivateLayout from "./Layout/Private/PrivateLayout";

import 'primeicons/primeicons.css';

const el = document.getElementById("app");

const app = createApp({
        render: () => h(InertiaApp, {
            initialPage: JSON.parse(el.dataset.page),
            resolveComponent: (name) => {
                const page = require(`./Private/${name}`).default

                if (!page.layout) {
                    page.layout = PrivateLayout
                }

                return page
            },
        })
    })
    .use(InertiaPlugin)
    .mixin(require('./language'))
app.use(store)
components(app)
app.mount(el)
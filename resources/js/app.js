require('./bootstrap');

// import Alpine from 'alpinejs';

// window.Alpine = Alpine;

// Alpine.start();


import { createApp, h } from 'vue';
import { createInertiaApp, Link,Head } from '@inertiajs/inertia-vue3';
import { InertiaProgress } from '@inertiajs/progress';
import Layout from "./Shared/Layout";


createInertiaApp({
    resolve: name => {
        let page = require(`./Pages/${name}`).default;

        if(page.layout == undefined){
            page.layout = Layout
        }
        return page;
    },
    // resolve: name => require(`./Pages/${name}`),
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .use(plugin)
            .component("Link" ,Link)
            .component("Head" ,Head)
            .mixin({ methods:{route} })
            .mount(el)
    },

    title:  title => title
})


InertiaProgress.init({
    color:'red'
});


    import './bootstrap'
    import '../css/app.scss'

    import '@mdi/font/css/materialdesignicons.css';


    import { createApp, h } from 'vue'
    import { createInertiaApp } from '@inertiajs/inertia-vue3'
    import { InertiaProgress } from '@inertiajs/progress'
    import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers'
    import { ZiggyVue } from '../../vendor/tightenco/ziggy/dist/vue.m'
    import VueCarousel from 'vue-carousel';


    // Vuetify
    import 'vuetify/styles'
    import { createVuetify } from 'vuetify'
    import * as components from 'vuetify/components'
    import * as directives from 'vuetify/directives'
    import { aliases, fa } from 'vuetify/iconsets/fa'

    const vuetify = createVuetify({
    components,
    directives,

    })

    export default vuetify;
    // createApp(App).use(vuetify).mount('#app')




    const appName =
        window.document.getElementsByTagName('title')[0]?.innerText || 'K UI'

    createInertiaApp({
        title: (title) => `${title} - ${appName}`,
        resolve: (name) =>
            resolvePageComponent(
                `./Pages/${name}.vue`,
                import.meta.glob('./Pages/**/*.vue')
            ),
        setup({ el, app, props, plugin }) {
            return createApp({ render: () => h(app, props) })
                .use(plugin)
                .use(vuetify)
                .use(ZiggyVue, Ziggy)
                .use(VueCarousel)
                .mount(el)
        },
    })

    InertiaProgress.init({ color: '#1C4EFE' })

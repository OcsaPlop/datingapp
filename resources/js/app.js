import { createApp, h } from 'vue'
import { createInertiaApp, Link } from '@inertiajs/vue3'
import Default from './Layouts/Default.vue'

createInertiaApp({
  resolve: (name) => {
    const pages = import.meta.glob('./Pages/**/*.vue', {
      eager: true,
    })
    let page = pages[`./Pages/${name}.vue`]
    if (page.default.layout === undefined) {
      page.default.layout = Default
    }
    return page
  },
  setup({ el, App, props, plugin }) {
    createApp({ render: () => h(App, props) })
      .use(plugin)
      .component('Link', Link)
      .mount(el)
  },
  progress: {
    color: '#ee6c9b',
  },
})

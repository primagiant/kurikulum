import { createApp, h } from "vue";
import { createInertiaApp, Link, Head } from "@inertiajs/vue3";
import { resolvePageComponent } from "laravel-vite-plugin/inertia-helpers";
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";

// font awsome library
import { library } from "@fortawesome/fontawesome-svg-core";
import {
    faHouseChimney,
    faBook,
    faUserAlt,
    faGraduationCap,
    faList,
} from "@fortawesome/free-solid-svg-icons";
library.add(faHouseChimney, faGraduationCap, faUserAlt, faList, faBook);

createInertiaApp({
    resolve: (name) =>
        resolvePageComponent(
            `./Pages/${name}.vue`,
            import.meta.glob("./Pages/**/*.vue")
        ),
    setup({ el, App, props, plugin }) {
        return createApp({ render: () => h(App, props) })
            .use(plugin)
            .mixin({ methods: { route } })
            .component("Link", Link)
            .component("Head", Head)
            .component("Icon", FontAwesomeIcon)
            .mount(el);
    },
    progress: {
        color: "#4237ff",
    },
    title: (title) => `Kurikulum - ${title}`,
});

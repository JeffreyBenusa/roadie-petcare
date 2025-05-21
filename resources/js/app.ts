import '../css/app.css';

import { createInertiaApp, Link, Head } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import type { DefineComponent } from 'vue';
import { createApp, h } from 'vue';
import { ZiggyVue } from 'ziggy-js';
import { initializeTheme } from './composables/useAppearance';

// Project Components
import WebLayout from './layouts/WebLayout.vue';

// Extend ImportMeta interface for Vite...
// @ts-expect-error fixing an error
declare module 'vite/client' {
    interface ImportMetaEnv {
        readonly VITE_APP_NAME: string;
        [key: string]: string | boolean | undefined;
    }

    interface ImportMeta {
        readonly env: ImportMetaEnv;
        readonly glob: <T>(pattern: string) => Record<string, () => Promise<T>>;
    }
}

const appName = import.meta.env.VITE_APP_NAME || 'Roadies';

createInertiaApp({
    title: (title) => `${title} | ${appName}`,
    resolve: async name => {
        const pages = import.meta.glob('./pages/**/*.vue')
        const importPage = pages[`./pages/${name}.vue`]

        if (!importPage) {
            throw new Error(`Page not found: ${name}`)
        }

        const page = await importPage()

        // if the page doesn't start with 'admin' or 'login' or 'settings' then set the layout to WebLayout
        // todo: move settings behind 'admin' uri
        if (!name.startsWith('admin') && !name.startsWith('auth') && !name.startsWith('settings')) {
            page.default.layout = page.default.layout || WebLayout
        }

        return page
    },
    setup({ el, App, props, plugin }) {
        createApp({ render: () => h(App, props) })
            .component('Link', Link)
            .component('Head', Head)
            .use(plugin)
            .use(ZiggyVue)
            .mount(el);
    },
    progress: {
        color: '#4B5563',
    },
});

// This will set light / dark mode on page load...
initializeTheme();
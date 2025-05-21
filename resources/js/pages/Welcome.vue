<script setup lang="ts">
import {
    ArrowPathIcon,
    CloudArrowUpIcon,
    CogIcon,
    LockClosedIcon,
    ServerIcon,
    ShieldCheckIcon,
    InboxIcon,
    SparklesIcon
} from '@heroicons/vue/24/outline'

defineOptions({
    name: "Homepage",
})

const features = [
    {
        name: 'Push to Deploy',
        description: 'Ac tincidunt sapien vehicula erat auctor pellentesque rhoncus. Et magna sit morbi lobortis.',
        icon: CloudArrowUpIcon,
    },
    {
        name: 'SSL Certificates',
        description: 'Ac tincidunt sapien vehicula erat auctor pellentesque rhoncus. Et magna sit morbi lobortis.',
        icon: LockClosedIcon,
    },
    {
        name: 'Simple Queues',
        description: 'Ac tincidunt sapien vehicula erat auctor pellentesque rhoncus. Et magna sit morbi lobortis.',
        icon: ArrowPathIcon,
    },
    {
        name: 'Advanced Security',
        description: 'Ac tincidunt sapien vehicula erat auctor pellentesque rhoncus. Et magna sit morbi lobortis.',
        icon: ShieldCheckIcon,
    },
    {
        name: 'Powerful API',
        description: 'Ac tincidunt sapien vehicula erat auctor pellentesque rhoncus. Et magna sit morbi lobortis.',
        icon: CogIcon,
    },
    {
        name: 'Database Backups',
        description: 'Ac tincidunt sapien vehicula erat auctor pellentesque rhoncus. Et magna sit morbi lobortis.',
        icon: ServerIcon,
    },
]
</script>

<template>
    <Head title="Homepage">
        <link rel="preconnect" href="https://rsms.me/" />
        <link rel="stylesheet" href="https://rsms.me/inter/inter.css" />
        <title>Homepage</title>
        <meta name="description" content="Homepage Inertia" head-key="description" />
    </Head>

    <div class="relative bg-white py-24 sm:py-32 lg:py-40">
        <div class="mx-auto max-w-md px-6 text-center sm:max-w-3xl lg:max-w-7xl lg:px-8">
            <h2 class="text-lg font-semibold text-indigo-600">Deploy faster</h2>
            <p class="mt-2 text-3xl font-bold tracking-tight text-gray-900 sm:text-4xl">Everything you need to deploy your app</p>
            <p class="mx-auto mt-5 max-w-prose text-xl text-gray-500">Phasellus lorem quam molestie id quisque diam aenean nulla in. Accumsan in quis quis nunc, ullamcorper malesuada. Eleifend condimentum id viverra nulla.</p>
            <div class="mt-20">
                <div class="grid grid-cols-1 gap-12 sm:grid-cols-2 lg:grid-cols-3">
                    <div v-for="feature in features" :key="feature.name" class="pt-6">
                        <div class="flow-root rounded-lg bg-gray-50 px-6 pb-8">
                            <div class="-mt-6">
                                <div>
                  <span class="inline-flex items-center justify-center rounded-xl bg-indigo-500 p-3 shadow-lg">
                    <component :is="feature.icon" class="size-8 text-white" aria-hidden="true" />
                  </span>
                                </div>
                                <h3 class="mt-8 text-lg/8 font-semibold tracking-tight text-gray-900">{{ feature.name }}</h3>
                                <p class="mt-5 text-base/7 text-gray-600">{{ feature.description }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="relative overflow-hidden bg-white py-16">
        <div class="relative">
            <div class="lg:mx-auto lg:grid lg:max-w-7xl lg:grid-flow-col-dense lg:grid-cols-2 lg:gap-24 lg:px-8">
                <div class="mx-auto max-w-xl px-6 lg:mx-0 lg:max-w-none lg:px-0 lg:py-16">
                    <div>
                        <div>
              <span class="flex size-12 items-center justify-center rounded-xl bg-indigo-600">
                <InboxIcon class="size-8 text-white" aria-hidden="true" />
              </span>
                        </div>
                        <div class="mt-6">
                            <h2 class="text-3xl font-bold tracking-tight text-gray-900">Stay on top of customer support</h2>
                            <p class="mt-4 text-lg text-gray-500">Semper curabitur ullamcorper posuere nunc sed. Ornare iaculis bibendum malesuada faucibus lacinia porttitor. Pulvinar laoreet sagittis viverra duis. In venenatis sem arcu pretium pharetra at. Lectus viverra dui tellus ornare pharetra.</p>
                            <div class="mt-6">
                                <a href="#" class="inline-flex rounded-lg bg-indigo-600 px-4 py-1.5 text-base/7 font-semibold text-white shadow-xs ring-1 ring-indigo-600 hover:bg-indigo-700 hover:ring-indigo-700">Get started</a>
                            </div>
                        </div>
                    </div>
                    <div class="mt-8 border-t border-gray-200 pt-6">
                        <blockquote>
                            <div>
                                <p class="text-base text-gray-500">&ldquo;Cras velit quis eros eget rhoncus lacus ultrices sed diam. Sit orci risus aenean curabitur donec aliquet. Mi venenatis in euismod ut.&rdquo;</p>
                            </div>
                            <footer class="mt-3">
                                <div class="flex items-center space-x-3">
                                    <div class="shrink-0">
                                        <img class="size-6 rounded-full" src="https://images.unsplash.com/photo-1509783236416-c9ad59bae472?ixlib=rb-=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=8&w=1024&h=1024&q=80" alt="" />
                                    </div>
                                    <div class="text-base font-medium text-gray-700">Marcia Hill, Digital Marketing Manager</div>
                                </div>
                            </footer>
                        </blockquote>
                    </div>
                </div>
                <div class="mt-12 sm:mt-16 lg:mt-0">
                    <div class="-mr-48 pl-6 md:-mr-16 lg:relative lg:m-0 lg:h-full lg:px-0">
                        <img class="w-full rounded-xl shadow-xl ring-1 ring-black/5 lg:absolute lg:left-0 lg:h-full lg:w-auto lg:max-w-none" src="https://tailwindcss.com/plus-assets/img/component-images/inbox-app-screenshot-1.jpg" alt="Inbox user interface" />
                    </div>
                </div>
            </div>
        </div>
        <div class="mt-24">
            <div class="lg:mx-auto lg:grid lg:max-w-7xl lg:grid-flow-col-dense lg:grid-cols-2 lg:gap-24 lg:px-8">
                <div class="mx-auto max-w-xl px-6 lg:col-start-2 lg:mx-0 lg:max-w-none lg:px-0 lg:py-32">
                    <div>
                        <div>
              <span class="flex size-12 items-center justify-center rounded-xl bg-indigo-600">
                <SparklesIcon class="size-8 text-white" aria-hidden="true" />
              </span>
                        </div>
                        <div class="mt-6">
                            <h2 class="text-3xl font-bold tracking-tight text-gray-900">Better understand your customers</h2>
                            <p class="mt-4 text-lg text-gray-500">Semper curabitur ullamcorper posuere nunc sed. Ornare iaculis bibendum malesuada faucibus lacinia porttitor. Pulvinar laoreet sagittis viverra duis. In venenatis sem arcu pretium pharetra at. Lectus viverra dui tellus ornare pharetra.</p>
                            <div class="mt-6">
                                <a href="#" class="inline-flex rounded-lg bg-indigo-600 px-4 py-1.5 text-base/7 font-semibold text-white shadow-xs ring-1 ring-indigo-600 hover:bg-indigo-700 hover:ring-indigo-700">Get started</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="mt-12 sm:mt-16 lg:col-start-1 lg:mt-0">
                    <div class="-ml-48 pr-6 md:-ml-16 lg:relative lg:m-0 lg:h-full lg:px-0">
                        <img class="w-full rounded-xl shadow-xl ring-1 ring-black/5 lg:absolute lg:right-0 lg:h-full lg:w-auto lg:max-w-none" src="https://tailwindcss.com/plus-assets/img/component-images/inbox-app-screenshot-2.jpg" alt="Customer profile user interface" />
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

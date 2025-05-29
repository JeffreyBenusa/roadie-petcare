<script setup lang="ts">
import {ref, computed} from 'vue'
import {usePage} from '@inertiajs/vue3'
import {Dialog, DialogPanel} from '@headlessui/vue'
import {Bars3Icon, XMarkIcon} from '@heroicons/vue/24/outline'

import Button from '@/shared/Button.vue'

import logoUrl from '@images/logo.svg'

const navigation = [
    {name: 'Listings', href: '/listings'}]

defineOptions({
    name: 'Navigation',
    components: {
        Button
    }
})
// Grab the user from shared props
const user = computed(() => usePage().props.auth.user)
const mobileMenuOpen = ref(false)

</script>
<template>
    <header>
        <nav class="mx-auto flex container items-center justify-between p-6 lg:px-6" aria-label="Global">
            <Link href="/">
                <span class="sr-only">Roadie Petcare Logo</span>
                <img class="w-56" :src="logoUrl" alt="Roadie Petcare Logo" height="45"/>
            </Link>
            <div class="flex lg:hidden">
                <button type="button"
                        class="-m-2.5 inline-flex items-center justify-center rounded-md p-2.5 text-gray-700"
                        @click="mobileMenuOpen = true">
                    <span class="sr-only">Open main menu</span>
                    <Bars3Icon class="size-6" aria-hidden="true"/>
                </button>
            </div>
            <div class="hidden lg:flex lg:gap-x-8 text-sm/6 font-semibold text-gray-900 items-center">
                <Link v-for="item in navigation" :key="item.name" :href="item.href"
                      class="">{{ item.name }}
                </Link>
                <Button v-if="!user" href="/login" class="button">Log in <span aria-hidden="true">&rarr;</span></Button>
                <Link href="/admin/listings/create" v-if="user?.can.listing.create" class="button">
                    Create Listing
                </Link>
            </div>
        </nav>
        <Dialog class="lg:hidden" @close="mobileMenuOpen = false" :open="mobileMenuOpen">
            <div class="fixed inset-0 z-10"/>
            <DialogPanel
                    class="fixed inset-y-0 right-0 z-10 w-full overflow-y-auto bg-white px-6 py-6 sm:max-w-sm sm:ring-1 sm:ring-gray-900/10">
                <div class="flex items-center justify-between">
                    <Link href="/" class="-m-1.5 p-1.5">
                        <span class="sr-only">Your Company</span>
                        <img class="h-8 w-auto"
                             src="https://tailwindcss.com/plus-assets/img/logos/mark.svg?color=indigo&shade=600"
                             alt=""/>
                    </Link>
                    <button type="button" class="-m-2.5 rounded-md p-2.5 text-gray-700" @click="mobileMenuOpen = false">
                        <span class="sr-only">Close menu</span>
                        <XMarkIcon class="size-6" aria-hidden="true"/>
                    </button>
                </div>
                <div class="mt-6 flow-root">
                    <div class="-my-6 divide-y divide-gray-500/10">
                        <div class="space-y-2 py-6">
                            <Link v-for="item in navigation" :key="item.name" :href="item.href"
                                  class="-mx-3 block rounded-lg px-3 py-2 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">
                                {{ item.name }}
                            </Link>
                        </div>
                        <div class="py-6">
                            <Link v-if="!user" href="/login"
                                  class="-mx-3 block rounded-lg px-3 py-2.5 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">
                                Log in <span aria-hidden="true">&rarr;</span></Link>
                            <Link v-else href="/dashboard"
                                  class="-mx-3 block rounded-lg px-3 py-2.5 text-base/7 font-semibold text-gray-900 hover:bg-gray-50">
                                Dashboard
                            </Link>
                        </div>
                    </div>
                </div>
            </DialogPanel>
        </Dialog>
    </header>
</template>


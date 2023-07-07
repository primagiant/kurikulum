<template>
    <Head title="Dashboard" />
    <header class="fixed right-0 left-0 z-50 shadow-sm">
        <nav class="bg-gray-100 border-gray-200 px-4 lg:px-6 py-3 dark:bg-gray-800">
            <div class="flex flex-wrap justify-between items-center">
                <div class="flex justify-start items-center">
                    <button @click="toggleNavbar()" aria-expanded="true" aria-controls="sidebar"
                        class="p-2 mr-2 text-gray-600 rounded-lg cursor-pointer lg:hidden hover:text-gray-900 hover:bg-gray-100 focus:bg-gray-100 dark:focus:bg-gray-700 focus:ring-2 focus:ring-gray-100 dark:focus:ring-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white">
                        <svg aria-hidden="true" v-show="!navOpen" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h6a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <svg aria-hidden="true" v-show="navOpen" class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span class="sr-only">Toggle sidebar</span>
                    </button>
                    <span
                        class="self-center text-2xl font-quick font-semibold whitespace-nowrap dark:text-white">Kurikulum</span>
                </div>
                <div class="flex items-center lg:order-2">
                    <button type="button"
                        class="flex mx-3 text-sm bg-gray-800 rounded-full md:mr-0 focus:ring-4 focus:ring-gray-300 dark:focus:ring-gray-600"
                        id="user-menu-button" aria-expanded="false" data-dropdown-toggle="dropdown">
                        <span class="sr-only">Open user menu</span>
                        <img class="w-8 h-8 rounded-full"
                            src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="user photo" />
                    </button>
                    <!-- Dropdown menu -->
                    <div class="hidden z-50 my-4 w-56 text-base list-none bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600"
                        id="dropdown">
                        <div class="py-3 px-4">
                            <span class="block text-sm font-semibold text-gray-900 dark:text-white">
                                {{ user.name }}
                            </span>
                            <span class="block text-sm font-light text-gray-500 truncate dark:text-gray-400">
                                {{ user.email }}
                            </span>
                        </div>
                        <ul class="py-1 font-light text-gray-500 dark:text-gray-400" aria-labelledby="dropdown">
                            <li>
                                <a href="#"
                                    class="block py-2 px-4 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-400 dark:hover:text-white">My
                                    profile</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="block py-2 px-4 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-400 dark:hover:text-white">Account
                                    settings</a>
                            </li>
                        </ul>
                        <ul class="py-1 font-light text-gray-500 dark:text-gray-400" aria-labelledby="dropdown">
                            <li>
                                <Link :href="route('logout')" as="button" method="post"
                                    class="block w-full text-left py-2 px-4 text-sm hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                Sign out
                                </Link>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <Sidebar :items="sidebarItems" class="lg:translate-x-0 z-40" :class="navOpen ? 'translate-x-0' : '-translate-x-72'" />
    <div class="flex w-full">
        <div class="bg-gray-50 lg:ml-64 md:ml-0 transition-transform w-full mt-14"
            :class="navOpen ? 'md:ml-64' : 'md:ml-0'">
            <slot />
        </div>
    </div>
</template>

<script setup>
import { initFlowbite } from "flowbite"
import { usePage } from "@inertiajs/vue3"
import Sidebar from "@/Pages/Components/Sidebar/Sidebar.vue"
import { onMounted, ref } from "vue"
import { computed } from "@vue/reactivity"

onMounted(() => {
    initFlowbite()
})

const user = computed(() => usePage().props.auth.user)

const navOpen = ref(false)
const toggleNavbar = () => {
    navOpen.value = !navOpen.value
}

const sidebarItems = ref([
    [
        {
            title: "Home",
            link: route("dashboard"),
            icon: "fa-house-chimney",
            includeChild: false,
        },
        {
            title: "Feature",
            link: route("dashboard"),
            icon: "fa-list",
            includeChild: true,
            child: [
                {
                    title: "Profil Lulusan",
                    link: route("profil.lulusan.index"),
                },
                {
                    title: "Capaian Profil Lulusan",
                    link: route("cpl.index"),
                },
                {
                    title: "Bahan Kajian",
                    link: route("dashboard"),
                },
                {
                    title: "Mata Kuliah",
                    link: route("dashboard"),
                },
                {
                    title: "CPMK",
                    link: route("dashboard"),
                },
                {
                    title: "Sub-CPMK",
                    link: route("dashboard"),
                },
            ],
        },
        {
            title: "Mapping Feature",
            link: route("dashboard"),
            icon: "fa-list",
            includeChild: true,
            child: [
                {
                    title: "CPL - PL",
                    link: route("map.cpl.pl"),
                },
                {
                    title: "BK - CPL",
                    link: route("map.bk.cpl"),
                },
                {
                    title: "BK - MK",
                    link: route("map.bk.mk"),
                },
                {
                    title: "CPL - MK",
                    link: route("map.cpl.mk"),
                },
                {
                    title: "3 Dimensi",
                    link: route("dashboard"),
                },
            ],
        },
    ],
    [
        {
            title: "Docs",
            link: route("dashboard"),
            icon: "fa-book",
            includeChild: false,
        },
    ],
])
</script>

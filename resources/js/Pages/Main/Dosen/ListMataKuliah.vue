<template>
    <Head title="List Mata Kuliah" />
    <layout>
        <Breadcrumb :items="breadcrumbItems" />
        <div class="p-6">
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                    <div class="w-full md:w-1/2">
                        <form class="flex items-center">
                            <label for="simple-search" class="sr-only">Search</label>
                            <div class="relative w-full">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                        fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input type="text" id="simple-search" placeholder="Search.."
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-200">
                            <tr>
                                <th scope="col" class="px-4 py-3">List Mata Kuliah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="data in mk" :key="data.id_mk" @click="goToSubCPMK(data.id_mk)"
                                class="border-b cursor-pointer hover:bg-gray-50 group/animation">
                                <td class="px-4 py-3 relative">
                                    <h2 class="font-bold text-lg">{{ data.nama_mk }}</h2>
                                    <p class="my-1.5">{{ data.deskripsi_mk }}</p>
                                    <p><small class="font-bold">Semester : {{ data.sks }}</small></p>
                                    <p><small class="font-bold">SKS : {{ data.sks }}</small></p>
                                    <p
                                        class="font-quick absolute text-xs bottom-3 right-3 bg-red-500 px-3 py-1.5 uppercase rounded-md text-white">
                                        {{ data.kategori_mk }}
                                    </p>
                                </td>
                            </tr>
                            <tr v-if="mk.length == 0">
                                <td colspan="3" class="border-b px-4 py-3 font-medium text-gray-900 text-center">No Data
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </layout>
</template>

<script setup>
// Import Library
import Layout from '@/Pages/Layouts/DosenLayout.vue'
import { ref, watch, onMounted } from 'vue'
import { router } from '@inertiajs/vue3'

// Import Component
import Breadcrumb from '@/Pages/Components/Breadcrumbs/Breadcrumb.vue'

// Setting Breadcrumb
const breadcrumbItems = ref([
    { name: "Feature" },
    { name: "List Mata Kuliah", link: route('dosen.list.mk') },
])

const props = defineProps({
    mk: Object,
})

const goToSubCPMK = (id_mk) => {
    router.get(route('dosen.list.subcpmk', { id_mk: id_mk }))
}
</script>

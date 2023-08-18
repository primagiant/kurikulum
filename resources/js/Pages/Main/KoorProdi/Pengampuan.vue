<template>
    <Head title="User" />
    <layout>
        <Breadcrumb :items="breadcrumbItems" />
        <div class="p-6">
            <h1 class="mb-5">Pengampuan</h1>
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                <div class="overflow-x-auto flex relative">
                    <table class="w-72 text-sm text-left text-gray-500 dark:text-gray-400 mb-4 absolute"
                        :class="showMatkul ? '' : 'hidden'">
                        <thead class="h-32 text-xs text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" colspan="100%" class="px-4 py-3 text-center">Detail MK</th>
                            </tr>
                            <tr>
                                <th scope="col" rowspan="2" class="px-4 py-3 text-center">Mata Kuliah</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="mk_item, idy in mk" class="border-b dark:border-gray-700">
                                <td class="px-4 py-3 text-center">
                                    {{ mk_item.nama_mk }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <table class="table-fixed w-full text-sm text-left text-gray-500 dark:text-gray-400 mb-4"
                        :class="showMatkul ? 'ml-72' : ''">
                        <thead class="h-32 text-xs text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" :colspan="dosen.length" class="px-4 py-3 text-center relative">
                                    <div class="absolute top-6 left-6">
                                        <button @click="handleShowMatkul"
                                            class="bg-blue-700 hover:bg-blue-800 py-1.5 px-3 text-xs rounded-md text-white">
                                            <svg v-if="showMatkul" fill="none" stroke="currentColor" width="16"
                                                stroke-width="1.5" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                                aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M18.75 19.5l-7.5-7.5 7.5-7.5m-6 15L5.25 12l7.5-7.5"></path>
                                            </svg>
                                            <svg v-else fill="none" stroke="currentColor" width="16" stroke-width="1.5"
                                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                    d="M11.25 4.5l7.5 7.5-7.5 7.5m-6-15l7.5 7.5-7.5 7.5"></path>
                                            </svg>
                                        </button>
                                    </div>
                                    List Dosen
                                </th>
                            </tr>
                            <tr>
                                <th v-for="dosen_item in dosen" scope="col" class="px-4 py-3 text-center">
                                    {{ dosen_item.name }}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="mk_item, idy in mk" class="border-b dark:border-gray-700">
                                <td v-for="(dosen_item, idx) in dosen" class="px-4 py-3 text-center">
                                    <input @change="selectRelation(mk_item.id_mk, dosen_item.id)" type="checkbox"
                                        :checked="dataActive[idy][idx]">
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
// Library
import Layout from '@/Pages/Layouts/KoorProdiLayout.vue'
import { ref, onBeforeMount } from 'vue'
import { router } from '@inertiajs/vue3'

// Import Components
import Breadcrumb from '@/Pages/Components/Breadcrumbs/Breadcrumb.vue'

// BaseUrl
import GlobalVariable from '@/variable.js'
const baseUrl = GlobalVariable.base_url

// Breadcrumb
const breadcrumbItems = ref([
    { name: "Maping" },
    // { name: "Pengampuan", link: route('map.bk.cpl') },
])

// Property
const props = defineProps({
    dosen: Array,
    mk: Array,
    pengampuan: Array,
})

// Make active state for the checkbox
const dataActive = ref([])
onBeforeMount(() => {
    props.mk.forEach((mk_item) => {
        const row = []
        props.dosen.forEach((dosen_item) => {
            let exists = props.pengampuan.some(item => item.id === dosen_item.id && item.id_mk === mk_item.id_mk)
            if (exists) {
                row.push(1)
            } else {
                row.push(0)
            }
        })
        dataActive.value.push(row)
    })
})

// Make relation
const selectRelation = (id_mk, id_dosen) => {
    // router.post(`${baseUrl}/bk_cpl`, {
    //     id_mk,
    //     id_dosen
    // }, { preserveScroll: true })
}

const showMatkul = ref(true)
const handleShowMatkul = () => {
    showMatkul.value = !showMatkul.value
}
</script>

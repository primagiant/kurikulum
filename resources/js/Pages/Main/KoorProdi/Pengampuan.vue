<template>
    <Head title="User" />
    <layout>
        <Breadcrumb :items="breadcrumbItems" />
        <div class="p-6">
            <h1 class="mb-5">Pengampuan</h1>
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg">
                <div class="overflow-x-auto flex relative">
                    <table class="table-auto w-full text-sm text-left text-gray-500 dark:text-gray-400 mb-4">
                        <thead class="h-32 text-xs text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" rowspan="2" class="px-4 py-3 text-center">Mata Kuliah</th>
                                <th scope="col" :colspan="dosen.length" class="px-4 py-3 text-center relative">
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
                                <td class="px-4 py-3 text-center">
                                    {{ mk_item.nama_mk }}
                                </td>
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
    { name: "Home" },
    { name: "Pengampuan", link: route('pengampuan.index') },
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
    router.post(route('pengampuan.store'), {
        id_mk,
        id_dosen
    }, { preserveScroll: true })
}
</script>

<template>
    <Head title="User" />
    <div>
        <Breadcrumb :items="breadcrumbItems" />
        <div class="p-6">
            <h1 class="mb-5">Maping Bahan Kajian - Mata Kuliah</h1>
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 mb-4">
                        <thead class="text-xs text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" rowspan="2" class="px-4 py-3 text-center">Kode MK</th>
                                <th scope="col" rowspan="2" class="px-4 py-3 text-center">Nama Mata Kuliah</th>
                                <th scope="col" colspan="100%" class="px-4 py-3 text-center">BK (Bahan Kajian)
                                </th>
                            </tr>
                            <tr>
                                <th v-for="bk_item in bk" :data-popover-target="`popover-cpl-${bk_item.id_bk}`"
                                    data-popover-placement="bottom" scope="col" class="px-4 py-3 text-center cursor-help">
                                    {{ bk_item.kode_bk }}
                                    <div data-popover :id="`popover-cpl-${bk_item.id_bk}`" role="tooltip"
                                        class="absolute z-10 font-light invisible inline-block w-64 text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 dark:text-gray-400 dark:border-gray-600 dark:bg-gray-800">
                                        <div
                                            class="px-3 py-2 bg-gray-100 border-b border-gray-200 rounded-t-lg dark:border-gray-600 dark:bg-gray-700">
                                            <h3 class="font-semibold text-gray-900 dark:text-white">{{ bk_item.nama_bk }}
                                            </h3>
                                        </div>
                                        <div class="px-3 py-2">
                                            <p>{{ bk_item.deskripsi_bk }}</p>
                                        </div>
                                        <div data-popper-arrow></div>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="mk_item, idy in mk" class="border-b dark:border-gray-700">
                                <td class="px-4 py-3 text-center">
                                    {{ mk_item.kode_mk_obe }}
                                </td>
                                <td class="px-4 py-3 text-left">
                                    {{ mk_item.nama_mk }}
                                </td>
                                <td v-for="bk_item, idx in bk" class="px-4 py-3 text-center">
                                    <input @change="selectRelation(mk_item.id_mk, bk_item.id_bk)" type="checkbox"
                                        :checked="dataActive[idy][idx]">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Layout from '@/Pages/Layouts/KoorProdiLayout.vue'
export default {
    layout: Layout
}
</script>

<script setup>
// Library
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
    { name: "Bahan Kajian - Mata Kuliah", link: route('map.bk.mk') },
])

// Property
const props = defineProps({
    mk: Array,
    bk: Array,
    maping: Array,
})

// Make active state for the checkbox
const dataActive = ref([])
onBeforeMount(() => {
    props.mk.forEach((mk_item) => {
        const row = []
        props.bk.forEach((bk_item) => {
            let exists = props.maping.some(item => item.id_bk === bk_item.id_bk && item.id_mk === mk_item.id_mk)
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
const selectRelation = (id_mk, id_bk) => {
    router.post(`${baseUrl}/bk_mk`, {
        id_bk,
        id_mk
    }, { preserveScroll: true })
}

</script>

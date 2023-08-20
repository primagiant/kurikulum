<template>
    <Head title="Capain Pembeljaran Lulusan - Mata Kuliah" />
    <layout>
        <Breadcrumb :items="breadcrumbItems" />
        <div class="p-6">
            <h1 class="mb-5">Maping Capain Pembeljaran Lulusan - Mata Kuliah</h1>
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400 mb-4">
                        <thead class="text-xs text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" rowspan="2" class="px-4 py-3 text-center">Kode MK</th>
                                <th scope="col" rowspan="2" class="px-4 py-3 text-center">Nama Mata Kuliah</th>
                                <th scope="col" colspan="100%" class="px-4 py-3 text-center">CPl (Capain Pembeljaran
                                    Lulusan)
                                </th>
                            </tr>
                            <tr>
                                <th v-for="cpl_item in cpl" :data-popover-target="`popover-cpl-${cpl_item.id_cpl}`"
                                    data-popover-placement="bottom" scope="col" class="px-4 py-3 text-center cursor-help">
                                    {{ cpl_item.kode_cpl }}
                                    <div data-popover :id="`popover-cpl-${cpl_item.id_cpl}`" role="tooltip"
                                        class="absolute z-10 font-light invisible inline-block w-64 text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 dark:text-gray-400 dark:border-gray-600 dark:bg-gray-800">
                                        <div class="px-3 py-2">
                                            <p>{{ cpl_item.deskripsi_cpl }}</p>
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
                                <td v-for="cpl_item, idx in cpl" class="px-4 py-3 text-center">
                                    <input @change="selectRelation(mk_item.id_mk, cpl_item.id_cpl)" type="checkbox"
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
import { ref, onBeforeMount, onMounted } from 'vue'
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
    cpl: Array,
    maping: Array,
})

// Make active state for the checkbox
const dataActive = ref([])
onBeforeMount(() => {
    props.mk.forEach((mk_item) => {
        const row = []
        props.cpl.forEach((cpl_item) => {
            let exists = props.maping.some(item => item.id_cpl === cpl_item.id_cpl && item.id_mk === mk_item.id_mk)
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
const selectRelation = (id_mk, id_cpl) => {
    router.post(`${baseUrl}/cpl_mk`, {
        id_cpl,
        id_mk
    }, { preserveScroll: true })
}

</script>

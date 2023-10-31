<template>
    <Head title="CPL - CPMK - MK" />
    <layout>
        <Breadcrumb :items="breadcrumbItems" />
        <div class="p-4 font-sans flex flex-col h-[calc(100vh-120px)]">
            <div class="shadow overflow-auto border-b border-gray-200 sm:rounded">
                <table class="w-full">
                    <thead class="z-10 divide-y divide-gray-200">
                        <tr class="bg-gray-100 divide-gray-600">
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider bg-gray-200">
                                CPL
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider bg-gray-200">
                                Deskripsi CPL
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider bg-gray-200">
                                CPMK
                            </th>
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider bg-gray-200">
                                Deskripsi CPMK
                            </th>
                            <th scope="col"
                                class="w-[350px] px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider bg-gray-200">
                                MK
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <template v-for="cpl, kode_cpl in result">
                            <tr class="divide-x divide-gray-200 text-sm">
                                <td :rowspan="Object.keys(cpl.data).length + 1"
                                    class="px-6 py-4 whitespace-nowrap text-center">
                                    {{ kode_cpl }}
                                </td>
                                <td :rowspan="Object.keys(cpl.data).length + 1"
                                    class="px-6 py-4 whitespace-wrap text-xs text-left">
                                    {{ cpl.deskripsi_cpl }}
                                </td>
                            </tr>
                            <template v-for="cpmk, kode_cpmk in cpl.data">
                                <tr>
                                    <td class="px-6 py-4 border-x-2 whitespace-wrap text-xs text-left">
                                        {{ kode_cpmk }}
                                    </td>
                                    <td class="px-6 py-4 border-r-2 whitespace-wrap text-xs text-left">
                                        {{ cpmk.deskripsi_cpmk }}
                                    </td>
                                    <td class="h-full px-6 py-4 text-center text-xs flex gap-2">
                                        <div v-for="mk in cpmk.data" class="flex">
                                            <span :title="mk[1]" class="bg-primary-200 p-2 rounded mb-1 cursor-help">
                                                {{ mk[0] }}
                                            </span>
                                        </div>
                                    </td>
                                </tr>
                            </template>
                        </template>
                    </tbody>
                </table>
            </div>
        </div>
    </layout>
</template>


<script setup>
// Library
import Layout from '@/Pages/Layouts/KoorProdiLayout.vue'
import { ref, onBeforeMount } from 'vue'

// Import Components
import Breadcrumb from '@/Pages/Components/Breadcrumbs/Breadcrumb.vue'

// Breadcrumb
const breadcrumbItems = ref([
    { name: "Maping" },
    { name: "Capaian Pembelajaran Lulusan - Capaian Pembelajaran Mata Kuliah - Mata Kuliah", link: route('map.cpl.cpmk.mk') },
])

// Property
const props = defineProps({
    data: Object,
})

const result = ref({})
onBeforeMount(() => {
    props.data.forEach(item => {
        const { kode_cpl, deskripsi_cpl, kode_cpmk, deskripsi_cpmk, kode_mk_obe, nama_mk } = item

        if (!result.value[kode_cpl]) {
            result.value[kode_cpl] = { deskripsi_cpl, data: {} }
        }

        if (!result.value[kode_cpl].data[kode_cpmk]) {
            result.value[kode_cpl].data[kode_cpmk] = { deskripsi_cpmk, data: [] }
        }

        result.value[kode_cpl].data[kode_cpmk].data.push([kode_mk_obe, nama_mk])
    })
})

</script>

<style scoped>
table {
    font-family: "Inter", sans-serif;
}

table thead {
    top: 0;
    position: sticky;
    z-index: 10;
}

4 table thead th:first-child {
    position: sticky;
    left: 0;
}

table tbody tr,
table thead tr {
    position: relative;
}

table tbody th {
    position: sticky;
    left: 0;
}
</style>

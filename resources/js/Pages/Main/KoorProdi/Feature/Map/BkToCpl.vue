<template>
    <Head title="User" />
    <layout>
        <Breadcrumb :items="breadcrumbItems" />
        <div class="p-4 font-sans flex flex-col h-[calc(100vh-120px)]">
            <div class="shadow overflow-auto border-b border-gray-200 sm:rounded">
                <table class="w-full">
                    <thead class="z-10 divide-y divide-gray-200">
                        <tr class="bg-gray-100 divide-gray-600">
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider bg-gray-200">
                                BK / CPL
                            </th>
                            <template v-for="cpl_item in cpl">
                                <th scope="col" :title="cpl_item.deskripsi_cpl"
                                    class="cursor-help px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ cpl_item.kode_cpl }}
                                </th>
                            </template>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <template v-for="bk_item, idy in bk">
                            <tr class="divide-x divide-gray-200">
                                <th class="px-6 py-4 whitespace-nowrap bg-gray-100 cursor-help" :title="bk_item.nama_bk">
                                    <div class="flex justify-center items-center">
                                        <div class="text-left">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ bk_item.kode_bk }}
                                            </div>
                                        </div>
                                    </div>
                                </th>
                                <template v-for="cpl_item, idx in cpl">
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <input @change="selectRelation(cpl_item.id_cpl, bk_item.id_bk)" type="checkbox"
                                            :checked="dataActive[idy][idx]">
                                    </td>
                                </template>
                            </tr>
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
import { router } from '@inertiajs/vue3'

// Import Components
import Breadcrumb from '@/Pages/Components/Breadcrumbs/Breadcrumb.vue'

// Breadcrumb
const breadcrumbItems = ref([
    { name: "Maping" },
    { name: "Bahan Kajian - Capaian Pembelajaran Lulusan", link: route('map.bk.cpl') },
])

// Property
const props = defineProps({
    cpl: Array,
    bk: Array,
    maping: Array,
})

// Make active state for the checkbox
const dataActive = ref([])
onBeforeMount(() => {
    props.bk.forEach((bk_item) => {
        const row = []
        props.cpl.forEach((cpl_item) => {
            let exists = props.maping.some(item => item.id_bk === bk_item.id_bk && item.id_cpl === cpl_item.id_cpl)
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
const selectRelation = (id_cpl, id_bk) => {
    router.post(route('maping.bk.cpl'), {
        id_cpl,
        id_bk
    }, { preserveScroll: true })
}

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

table thead th:first-child {
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

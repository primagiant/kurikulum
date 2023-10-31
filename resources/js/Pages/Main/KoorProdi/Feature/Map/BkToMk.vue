<template>
    <Head title="Maping MK - BK" />
    <layout>
        <Breadcrumb :items="breadcrumbItems" />
        <div class="p-4 font-sans flex flex-col h-[calc(100vh-120px)]">
            <div class="shadow overflow-auto border-b border-gray-200 sm:rounded">
                <table class="w-full">
                    <thead class="z-10 divide-y divide-gray-200">
                        <tr class="bg-gray-100 divide-gray-600">
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider bg-gray-200">
                                MK / BK
                            </th>
                            <template v-for="bk_item in bk" :key="`th-${bk_item.id_bk}`">
                                <th scope="col" :title="bk_item.nama_bk"
                                    class="cursor-help px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ bk_item.kode_bk }}
                                </th>
                            </template>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <template v-for="mk_item, idy in mk" :key="mk_item.id_mk">
                            <tr class="divide-x divide-gray-200">
                                <th class="px-6 py-4 whitespace-nowrap bg-gray-100 cursor-help"
                                    :title="mk_item.kode_mk_obe">
                                    <div class="flex items-center">
                                        <div class="text-left">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ mk_item.nama_mk }}
                                            </div>
                                        </div>
                                    </div>
                                </th>
                                <template v-for="bk_item, idx in bk" :key="bk_item.id_bk">
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <input @change="selectRelation(mk_item.id_mk, bk_item.id_bk)" type="checkbox"
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
    router.post(route('maping.bk.mk'), {
        id_bk,
        id_mk
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

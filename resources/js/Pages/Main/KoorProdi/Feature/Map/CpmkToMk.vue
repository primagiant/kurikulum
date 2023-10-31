<template>
    <Head title="Capain Pembelajaran Mata Kuliah  - Mata Kuliah" />
    <layout>
        <Breadcrumb :items="breadcrumbItems" />
        <div class="p-4 font-sans flex flex-col h-[calc(100vh-120px)]">
            <div class="shadow overflow-auto border-b border-gray-200 sm:rounded">
                <table class="w-full">
                    <thead class="z-10 divide-y divide-gray-200">
                        <tr class="bg-gray-100 divide-gray-600">
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider bg-gray-200">
                                CPMK / MK
                            </th>
                            <template v-for="mk_item in mk" :key="`th-${mk_item.id_mk}`">
                                <th scope="col" :title="mk_item.nama_mk"
                                    class="cursor-help px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ mk_item.kode_mk_obe }}
                                </th>
                            </template>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <template v-for="cpmk_item, idy in cpmk" :key="cpmk_item.id_cpmk">
                            <tr class="divide-x divide-gray-200">
                                <th class="px-6 py-4 whitespace-nowrap bg-gray-100 cursor-help"
                                    :title="cpmk_item.deskripsi_cpmk">
                                    <div class="flex items-center">
                                        <div class="text-left">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ cpmk_item.kode_cpmk }}
                                            </div>
                                        </div>
                                    </div>
                                </th>
                                <template v-for="mk_item, idx in mk" :key="mk_item.id_cpl">
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <input @change="selectRelation(cpmk_item.id_cpmk, mk_item.id_mk)" type="checkbox"
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
    { name: "Capaian Pembelajaran Mata Kuliah - Mata Kuliah", link: route('map.cpmk.mk') },
])

// Property
const props = defineProps({
    mk: Array,
    cpmk: Array,
    maping: Array,
})

// Make active state for the checkbox
const dataActive = ref([])
onBeforeMount(() => {
    props.cpmk.forEach((i) => {
        let row = []
        props.mk.forEach((j) => {
            let exists = props.maping.filter(e => e.id_cpmk === i.id_cpmk && e.id_mk === j.id_mk)
            if (exists.length != 0) {
                row.push(1)
            } else {
                row.push(0)
            }
        })
        dataActive.value.push(row)
    })
    // console.log(props.maping)
})

// Make relation
const selectRelation = (id_cpmk, id_mk) => {
    router.post(route('maping.cpmk.mk'), {
        id_cpmk,
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

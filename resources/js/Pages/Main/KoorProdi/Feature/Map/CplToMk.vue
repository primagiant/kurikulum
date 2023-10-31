<template>
    <Head title="Capain Pembelajaran Lulusan - Mata Kuliah" />
    <layout>
        <Breadcrumb :items="breadcrumbItems" />
        <div class="p-4 font-sans flex flex-col h-[calc(100vh-120px)]">
            <div class="shadow overflow-auto border-b border-gray-200 sm:rounded">
                <table class="w-full">
                    <thead class="z-10 divide-y divide-gray-200">
                        <tr class="bg-gray-100 divide-gray-600">
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider bg-gray-200">
                                MK / CPL
                            </th>
                            <template v-for="cpl_item in cpl" :key="`th-${cpl_item.id_cpl}`">
                                <th scope="col" :title="cpl_item.deskripsi_cpl"
                                    class="cursor-help px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ cpl_item.kode_cpl }}
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
                                <template v-for="cpl_item, idx in cpl" :key="cpl_item.id_cpl">
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <input @change="selectRelation(mk_item.id_mk, cpl_item.id_cpl)" type="checkbox"
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
    { name: "Capain Pembelajaran Lulusan - Mata Kuliah", link: route('map.cpl.mk') },
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
    router.post(route('maping.cpl.mk'), {
        id_cpl,
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

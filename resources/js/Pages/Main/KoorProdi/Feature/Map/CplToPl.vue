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
                                CPL / PL
                            </th>
                            <template v-for="pl_item in pl" :key="`th-${pl_item.id_pl}`">
                                <th scope="col" :title="pl_item.deskripsi_pl"
                                    class="cursor-help px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ pl_item.kode_pl }}
                                </th>
                            </template>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <template v-for="cpl_item, idy in cpl" :key="cpl_item.id_cpl">
                            <tr class="divide-x divide-gray-200">
                                <th class="px-6 py-4 whitespace-nowrap bg-gray-100 cursor-help"
                                    :title="cpl_item.deskripsi_cpl">
                                    <div class="flex justify-center items-center">
                                        <div class="text-left">
                                            <div class="text-sm font-medium text-gray-900">
                                                {{ cpl_item.kode_cpl }}
                                            </div>
                                        </div>
                                    </div>
                                </th>
                                <template v-for="pl_item, idx in pl" :key="pl_item.id_pl">
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <input type="checkbox" :checked="dataActive[idy][idx]"
                                            @change="selectRelation(cpl_item.id_cpl, pl_item.id_pl)">
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
    { name: "Capaian Pembelajaran Lulusan - Profil Lulusan", link: route('map.cpl.pl') },
])

// Property
const props = defineProps({
    cpl: Array,
    pl: Array,
    maping: Array,
})

// Make active state for the checkbox
const dataActive = ref([])
onBeforeMount(() => {
    props.cpl.forEach((cpl_item) => {
        const row = []
        props.pl.forEach((pl_item) => {
            let exists = props.maping.some(item => item.id_pl === pl_item.id_pl && item.id_cpl === cpl_item.id_cpl)
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
const selectRelation = (id_cpl, id_pl) => {
    router.post(route('maping.cpl.pl'), {
        id_cpl,
        id_pl
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

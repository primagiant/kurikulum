<template>
    <Head title="BK - CPL - MK" />
    <layout>
        <Breadcrumb :items="breadcrumbItems" />
        <div class="p-4 font-sans flex flex-col h-[calc(100vh-120px)]">
            <div class="shadow overflow-auto border-b border-gray-200 sm:rounded">
                <table class="w-full">
                    <thead class="z-10 divide-y divide-gray-200">
                        <tr class="bg-gray-100 divide-gray-600">
                            <th scope="col"
                                class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider bg-gray-200">
                                BK / CPL / MK
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
                                <template v-for="_, idx in cpl">
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <p v-for="mk_item in mk_array[idy][idx]" :title="mk_item.nama_mk"
                                            class="bg-primary-200 p-0.5 rounded mb-1 cursor-help">
                                            {{ mk_item.kode_mk_obe }}
                                        </p>
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
    { name: "Bahan Kajian - Capaian Pembelajaran Lulusan - Mata Kuliah", link: route('map.bk.cpl.mk') },
])

// Property
const props = defineProps({
    cpl: Object,
    bk: Object,
    mk: Object,
})

const mk_array = ref([])
onBeforeMount(() => {
    props.bk.forEach(i => {
        let row = []
        props.cpl.forEach(j => {
            let elem = props.mk.filter(e =>
                e.id_cpl === j.id_cpl && e.id_bk === i.id_bk
            )
            row.push(elem)
        })
        mk_array.value.push(row)
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

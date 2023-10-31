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
                                PENGAMPUAN
                            </th>
                            <template v-for="dosen_item in dosen">
                                <th scope="col"
                                    class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                    {{ dosen_item.name }}
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
                                <template v-for="(dosen_item, idx) in dosen">
                                    <td class="px-6 py-4 whitespace-nowrap text-center">
                                        <input @change="selectRelation(mk_item.id_mk, dosen_item.id)" type="checkbox"
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

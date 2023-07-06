<template>
    <Head title="User" />
    <div>
        <Breadcrumb :items="breadcrumbItems" />
        <div class="p-6">
            <h1 class="mb-5">User List</h1>
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                <div class="overflow-x-auto pb-4">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" rowspan="2" class="px-4 py-3 text-center">Kode CPL</th>
                                <th scope="col" colspan="100%" class="px-4 py-3 text-center">PL (Profil Lulusan)</th>
                            </tr>
                            <tr>
                                <th v-for="pl_item in pl" :data-popover-target="`popover-pl-${pl_item.id_pl}`" scope="col"
                                    class="px-4 py-3 text-center cursor-help">
                                    {{ pl_item.kode_pl }}
                                    <div data-popover :id="`popover-pl-${pl_item.id_pl}`" role="tooltip"
                                        class="absolute z-10 font-light invisible inline-block w-64 text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 dark:text-gray-400 dark:border-gray-600 dark:bg-gray-800">
                                        <div class="px-3 py-2">
                                            <p>{{ pl_item.deskripsi_pl }}</p>
                                        </div>
                                        <div data-popper-arrow></div>
                                    </div>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="cpl_item, idy in cpl" class="border-b dark:border-gray-700">
                                <td :data-popover-target="`popover-cpl-${cpl_item.id_cpl}`" data-popover-placement="right"
                                    class="px-4 py-3 text-center cursor-help">
                                    {{ cpl_item.kode_cpl }}
                                    <div data-popover :id="`popover-cpl-${cpl_item.id_cpl}`" role="tooltip"
                                        class="absolute z-10 font-light invisible inline-block w-64 text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 dark:text-gray-400 dark:border-gray-600 dark:bg-gray-800">
                                        <div class="px-3 py-2">
                                            <p>{{ cpl_item.deskripsi_cpl }}</p>
                                        </div>
                                        <div data-popper-arrow></div>
                                    </div>
                                </td>
                                <td v-for="pl_item, idx in pl" class="px-4 py-3 text-center">
                                    <input type="checkbox" :checked="dataActive[idy][idx]"
                                        @change="selectRelation(cpl_item.id_cpl, pl_item.id_pl)">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <!--  Paging -->
            </div>
        </div>
    </div>
</template>

<script>
// Layout
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
    { name: "Account" },
    { name: "User" },
    { name: "List", link: route('user.index') },
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
    router.post(`${baseUrl}/cpl_pl`, {
        id_cpl,
        id_pl
    })
}

</script>

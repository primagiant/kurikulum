<template>
    <Head title="Bahan Kajian" />
    <div>
        <Breadcrumb :items="breadcrumbItems" />
        <div class="p-6">
            <h1 class="mb-5">Bahan Kajian List</h1>
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                    <div class="w-full md:w-1/2">
                        <form class="flex items-center">
                            <label for="simple-search" class="sr-only">Search</label>
                            <div class="relative w-full">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400"
                                        fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd"
                                            d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z"
                                            clip-rule="evenodd" />
                                    </svg>
                                </div>
                                <input type="text" id="simple-search" v-model="search" placeholder="Search by name or email"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            </div>
                        </form>
                    </div>
                    <div
                        class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                        <Link as="button" :href="route('bahan.kajian.create')"
                            class="flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                        Add Bahan Kajian
                        </Link>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-4 py-3">Kode Bahan Kajian</th>
                                <th scope="col" class="px-4 py-3">Nama Bahan Kajian </th>
                                <th scope="col" class="px-4 py-3">Deskripsi</th>
                                <th scope="col" class="px-4 py-3">Bobot Min</th>
                                <th scope="col" class="px-4 py-3">Bobot Max</th>
                                <th scope="col" class="px-4 py-3">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="bk in bahan_kajian.data" :key="bahan_kajian.id_bk"
                                class="border-b dark:border-gray-700">
                                <th scope="row"
                                    class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ bk.kode_bk }}
                                </th>
                                <td class="px-4 py-3">{{ bk.nama_bk }}</td>
                                <td class="px-4 py-3">{{ bk.deskripsi_bk }}</td>
                                <td class="px-4 py-3">{{ bk.bobot_min }}</td>
                                <td class="px-4 py-3">{{ bk.bobot_max }}</td>
                                <td class="px-4 py-3 flex items-center justify-end">
                                    <button :id="bk.id_bk + '-dropdown-button'"
                                        :data-dropdown-toggle="bk.id_bk + '-dropdown'"
                                        class="inline-flex items-center p-0.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100"
                                        type="button">
                                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                        </svg>
                                    </button>
                                    <div :id="bk.id_bk + '-dropdown'"
                                        class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                                        <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                                            aria-labelledby="apple-imac-27-dropdown-button">
                                            <li>
                                                <Link :href="route('cpl.edit', bk.id_bk)"
                                                    class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                Edit
                                                </Link>
                                            </li>
                                        </ul>
                                        <div class="py-1">
                                            <a href="#" @click="deleteBK(bk.id_bk)"
                                                class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                                                Delete
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <Pagination :links="bahan_kajian.links" :from="bahan_kajian.from" :to="bahan_kajian.to"
                    :total="bahan_kajian.total" />
            </div>
        </div>
    </div>
</template>
<script>
// For Layout
import Layout from '@/Pages/Layouts/KoorProdiLayout.vue'
export default {
    layout: Layout,
}
</script>
<script setup>
// Import Library
import { ref, watch, onMounted } from 'vue'
import { router } from '@inertiajs/vue3'
import Swal from 'sweetalert2'

// Import Component
import Pagination from '@/Pages/Components/Pagination.vue'
import Breadcrumb from '@/Pages/Components/Breadcrumbs/Breadcrumb.vue'

// BaseUrl
import GlobalVariable from '@/variable.js'
const baseUrl = GlobalVariable.base_url

// Setting Breadcrumb
const breadcrumbItems = ref([
    { name: "Feature" },
    { name: "Bahan Kajian", link: route('bahan.kajian.index') },
])

// Properti
const props = defineProps({
    bahan_kajian: Object,
    filters: Object,
    flash: Array,
})

// For Searching
const search = ref(props.filters.search)
watch(search, (value) => {
    router.get(
        'bahan-kajian',
        { search: value },
        { preserveState: true }
    )
})

// For Delete
const deleteBK = (id) => {
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            router.delete(`${baseUrl}/bahan-kajian/${id}`)
        }
    })
}

// Toast
onMounted(() => {
    if (props.flash.msg) {
        Swal.fire({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
            icon: props.flash.msg.type,
            title: props.flash.msg.text
        })
    }
})
</script>
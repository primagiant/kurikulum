<template>
    <Head title="Role" />
    <layout>
        <Breadcrumb :items="breadcrumbItems" />
        <div class="p-6">
            <h1 class="mb-5">Role List</h1>
            <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
                    <div class="w-full md:w-1/2">
                        <form @submit.prevent class="flex items-center">
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
                                <input type="text" id="simple-search" v-model="search" placeholder="Search"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            </div>
                        </form>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-4 py-3">No</th>
                                <th scope="col" class="px-4 py-3">Role Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="role, index in roles.data" :key="role.id" class="border-b dark:border-gray-700">
                                <th scope="row"
                                    class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ index + 1 }}
                                </th>
                                <th scope="row"
                                    class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ role.name }}
                                </th>
                            </tr>
                            <tr v-if="roles.data.length == 0">
                                <td colspan="4" class="px-4 py-3 font-medium text-gray-900 text-center">No Data</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </layout>
</template>

<script setup>
// Import Library
import { ref, watch, onMounted } from 'vue'
import { router } from '@inertiajs/vue3'
import Swal from 'sweetalert2'
import { debounce } from 'lodash'

// Import Component
import Layout from '@/Pages/Layouts/SuperAdminLayout.vue'
import Pagination from '@/Pages/Components/Pagination.vue'
import Breadcrumb from '@/Pages/Components/Breadcrumbs/Breadcrumb.vue'

// Setting Breadcrumb
const breadcrumbItems = ref([
    { name: "Account" },
    { name: "Role", link: route('role.index') },
])

// Properti
const props = defineProps({
    roles: Object,
    filters: Object,
    flash: Object,
})

// For Searching
const search = ref(props.filters.search)
watch(search, debounce((value) => {
    router.get(
        route('role.index'),
        { search: value },
        { preserveState: true }
    )
}, 500))

// For Delete role
const deleteRole = (id) => {
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
            router.delete(route('role.destroy', { id: id }))
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

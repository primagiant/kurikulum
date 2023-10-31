<template>
    <Head title="User" />
    <layout>
        <Breadcrumb :items="breadcrumbItems" />
        <div class="p-6">
            <h1 class="mb-5">User List</h1>
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
                                <input type="text" id="simple-search" v-model="search" placeholder="Search by name or email"
                                    class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            </div>
                        </form>
                    </div>
                    <div
                        class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                        <Link as="button" :href="route('user.create')"
                            class="flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                        Add User
                        </Link>
                    </div>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-4 py-3">Username</th>
                                <th scope="col" class="px-4 py-3">Email</th>
                                <th scope="col" class="px-4 py-3">Role</th>
                                <th scope="col" class="px-4 py-3">Prodi</th>
                                <th scope="col" class="px-4 py-3">
                                    <span class="sr-only">Actions</span>
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="user, index in users.data" :key="user.id" class="border-b dark:border-gray-700">
                                <th scope="row"
                                    class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    {{ user.name }}
                                </th>
                                <td class="px-4 py-3">{{ user.email }}</td>
                                <td class="px-4 py-3">{{ user.role_name }}</td>
                                <td class="px-4 py-3">{{ user.nama_prodi }}</td>
                                <td class="px-4 py-3 flex items-center justify-end">
                                    <button :id="index + '-dropdown-button'" :data-dropdown-toggle="index + '-dropdown'"
                                        class="inline-flex items-center p-0.5 text-sm font-medium text-center text-gray-500 hover:text-gray-800 rounded-lg focus:outline-none dark:text-gray-400 dark:hover:text-gray-100"
                                        type="button">
                                        <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewbox="0 0 20 20"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M6 10a2 2 0 11-4 0 2 2 0 014 0zM12 10a2 2 0 11-4 0 2 2 0 014 0zM16 12a2 2 0 100-4 2 2 0 000 4z" />
                                        </svg>
                                    </button>
                                    <div :id="index + '-dropdown'"
                                        class="hidden z-10 w-44 bg-white rounded divide-y divide-gray-100 shadow dark:bg-gray-700 dark:divide-gray-600">
                                        <ul class="py-1 text-sm text-gray-700 dark:text-gray-200"
                                            aria-labelledby="apple-imac-27-dropdown-button">
                                            <li>
                                                <Link :href="route('user.edit', user.id)"
                                                    class="block py-2 px-4 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                                                Edit
                                                </Link>
                                            </li>
                                        </ul>
                                        <div class="py-1" :class="user.role_name == 'super_admin' ? 'hidden' : ''">
                                            <a href="#" @click="deleteUser(user.id)"
                                                class="block py-2 px-4 text-sm text-gray-700 hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 dark:hover:text-white">
                                                Delete
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr v-if="users.data.length == 0">
                                <td colspan="4" class="px-4 py-3 font-medium text-gray-900 text-center">No Data</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <Pagination v-if="users.data.length != 0" :links="users.links" :from="users.from" :to="users.to"
                    :total="users.total" />
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
    { name: "User", link: route('user.index') },
])

// Properti
const props = defineProps({
    users: Object,
    role: Object,
    filters: Object,
    flash: Object,
})

// For Searching
const search = ref(props.filters.search)
watch(search, debounce((value) => {
    router.get(
        route('user.index'),
        { search: value },
        { preserveState: true }
    )
}, 500))

// For Delete User
const deleteUser = (userId) => {
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
            router.delete(route('user.destroy', { id: userId }))
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

<template>
    <Head :title="props.mk.nama_mk + ' Sub-CPMK List'" />
    <layout>
        <Breadcrumb :items="breadcrumbItems" />
        <div class="p-6">
            <h1 class="mb-5">{{ mk.nama_mk }} - Sub-CPMK List</h1>
            <div class="grid gap-4 md:grid-cols-6 grid-cols-1">
                <div class="order-2 col-span-1 md:col-span-4 ">
                    <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden">
                        <div
                            class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4">
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
                                        <input type="text" id="simple-search" v-model="search"
                                            placeholder="Search by name or email"
                                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                                <thead
                                    class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-4 py-3">Kode Sub-CPMK</th>
                                        <th scope="col" class="px-4 py-3">Deskripsi</th>
                                        <th scope="col" class="px-4 py-3">
                                            <span class="sr-only">Actions</span>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="data in subcpmk.data" :key="data.id_cpmk"
                                        class="border-b dark:border-gray-700">
                                        <th scope="row"
                                            class="px-4 py-3 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                            {{ data.kode_sub_cpmk }}
                                        </th>
                                        <td class="px-4 py-3">{{ data.deskripsi_sub_cpmk }}</td>
                                        <td class="px-4 py-3 flex items-center justify-end gap-2">
                                            <button type="button"
                                                class="p-1.5 bg-yellow-400 hover:bg-yellow-500 text-white rounded-md"
                                                @click="activateUpdateMode(data)">
                                                <svg width="16" fill="none" stroke="currentColor" stroke-width="1.5"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                                    aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L10.582 16.07a4.5 4.5 0 01-1.897 1.13L6 18l.8-2.685a4.5 4.5 0 011.13-1.897l8.932-8.931zm0 0L19.5 7.125M18 14v4.75A2.25 2.25 0 0115.75 21H5.25A2.25 2.25 0 013 18.75V8.25A2.25 2.25 0 015.25 6H10">
                                                    </path>
                                                </svg>
                                            </button>
                                            <button type="button"
                                                class="p-1.5 bg-red-600 hover:bg-red-700 text-white rounded-md"
                                                @click="deleteSubCPMK(data.id_sub_cpmk)">
                                                <svg width="16" fill="none" stroke="currentColor" stroke-width="1.5"
                                                    viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"
                                                    aria-hidden="true">
                                                    <path stroke-linecap="round" stroke-linejoin="round"
                                                        d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 01-2.244 2.077H8.084a2.25 2.25 0 01-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 00-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 013.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 00-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 00-7.5 0">
                                                    </path>
                                                </svg>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr v-if="subcpmk.data.length == 0">
                                        <td colspan="3" class="px-4 py-3 font-medium text-gray-900 text-center">No Data</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <Pagination v-if="subcpmk.data.length != 0" :links="subcpmk.links" :from="subcpmk.from"
                            :to="subcpmk.to" :total="subcpmk.total" />
                    </div>
                </div>
                <div class="order-1 col-span-1 md:col-span-2">
                    <form @submit.prevent="submit" autocomplete="off"
                        class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden p-4">
                        <div class="mb-6 w-full">
                            <label for="default-id-cpl"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">CPMK</label>
                            <select id="default-id-cpl" v-model="form.id_map_cpmk_mk" required :disabled="updateMode"
                                :class="!updateMode ? 'bg-gray-50' : 'bg-gray-300'"
                                class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected disabled>Choose Capaian Profil Lulusan</option>
                                <option v-for="data in cpmk" :value="data.id_map_cpmk_mk">
                                    {{ data.kode_cpmk }} - {{ data.deskripsi_cpmk }}
                                </option>
                            </select>
                            <div v-if="errors.id_map_cpmk_mk">
                                <small class="text-xs text-red-600">{{ errors.id_map_cpmk_mk }}</small>
                            </div>
                        </div>
                        <div class="mb-6 w-full">
                            <label for="default-deskripsi"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
                            <textarea id="default-deskripsi" rows="3" v-model="form.deskripsi_sub_cpmk" required
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Write the Profil Lulusan Deskripsi.."></textarea>
                            <div v-if="errors.deskripsi_sub_cpmk">
                                <small class="text-xs text-red-600">{{ errors.deskripsi_sub_cpmk }}</small>
                            </div>
                        </div>
                        <div>
                            <button type="submit"
                                :class="updateMode ? 'bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300' : 'bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300'"
                                class="text-white font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">
                                {{ updateMode ? 'Update' : 'Save' }}
                            </button>
                            <button v-if="updateMode"
                                class="text-white font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300"
                                type="button" @click="deativateUpdateMode">
                                Cancel
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </layout>
</template>

<script setup>
// Import Library
import Layout from '@/Pages/Layouts/DosenLayout.vue'
import { ref, watch, onUpdated } from 'vue'
import { router, useForm } from '@inertiajs/vue3'
import Swal from 'sweetalert2'

// Import Component
import Pagination from '@/Pages/Components/Pagination.vue'
import Breadcrumb from '@/Pages/Components/Breadcrumbs/Breadcrumb.vue'

// Setting Breadcrumb
const breadcrumbItems = ref([
    { name: "Feature" },
    { name: "List Mata Kuliah", link: route('dosen.list.mk') },
    { name: `List Sub-CPMK`, link: route('dosen.list.subcpmk', { id_mk: props.mk.id_mk }) },
])

// Properti
const props = defineProps({
    subcpmk: Object,
    cpmk: Object,
    mk: Object,
    filters: Object,
    flash: Object,
    errors: Object,
})

// Form
let form = useForm({
    id_map_cpmk_mk: "",
    deskripsi_sub_cpmk: "",
})

// For Create And Update
const updateMode = ref(false)
const updatedSubCpmk = ref(null)
const activateUpdateMode = (subcpmk) => {
    updateMode.value = true
    updatedSubCpmk.value = subcpmk.id_sub_cpmk
    form.deskripsi_sub_cpmk = subcpmk.deskripsi_sub_cpmk
    form.id_map_cpmk_mk = subcpmk.id_map_cpmk_mk
}
const deativateUpdateMode = () => {
    updateMode.value = false
    form.reset()
}
const submit = () => {
    if (updateMode.value) {
        form.post(route('subcpmk.update', { id: updatedSubCpmk.value }), {
            preserveScroll: true,
            onSuccess: () => {
                updateMode.value = false
                updatedSubCpmk.value = null
                form.reset()
            },
        })
    } else {
        form.post(route('subcpmk.store'), {
            preserveScroll: true,
            onSuccess: () => form.reset(),
        })
    }
}

// For Searching
const search = ref(props.filters.search)
watch(search, (value) => {
    router.get(
        route('dosen.list.subcpmk', {
            id_mk: props.mk.id_mk
        }),
        { search: value },
        { preserveState: true }
    )
})

// For Delete
const deleteSubCPMK = (id) => {
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
            router.delete(route('subcpmk.destroy', { id: id }))
        }
    })
}

// Toast
onUpdated(() => {
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

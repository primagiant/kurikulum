<template>
    <Head title="Update Prodi" />
    <div>
        <Breadcrumb :items="breadcrumbItems" />
        <div class="p-6">
            <div class="md:w-[500px] flex justify-between">
                <h1 class="mb-5">Prodi Update</h1>
                <Link type="button" :href="route('prodi.index')"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                Back
                </Link>
            </div>
            <form @submit.prevent="submit" autocomplete="off"
                class="md:w-[500px] bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden p-4">
                <div class="w-full mb-2">
                    <label for="default-kode_prodi"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kode Prodi</label>
                    <input type="text" id="default-kode_prodi" v-model="form.kode_prodi" maxlength="12" required
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <div v-if="errors.kode_prodi">
                        <small class="text-xs text-red-600">{{ errors.kode_prodi }}</small>
                    </div>
                </div>
                <div class="w-full mb-3">
                    <label for="default-kode_prodi"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama Prodi</label>
                    <input type="text" id="default-kode_prodi" v-model="form.nama_prodi" required
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <div v-if="errors.nama_prodi">
                        <small class="text-xs text-red-600">{{ errors.nama_prodi }}</small>
                    </div>
                </div>
                <div>
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                        Update
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import Layout from '@/Pages/Layouts/SuperAdminLayout.vue'
export default {
    layout: Layout,
}
</script>

<script setup>
import { ref } from 'vue'
import { useForm } from '@inertiajs/vue3'

// Import Component
import Breadcrumb from '@/Pages/Components/Breadcrumbs/Breadcrumb.vue'

// Property
const props = defineProps({
    prodi: Object,
    errors: Object,
})

// Setting Breadcrumb
const breadcrumbItems = ref([
    { name: "Account" },
    { name: "Prodi", link: route('prodi.index') },
    { name: "Edit", link: route('prodi.edit', props.prodi.id_prodi) },
])

// Form data
let form = useForm({
    kode_prodi: props.prodi.kode_prodi,
    nama_prodi: props.prodi.nama_prodi,
})

// Submit Form
const submit = () => {
    form.post(route('prodi.update', { id: props.prodi.id_prodi }))
}
</script>

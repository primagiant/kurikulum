<template>
    <Head title="Create CPMK" />
    <div>
        <Breadcrumb :items="breadcrumbItems" />
        <div class="p-6 lg:w-[800px] md:w-[700px]">
            <div class="flex justify-between">
                <h1 class="mb-5">CPMK Create</h1>
                <Link type="button" :href="route('cpl.index')"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                Back
                </Link>
            </div>
            <form @submit.prevent="submit" autocomplete="off"
                class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden p-4">
                <div class="flex flex-col md:flex-row justify-between gap-4 mb-6 ">
                    <div class="w-1/3 mb-2 md:mb-0">
                        <label for="default-id-cpl"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Unsur</label>
                        <select id="default-id-cpl" v-model="form.id_cpl"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected disabled>Choose Capaian Profil Lulusan</option>
                            <option v-for="data in cpl" :value="data.id_cpl">{{ data.kode_cpl }}</option>
                        </select>
                    </div>
                    <div class="w-full">
                        <label for="default-kode-cpmk"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kode
                            CPMK</label>
                        <input type="number" id="default-kode-cpmk" v-model="form.kode_cpmk"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Maximum 10 numbers">
                    </div>
                </div>
                <div class="mb-6 w-full">
                    <label for="default-deskripsi"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
                    <textarea id="default-deskripsi" rows="3" v-model="form.deskripsi_cpmk"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Write the Profil Lulusan Deskripsi.."></textarea>

                </div>
                <div>
                    <button type="submit"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                        Save
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>

<script>
import Layout from '@/Pages/Layouts/KoorProdiLayout.vue'
export default {
    layout: Layout,
}
</script>

<script setup>
import { ref } from 'vue'
import { useForm } from '@inertiajs/vue3'

// Import Component
import Breadcrumb from '@/Pages/Components/Breadcrumbs/Breadcrumb.vue'

// BaseUrl
import GlobalVariable from '@/variable.js'
const baseUrl = GlobalVariable.base_url

// Setting Breadcrumb
const breadcrumbItems = ref([
    { name: "Feature" },
    { name: "CPMK", link: route('cpmk.index') },
    { name: "Create", link: route('cpmk.create') },
])

// Get CPL
const props = defineProps({
    cpl: Array,
})

// Form data
let form = useForm({
    id_cpl: "",
    kode_cpmk: "",
    deskripsi_cpmk: "",
})

// Submit Form
const submit = () => {
    form.post(`${baseUrl}/cpmk/create`)
}
</script>
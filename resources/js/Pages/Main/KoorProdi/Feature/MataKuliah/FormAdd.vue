<template>
    <Head title="Create Mata Kuliah" />
    <div>
        <Breadcrumb :items="breadcrumbItems" />
        <div class="p-6 lg:w-[800px] md:w-[700px]">
            <div class="flex justify-between">
                <h1 class="mb-5">Mata Kuliah Create</h1>
                <Link type="button" :href="route('mk.index')"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                Back
                </Link>
            </div>
            <form @submit.prevent="submit" autocomplete="off"
                class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden p-4">
                <div class="flex flex-col md:flex-row justify-between gap-4 mb-6 ">
                    <div class="w-1/2">
                        <label for="default-kode-mk-obe"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kode
                            Mata Kuliah</label>
                        <input type="text" id="default-kode-mk-obe" v-model="form.kode_mk_obe"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Maximum 4 characters">
                    </div>
                    <div class="w-1/2">
                        <label for="default-kode-mk-undiksha"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kode
                            MK Undiksha</label>
                        <input type="text" id="default-kode-mk-undiksha" v-model="form.kode_mk_undiksha"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Maximum 10 characters">
                    </div>
                </div>
                <div class="w-full mb-6">
                    <label for="default-nama-mk" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                        Mata Kuliah</label>
                    <input type="text" id="default-nama-mk" v-model="form.nama_mk"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Example Mata Kuliah">
                </div>
                <div class="mb-6 w-full">
                    <label for="default-deskripsi"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
                    <textarea id="default-deskripsi" rows="3" v-model="form.deskripsi_mk"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Write the Deskripsi Mata Kuliah.."></textarea>

                </div>
                <div class="mb-6 w-full">
                    <label for="default-sks"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">SKS</label>
                    <input type="number" id="default-sks" v-model="form.sks"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block lg:w-[150px] w-1/4 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                </div>
                <div class="mb-6 w-full">
                    <label for="default-semester"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Semester</label>
                    <select id="default-semester" v-model="form.semester"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block lg:w-[150px] w-1/4 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <option selected disabled>Choose Semester</option>
                        <option v-for="semester in semesters" :value="semester">{{ semester }}</option>
                    </select>
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
    { name: "Mata Kuliah", link: route('mk.index') },
    { name: "Create", link: route('mk.create') },
])

const semesters = ref([
    1, 2, 3, 4, 5, 6, 7, 8
])


// Form data
let form = useForm({
    kode_mk_obe: "",
    kode_mk_undiksha: "",
    nama_mk: "",
    deskripsi_mk: "",
    sks: "",
    semester: "",
})

// Submit Form
const submit = () => {
    form.post(`${baseUrl}/mata-kuliah/create`)
}
</script>
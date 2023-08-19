<template>
    <Head title="Create Capaian Profil Lulusan" />
    <div>
        <Breadcrumb :items="breadcrumbItems" />
        <div class="p-6 lg:w-[800px] md:w-[700px]">
            <div class="flex justify-between">
                <h1 class="mb-5">Capaian Profil Lulusan Create</h1>
                <Link type="button" :href="route('cpl.index')"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                Back
                </Link>
            </div>
            <form @submit.prevent="submit" autocomplete="off"
                class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden p-4">
                <div class="flex flex-col md:flex-row justify-between gap-4 mb-6 ">
                    <div class=" w-full lg:w-1/2">
                        <label for="default-kode-cpl"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kode
                            Capaian Profil Lulusan</label>
                        <input type="text" id="default-kode-cpl" v-model="form.kode_cpl" required maxlength="5"
                            minlength="5"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Example: CPL01">
                        <div v-if="errors.kode_cpl">
                            <small class="text-xs text-red-600">{{ errors.kode_cpl }}</small>
                        </div>
                    </div>
                    <div class="w-full mb-2 md:mb-0">
                        <label for="default-profil-lulusan"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Unsur</label>
                        <select id="default-profil-lulusan" v-model="form.unsur" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected disabled>Choose Unsur</option>
                            <option v-for="unsur in unsurs" :value="unsur">{{ unsur }}</option>
                        </select>
                        <div v-if="errors.unsur">
                            <small class="text-xs text-red-600">{{ errors.unsur }}</small>
                        </div>
                    </div>
                </div>
                <div class="mb-6 w-full">
                    <label for="default-deskripsi"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
                    <textarea id="default-deskripsi" rows="3" v-model="form.deskripsi_cpl" required
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Write the Profil Lulusan Deskripsi.."></textarea>
                    <div v-if="errors.deskripsi_cpl">
                        <small class="text-xs text-red-600">{{ errors.deskripsi_cpl }}</small>
                    </div>

                </div>
                <div class="mb-6 w-full">
                    <label for="default-deskripsi"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Referensi</label>
                    <textarea id="default-deskripsi" rows="3" v-model="form.referensi" required
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Write the Referensi.."></textarea>
                    <div v-if="errors.referensi">
                        <small class="text-xs text-red-600">{{ errors.referensi }}</small>
                    </div>
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

// Setting Breadcrumb
const breadcrumbItems = ref([
    { name: "Feature" },
    { name: "Capaian Profil Lulusan", link: route('cpl.index') },
    { name: "Create", link: route('cpl.create') },
])

const props = defineProps({
    errors: Object,
})

// Unsur
const unsurs = ref([
    'Sikap', 'Keterampilan Umum', 'Pengetahuan', 'Keterampilan Khusus'
])

// Form data
let form = useForm({
    kode_cpl: "",
    deskripsi_cpl: "",
    unsur: "",
    referensi: "",
})

// Submit Form
const submit = () => {
    form.post(route('cpl.store'))
}
</script>

<template>
    <Head title="Update Profil Lulusan" />
    <div>
        <Breadcrumb :items="breadcrumbItems" />
        <div class="p-6 lg:w-[800px] md:w-[700px]">
            <div class="flex justify-between">
                <h1 class="mb-5">Profil Lulusan Update</h1>
                <Link type="button" :href="route('profil.lulusan.index')"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                Back
                </Link>
            </div>
            <form @submit.prevent="submit" autocomplete="off"
                class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden p-4">
                <div class="flex flex-col md:flex-row justify-between gap-4 mb-6 ">
                    <div class="w-2/5">
                        <label for="default-kode-pl"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kode
                            Profil Lulusan</label>
                        <input type="text" id="default-kode-pl" v-model="form.kode_pl"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="EXAMPLE-00">
                    </div>
                    <div class="w-full mb-2 md:mb-0">
                        <label for="default-profil-lulusan"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Unsur</label>
                        <select id="default-profil-lulusan" v-model="form.unsur"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option :selected="unsur.replace(/&nbsp;/g, ' ') == profil_lulusan.unsur.trim()"
                                v-for="unsur in unsurs" :value="unsur.replace(/&nbsp;/g, ' ')">
                                {{ unsur }}
                            </option>
                        </select>
                    </div>
                </div>
                <div class="mb-6 w-full">
                    <label for="default-deskripsi"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
                    <textarea id="default-deskripsi" rows="3" v-model="form.deskripsi_pl"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Write the Profil Lulusan Deskripsi.."></textarea>

                </div>
                <div class="mb-6 w-full">
                    <label for="default-deskripsi"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Referensi</label>
                    <textarea id="default-deskripsi" rows="3" v-model="form.referensi"
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Write the Referensi.."></textarea>

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

//Properti
const props = defineProps({
    'profil_lulusan': Array,
})

// Setting Breadcrumb
const breadcrumbItems = ref([
    { name: "Feature" },
    { name: "Profil Lulusan", link: route('profil.lulusan.index') },
    { name: "Edit", link: route('profil.lulusan.edit', props.profil_lulusan.id_pl) },
])

// Unsur
const unsurs = ref([
    'Sikap', 'Keterampilan Umum', 'Pengetahuan', 'Keterampilan Khusus',
])

// Form data
let form = useForm({
    kode_pl: props.profil_lulusan.kode_pl,
    deskripsi_pl: props.profil_lulusan.deskripsi_pl,
    unsur: props.profil_lulusan.unsur,
    referensi: props.profil_lulusan.referensi,
})

// Submit Form
const submit = () => {
    form.post(`${baseUrl}/profil-lulusan/${props.profil_lulusan.id_pl}/edit`)
}
</script>

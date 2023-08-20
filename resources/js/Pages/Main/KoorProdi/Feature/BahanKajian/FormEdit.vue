<template>
    <Head title="Create Bahan Kajian" />
    <div>
        <Breadcrumb :items="breadcrumbItems" />
        <div class="p-6 lg:w-[800px] md:w-[700px]">
            <div class="flex justify-between">
                <h1 class="mb-5">Bahan Kajian Edit</h1>
                <Link type="button" :href="route('bahan.kajian.index')"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                Back
                </Link>
            </div>
            <form @submit.prevent="submit" autocomplete="off"
                class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden p-4">
                <div class="flex flex-col md:flex-row justify-between gap-4 mb-6">
                    <div class="w-full md:w-3/5">
                        <label for="default-kode-bk"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Kode
                            Bahan Kajian</label>
                        <input type="text" id="default-kode-bk" v-model="form.kode_bk" required maxlength="4" minlength="4"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Example: BK01">
                        <div v-if="errors.kode_bk">
                            <small class="text-xs text-red-600">{{ errors.kode_bk }}</small>
                        </div>
                    </div>
                    <div class="w-full mb-2 md:mb-0">
                        <label for="default-nama-bk"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nama
                            Bahan Kajian</label>
                        <input type="text" id="default-nama-bk" v-model="form.nama_bk" required
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="">
                        <div v-if="errors.nama_bk">
                            <small class="text-xs text-red-600">{{ errors.nama_bk }}</small>
                        </div>
                    </div>
                </div>
                <div class="mb-6 w-full">
                    <label for="default-deskripsi"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Deskripsi</label>
                    <textarea id="default-deskripsi" rows="3" v-model="form.deskripsi_bk" required
                        class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                        placeholder="Write the Profil Lulusan Deskripsi.."></textarea>
                    <div v-if="errors.deskripsi_bk">
                        <small class="text-xs text-red-600">{{ errors.deskripsi_bk }}</small>
                    </div>
                </div>
                <div class="flex flex-col md:flex-row justify-between gap-4 mb-6">
                    <div class="w-full">
                        <label for="default-bobot-min"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Bobot
                            Minimal</label>
                        <input type="number" id="default-bobot-min" v-model="form.bobot_min" required
                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <div v-if="errors.bobot_min">
                            <small class="text-xs text-red-600">{{ errors.bobot_min }}</small>
                        </div>
                    </div>
                    <div class="w-full mb-2 md:mb-0">
                        <label for="default-bobot-max"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Bobot
                            Maksimal</label>
                        <input type="number" id="default-bobot-max" v-model="form.bobot_max" required
                            class="w-full bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <div v-if="errors.bobot_max">
                            <small class="text-xs text-red-600">{{ errors.bobot_max }}</small>
                        </div>
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
    { name: "Bahan Kajian", link: route('bahan.kajian.index') },
    { name: "Edit", link: route('bahan.kajian.edit', { id: props.bk.id_bk }) },
])

const props = defineProps({
    bk: Object,
    errors: Object,
})

// Form data
let form = useForm({
    kode_bk: props.bk.kode_bk,
    nama_bk: props.bk.nama_bk,
    deskripsi_bk: props.bk.deskripsi_bk,
    bobot_min: props.bk.bobot_min,
    bobot_max: props.bk.bobot_max,
})

// Submit Form
const submit = () => {
    form.post(route('bahan.kajian.update', { id: props.bk.id_bk }))
}
</script>

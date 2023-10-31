<template>
    <Head :title="props.mk.nama_mk + ' Sub-CPMK List'" />
    <layout>
        <div class="p-6">
            <div class="grid gap-0 md:grid-cols-6 grid-cols-1">
                <div v-if="createMode || updateMode" class="col-span-1 md:col-span-2">
                    <form @submit.prevent="submit" autocomplete="off"
                        class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden p-4">
                        <div class="mb-6 w-full">
                            <label for="default-id-cpl"
                                class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">CPMK</label>
                            <select id="default-id-cpl" v-model="formIndikator.id_map_cpmk_mk" required
                                :disabled="updateMode" :class="!updateMode ? 'bg-gray-50' : 'bg-gray-300'"
                                class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                <option selected disabled>Choose Capaian Profil Lulusan</option>
                                <option v-for="data in map_cpmk" :value="data.id_map_cpmk_mk">
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
                            <textarea id="default-deskripsi" rows="3" v-model="formIndikator.deskripsi_sub_cpmk" required
                                class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                placeholder="Write the Profil Lulusan Deskripsi.."></textarea>
                            <div v-if="errors.deskripsi_sub_cpmk">
                                <small class="text-xs text-red-600">{{ errors.deskripsi_sub_cpmk }}</small>
                            </div>
                        </div>
                        <div class="flex justify-between">
                            <div>
                                <button type="submit"
                                    :class="updateMode ? 'bg-yellow-400 hover:bg-yellow-500 focus:ring-4 focus:ring-yellow-300' : 'bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300'"
                                    class="text-white font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2">
                                    {{ updateMode ? 'Update' : 'Save' }}
                                </button>
                                <button v-if="createMode"
                                    class="text-white font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300"
                                    type="button" @click="deactivateCreateMode">
                                    Cancel
                                </button>
                                <button v-if="updateMode"
                                    class="text-white font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300"
                                    type="button" @click="deativateUpdateMode">
                                    Cancel
                                </button>
                            </div>
                            <button v-if="updateMode" @click='deleteSubCPMK'
                                class="text-white font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300"
                                type="button">
                                <svg width="24" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path clip-rule="evenodd"
                                        d="M16.5 4.478v.227a48.816 48.816 0 013.878.512.75.75 0 11-.256 1.478l-.209-.035-1.005 13.07a3 3 0 01-2.991 2.77H8.084a3 3 0 01-2.991-2.77L4.087 6.66l-.209.035a.75.75 0 01-.256-1.478A48.567 48.567 0 017.5 4.705v-.227c0-1.564 1.213-2.9 2.816-2.951a52.662 52.662 0 013.369 0c1.603.051 2.815 1.387 2.815 2.951zm-6.136-1.452a51.196 51.196 0 013.273 0C14.39 3.05 15 3.684 15 4.478v.113a49.488 49.488 0 00-6 0v-.113c0-.794.609-1.428 1.364-1.452zm-.355 5.945a.75.75 0 10-1.5.058l.347 9a.75.75 0 101.499-.058l-.346-9zm5.48.058a.75.75 0 10-1.498-.058l-.347 9a.75.75 0 001.5.058l.345-9z"
                                        fill-rule="evenodd"></path>
                                </svg>
                            </button>
                        </div>
                    </form>
                </div>
                <div v-else
                    class="pb-8 px-2 col-span-1 md:col-span-2 gap-4 flex flex-col md:overflow-y-auto md:h-[calc(100vh-115px)] scrollbar-hide">
                    <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg p-8">
                        <h2 class="mb-6 text-lg font-semibold text-gray-900 dark:text-white">
                            Identitas Mata Kuliah
                        </h2>

                        <dl class="w-full text-gray-900 divide-y divide-gray-200 dark:text-white dark:divide-gray-700">
                            <div class="flex flex-col pb-3">
                                <dt class="mb-1 text-gray-500 md:text-sm dark:text-gray-400">Nama Program Studi</dt>
                                <dd class="text-sm font-semibold">{{ nama_prodi }}</dd>
                            </div>
                            <div class="flex flex-col py-3">
                                <dt class="mb-1 text-gray-500 md:text-sm dark:text-gray-400">Nama Matakuliah</dt>
                                <dd class="text-sm font-semibold">{{ mk.nama_mk }}</dd>
                            </div>
                            <div class="flex flex-col py-3">
                                <dt class="mb-1 text-gray-500 md:text-sm dark:text-gray-400">Kode Matakuliah</dt>
                                <dd class="text-sm font-semibold">{{ mk.kode_mk_obe }}</dd>
                            </div>
                            <div class="flex flex-col py-3">
                                <dt class="mb-1 text-gray-500 md:text-sm dark:text-gray-400">Kelompok Matakuliah</dt>
                                <dd class="text-sm font-semibold">Mata Kuliah Perinci Program Studi</dd>
                            </div>
                            <div class="flex flex-col py-3">
                                <dt class="mb-1 text-gray-500 md:text-sm dark:text-gray-400">Bobot SKS</dt>
                                <dd class="text-sm font-semibold">{{ mk.sks }} sks</dd>
                            </div>
                            <div class="flex flex-col py-3">
                                <dt class="mb-1 text-gray-500 md:text-sm dark:text-gray-400">Jenjang</dt>
                                <dd class="text-sm font-semibold">S1</dd>
                            </div>
                            <div class="flex flex-col py-3">
                                <dt class="mb-1 text-gray-500 md:text-sm dark:text-gray-400">Semester</dt>
                                <dd class="text-sm font-semibold">{{ mk.semester }}</dd>
                            </div>
                            <div class="flex flex-col pt-3">
                                <dt class="mb-1 text-gray-500 md:text-sm dark:text-gray-400">Nama dan Kode Dosen</dt>
                                <dd class="text-sm font-semibold">{{ username }}</dd>
                            </div>
                        </dl>
                    </div>
                    <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg p-8">
                        <h2 class="mb-6 text-lg font-semibold text-gray-900 dark:text-white">
                            Deskripsi Matakuliah
                        </h2>
                        <p class="text-justify text-sm">
                            {{ mk.deskripsi_mk }}
                        </p>
                    </div>
                    <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg p-8">
                        <h2 class="mb-6 text-lg font-semibold text-gray-900 dark:text-white">
                            Capaian Pembelajaran Program Studi yang Dirujuk
                        </h2>
                        <ul class="w-full space-y-1 text-sm text-gray-500 list-disc list-inside">
                            <li v-for="pl_item in pl">
                                <div class="ml-3 mt-[-20px]">
                                    <span class="font-bold">{{ pl_item.kode_pl }}</span>
                                    -
                                    {{ pl_item.deskripsi_pl }}
                                </div>
                            </li>
                        </ul>
                    </div>
                    <div class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg p-8">
                        <h2 class="mb-6 text-lg font-semibold text-gray-900 dark:text-white">
                            Capaian Pembelajaran Mata Kuliah
                        </h2>
                        <ul class="w-full space-y-1 text-sm text-gray-500 list-disc list-inside">
                            <li v-for="cpmk_item in cpmk">
                                <div class="ml-3 mt-[-20px]">
                                    <!-- <span class="font-bold">{{ cpmk_item.kode_cpmk }}</span>
                                    - -->
                                    {{ cpmk_item.deskripsi_cpmk }}
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="pb-0 px-2 col-span-1 md:col-span-4 relative">
                    <h1 class="text-center text-lg mb-4">
                        RENCANA PEMBELAJARAN SEMESTER
                        <br>
                        <span class="text-lg font-semibold">{{ mk.nama_mk }}</span>
                    </h1>

                    <button @click="saveAll()"
                        class="animate-bounce absolute flex justify-between items-center z-50 bottom-0 right-0 bg-blue-600 hover:bg-blue-700 text-white py-3 px-2 rounded-md text-xs"
                        type="button">
                        <svg width="24" aria-hidden="true" fill="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M11.47 1.72a.75.75 0 011.06 0l3 3a.75.75 0 01-1.06 1.06l-1.72-1.72V7.5h-1.5V4.06L9.53 5.78a.75.75 0 01-1.06-1.06l3-3zM11.25 7.5V15a.75.75 0 001.5 0V7.5h3.75a3 3 0 013 3v9a3 3 0 01-3 3h-9a3 3 0 01-3-3v-9a3 3 0 013-3h3.75z">
                            </path>
                        </svg>
                        <span class="mx-3">Save</span>
                    </button>

                    <div v-if="hasRps" class="font-sans flex flex-col h-[calc(100vh-190px)]">
                        <div class="shadow overflow-auto border-b border-gray-200 sm:rounded">
                            <table class="w-full table-fixed">
                                <thead class="z-10 divide-y divide-gray-200">
                                    <tr class="bg-gray-100 divide-gray-600">
                                        <th scope="col"
                                            class="w-20 bg-gray-100 px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Pert
                                        </th>
                                        <th scope="col"
                                            class="w-[350px] px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Indikator CPMK
                                        </th>
                                        <th scope="col"
                                            class="w-[250px] px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Bahan Kajian
                                        </th>
                                        <th scope="col"
                                            class="w-[250px] px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Bentuk Pembelajaran
                                        </th>
                                        <th scope="col"
                                            class="w-[250px] px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Waktu
                                        </th>
                                        <th scope="col"
                                            class="w-[250px] px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase tracking-wider">
                                            Tugas dan Penlilaian
                                        </th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    <template v-for="(rps_item, index) in rps">
                                        <tr v-if="rps_item.pertemuan == 8" class="divide-x divqqide-gray-200">
                                            <th class="px-6 py-4 whitespace-nowrap bg-gray-100">
                                                <div class="flex justify-center items-center">
                                                    <div class="text-left">
                                                        <div class="text-sm font-medium text-gray-900">
                                                            {{ rps_item.pertemuan }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </th>
                                            <td class="px-6 py-4 whitespace-wrap text-sm text-left">
                                                <p>UTS</p>
                                            </td>
                                            <td class="px-6 py-4 whitespace-wrap text-sm text-left">
                                                -
                                            </td>
                                            <td class="px-6 py-4 whitespace-wrap text-sm text-left">
                                                -
                                            </td>
                                            <td class="px-6 py-4 whitespace-wrap text-sm text-left">
                                                -
                                            </td>
                                            <td class="px-6 py-4 whitespace-wrap text-sm text-left">
                                                -
                                            </td>
                                        </tr>
                                        <tr v-else-if="rps_item.pertemuan == 16" class="divide-x divqqide-gray-200">
                                            <th class="px-6 py-4 whitespace-nowrap bg-gray-100">
                                                <div class="flex justify-center items-center">
                                                    <div class="text-left">
                                                        <div class="text-sm font-medium text-gray-900">
                                                            {{ rps_item.pertemuan }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </th>
                                            <td class="px-6 py-4 whitespace-wrap text-sm text-left">
                                                <div class="flex justify-between items-center mb-4">
                                                    <p>UAS</p>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 whitespace-wrap text-sm text-left">
                                                -
                                            </td>
                                            <td class="px-6 py-4 whitespace-wrap text-sm text-left">
                                                -
                                            </td>
                                            <td class="px-6 py-4 whitespace-wrap text-sm text-left">
                                                -
                                            </td>
                                            <td class="px-6 py-4 whitespace-wrap text-sm text-left">
                                                -
                                            </td>
                                        </tr>
                                        <tr v-else class="divide-x divqqide-gray-200">
                                            <th class="px-6 py-4 whitespace-nowrap bg-gray-100">
                                                <div class="flex justify-center items-center">
                                                    <div class="text-left">
                                                        <div class="text-sm font-medium text-gray-900">
                                                            {{ rps_item.pertemuan }}
                                                        </div>
                                                    </div>
                                                </div>
                                            </th>
                                            <td class="px-6 py-4 whitespace-wrap text-sm text-left">
                                                <div class="flex justify-between items-center mb-4">
                                                    <p>Mahasiswa Mampu:</p>
                                                    <button @click="activateCreateMode(rps_item.id_deskripsi_rps)"
                                                        class="bg-blue-600 hover:bg-blue-700 text-white p-0.5 rounded-md text-xs"
                                                        type="button">
                                                        <svg width="24" aria-hidden="true" fill="none" stroke="currentColor"
                                                            stroke-width="1.5" viewBox="0 0 24 24"
                                                            xmlns="http://www.w3.org/2000/svg">
                                                            <path d="M12 6v12m6-6H6" stroke-linecap="round"
                                                                stroke-linejoin="round"></path>
                                                        </svg>
                                                    </button>
                                                </div>
                                                <ul class="list-disc text-justify pl-5">
                                                    <template v-if="indikatorList.length != 0">
                                                        <li v-for="indikator_item in indikatorList[index]"
                                                            v-if="indikatorList[index].length != 0">
                                                            <div title="Tekan untuk aksi"
                                                                @click="activateUpdateMode(indikator_item)"
                                                                class="mr-3 cursor-pointer hover:bg-gray-200 p-1.5 rounded-md">
                                                                {{ indikator_item.deskripsi_sub_cpmk }}
                                                            </div>
                                                        </li>
                                                        <li v-else>
                                                            <div class="mr-3 p-1.5 rounded-md">
                                                                -
                                                            </div>
                                                        </li>
                                                    </template>
                                                </ul>
                                            </td>
                                            <td class="px-6 py-4 whitespace-wrap text-sm text-left">
                                                <p>Pilih Bahan Kajian:</p>
                                                <select id="default-id-cpl" v-model="rps_item.id_bk"
                                                    class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                                    <option selected disabled>Choose Bahan Kajian</option>
                                                    <option v-for="bk_item in bk" :value="bk_item.id_bk">
                                                        {{ bk_item.kode_bk }} - {{ bk_item.nama_bk }}
                                                    </option>
                                                </select>
                                            </td>
                                            <td class="px-6 py-4 whitespace-wrap text-sm text-left">
                                                <div class="mb-2">
                                                    <p class="font-semibold">Synchronous:</p>
                                                    <textarea v-model="rps_item.bentuk_pembelajaran_synchronous"
                                                        class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        rows="" cols=""></textarea>
                                                </div>
                                                <div>
                                                    <p class="font-semibold">Asynchronous:</p>
                                                    <textarea v-model="rps_item.bentuk_pembelajaran_asynchronous"
                                                        class="border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                                        rows="" cols=""></textarea>
                                                </div>
                                            </td>
                                            <td class="whitespace-wrap text-sm text-left relative">
                                                <textarea v-model="rps_item.waktu"
                                                    class="absolute top-0.5 left-0.5 h-[calc(100%-4px)] w-[calc(100%-4px)] resize-none border-none text-gray-900 text-sm focus:border-none block p-2.5"></textarea>
                                            </td>
                                            <td class="whitespace-wrap text-sm text-left relative">
                                                <textarea v-model="rps_item.tugas_dan_penilaian"
                                                    class="absolute top-0.5 left-0.5 h-[calc(100%-4px)] w-[calc(100%-4px)] resize-none border-none text-gray-900 text-sm focus:border-none block p-2.5"></textarea>
                                            </td>
                                        </tr>
                                    </template>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div v-else class="w-full text-center">
                        <button @click="generateRps()"
                            class="bg-blue-600 hover:bg-blue-700 text-white py-0.5 px-2 rounded-md text-xs" type="button">
                            Generate Deskripsi RPS
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </layout>
</template>

<script setup>
// Import Library
import Layout from '@/Pages/Layouts/DosenLayout.vue'
import { ref, watchEffect, onUpdated, onMounted } from 'vue'
import { router, useForm } from '@inertiajs/vue3'
import Swal from 'sweetalert2'
import { debounce } from 'lodash'

// Properti
const props = defineProps({
    subcpmk: Object,
    cpmk: Object,
    mk: Object,
    filters: Object,
    flash: Object,
    errors: Object,
    username: String,
    nama_prodi: String,
    pl: Object,
    cpmk: Object,
    bk: Object,
    hasRps: Boolean,
    rps: Object,
    map_cpmk: Object,
    indikator: Object,
})

// OnMounted
const indikatorList = ref([])
onMounted(() => {
    const groupedByPertemuan = props.indikator.reduce((acc, obj) => {
        const pertemuan = obj.pertemuan

        // Initialize an empty array for the pertemuan if it doesn't exist
        if (!acc[pertemuan]) {
            acc[pertemuan] = []
        }

        // Push the object into the pertemuan array
        acc[pertemuan].push(obj)
        return acc
    }, {})

    // Fill in missing pertemuan with blank arrays
    indikatorList.value = Array.from({ length: 16 }, (_, index) => groupedByPertemuan[index + 1] || [])
})

// Form Indikator Deskripsi
let formIndikator = useForm({
    id_map_cpmk_mk: "",
    deskripsi_sub_cpmk: "",
})

const createMode = ref(false)
const currentIdDeskripsiRPS = ref(null)
const activateCreateMode = (id_deskripsi_rps) => {
    createMode.value = true
    updateMode.value = false
    currentIdDeskripsiRPS.value = id_deskripsi_rps

}
const deactivateCreateMode = () => {
    createMode.value = false
    currentIdDeskripsiRPS.value = null
    formIndikator.reset()
}

// For Create And Update
const updateMode = ref(false)
const updatedSubCpmk = ref(null)
const activateUpdateMode = (subcpmk) => {
    createMode.value = false
    updateMode.value = true
    updatedSubCpmk.value = subcpmk.id_sub_cpmk
    selectedIndikator.value = subcpmk.id_indikator_deskripsi_rps
    formIndikator.deskripsi_sub_cpmk = subcpmk.deskripsi_sub_cpmk
    formIndikator.id_map_cpmk_mk = subcpmk.id_map_cpmk_mk
}
const deativateUpdateMode = () => {
    updateMode.value = false
    updatedSubCpmk.value = null
    formIndikator.reset()
}
const submit = () => {
    if (updateMode.value) {
        formIndikator.post(route('subcpmk.update',
            {
                id: updatedSubCpmk.value,
            }),
            {
                preserveScroll: true,
                onSuccess: () => {
                    updateMode.value = false
                    updatedSubCpmk.value = null
                    currentIdDeskripsiRPS.value = null
                    formIndikator.reset()
                },
            })
    } else {
        formIndikator.post(route('indikator.rps.store',
            { id_deskripsi_rps: currentIdDeskripsiRPS.value }),
            {
                preserveScroll: true,
                onSuccess: () => {
                    createMode.value = false
                    currentIdDeskripsiRPS.value = null
                    formIndikator.reset()
                },
            })
    }
}

// For Delete
const selectedIndikator = ref(null)
const deleteSubCPMK = () => {
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
            router.delete(route('indikator.rps.destroy', {
                id_sub_cpmk: updatedSubCpmk.value,
                id_indikator_rps: selectedIndikator.value
            }), {
                preserveScroll: true,
                onSuccess: () => {
                    updateMode.value = false
                    updatedSubCpmk.value = null
                    currentIdDeskripsiRPS.value = null
                    selectedIndikator.value = null
                    formIndikator.reset()
                },
            })
        }
    })
}

// generate Rps
const generateRps = () => {
    router.post(
        route('rps.generate', {
            id_mk: props.mk.id_mk
        }),
        { preserveState: true },
    )
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

    const groupedByPertemuan = props.indikator.reduce((acc, obj) => {
        const pertemuan = obj.pertemuan

        // Initialize an empty array for the pertemuan if it doesn't exist
        if (!acc[pertemuan]) {
            acc[pertemuan] = []
        }

        // Push the object into the pertemuan array
        acc[pertemuan].push(obj)
        return acc
    }, {})

    // Fill in missing pertemuan with blank arrays
    indikatorList.value = Array.from({ length: 16 }, (_, index) => groupedByPertemuan[index + 1] || [])
})

const saveAll = async () => {
    router.post(
        route('desk.rps.update.all'),
        { ...props.rps },
        { preserveState: true },
    )
}
</script>

<style scoped>
table {
    font-family: "Inter", sans-serif;
}

table thead {
    top: 0;
    position: sticky;
    z-index: 10;
}

table thead th:first-child {
    position: sticky;
    left: 0;
}

table tbody tr,
table thead tr {
    position: relative;
}

table tbody th {
    position: sticky;
    left: 0;
}
</style>

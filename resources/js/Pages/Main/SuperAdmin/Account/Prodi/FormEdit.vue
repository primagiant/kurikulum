<template>
    <Head title="Update User" />
    <div>
        <Breadcrumb :items="breadcrumbItems" />
        <div class="p-6">
            <div class="flex justify-between">
                <h1 class="mb-5">User Update</h1>
                <Link type="button" :href="route('user.index')"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
                Back
                </Link>
            </div>
            <form @submit.prevent="submit" autocomplete="off"
                class="bg-white dark:bg-gray-800 relative shadow-md sm:rounded-lg overflow-hidden p-4">
                <div class="flex flex-col md:flex-row justify-between gap-4 mb-6 ">
                    <div class="w-full mb-2 md:mb-0">
                        <label for="default-username"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Username</label>
                        <input type="text" id="default-username" v-model="form.name"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <div v-if="errors.name">
                            <small class="text-xs text-red-600">{{ errors.name }}</small>
                        </div>
                    </div>
                    <div class="w-full">
                        <label for="default-email"
                            class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Email</label>
                        <input type="email" id="default-email" v-model="form.email"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                        <div v-if="errors.email">
                            <small class="text-xs text-red-600">{{ errors.email }}</small>
                        </div>
                    </div>
                </div>
                <div class="flex flex-col md:flex-row justify-between gap-4 mb-6 ">
                    <div class="w-full mb-2 md:mb-0">
                        <label for="default-role" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Role User
                        </label>
                        <select id="default-role" v-model="form.role" required
                            class="bg-gray-50 w-full border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected disabled>Choose Kategori Matakuliah</option>
                            <option v-for="role in roles" :value="role.id">
                                {{ role.name }}
                            </option>
                        </select>
                        <div v-if="errors.role">
                            <small class="text-xs text-red-600">{{ errors.role }}</small>
                        </div>
                    </div>
                    <div class="w-full">
                        <label for="default-prodi" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Prodi User
                        </label>
                        <select id="default-prodi" v-model="form.prodi" required
                            class="bg-gray-50 w-full border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option selected disabled>Choose Kategori Matakuliah</option>
                            <option v-for="prodi in prodis" :value="prodi.id_prodi">
                                {{ prodi.nama_prodi }} - {{ prodi.kode_prodi }}
                            </option>
                        </select>
                        <div v-if="errors.prodi">
                            <small class="text-xs text-red-600">{{ errors.prodi }}</small>
                        </div>
                    </div>
                </div>
                <div class="mb-6 w-full">
                    <label for="default-password" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">New
                        Password</label>
                    <input type="password" id="default-password" v-model="form.newPassword"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                    <small class="text-gray-500 mt-2">If you don't want to change leave it blank</small>
                    <div v-if="errors.newPassword">
                        <small class="text-xs text-red-600">{{ errors.newPassword }}</small>
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
    user: Object,
    roles: Object,
    prodis: Object,
    errors: Object,
})

// Setting Breadcrumb
const breadcrumbItems = ref([
    { name: "Account" },
    { name: "User", link: route('user.index') },
    { name: "Edit", link: route('user.edit', props.user.id) },
])

// Form data
let form = useForm({
    name: props.user.name,
    email: props.user.email,
    newPassword: "",
    role: props.user.role_id,
    prodi: props.user.id_prodi,
})

// Submit Form
const submit = () => {
    form.post(route('user.update', { id: props.user.id }))
}
</script>

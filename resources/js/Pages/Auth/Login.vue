<template>
    <Head title="Login Page" />
    <div class="grid grid-cols-12">
        <div
            class=" col-span-12 md:col-span-6 lg:col-span-7 md:h-screen bg-gray-800 text-white p-16 relative flex justify-center items-center flex-col">
            <LoginAnimated class="h-[150px] sm:h-[200px] md:h-[400px] lg:h-[620px]" />
            <div class="text-center">
                <h1 class="-mt-2 font-quick font-bold text-3xl mb-2">
                    Kurikulum Portal
                </h1>
                <p class="w-96 font-thin">
                    Website untuk Lorem ipsum dolor sit amet consectetur adipisicing elit. Obcaecati nisi enim blanditiis
                    earum
                </p>
            </div>
        </div>
        <div class="md:h-screen p-8 lg:p-16 col-span-12 md:col-span-6 lg:col-span-5">
            <div class="flex justify-center items-center flex-col h-full">
                <h1 class="text-2xl font-quick font-bold">Login Page</h1>
                <form @submit.prevent="submitLogin()" class="w-full mt-3">
                    <div class="mb-6">
                        <label for="email" class="block mb-2 text-sm font-medium text-gray-800 dark:text-white">
                            Your email
                        </label>
                        <input type="email" id="email" v-model="form.email"
                            class="shadow-sm bg-gray-50 border border-gray-300 text-gray-800 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light"
                            placeholder="mail@example.com" required>
                    </div>
                    <div class="mb-6">
                        <label for="password" class="block mb-2 text-sm font-medium text-gray-800 dark:text-white">
                            Your password
                        </label>
                        <div class="relative">
                            <input :type="passwordFieldType" id="password" v-model="form.password"
                                class="shadow-sm bg-gray-50 border border-gray-300 text-gray-800 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500 dark:shadow-sm-light"
                                required>
                            <div @click="togglePasssword()" class="absolute right-2.5 top-2.5 text-sm cursor-pointer">
                                <span v-if="passwordFieldType === 'password'">Show</span>
                                <span v-else>Hide</span>
                            </div>
                        </div>
                    </div>
                    <div class="flex items-start mb-6">
                        <div class="flex items-center h-5">
                            <input id="terms" type="checkbox" value=""
                                class="w-4 h-4 border border-gray-300 rounded bg-gray-50 focus:ring-3 focus:ring-primary-300 dark:bg-gray-700 dark:border-gray-600 dark:focus:ring-primary-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800"
                                required>
                        </div>
                        <label for="terms" class="ml-2 text-sm font-medium text-gray-800 dark:text-gray-300">
                            I agree with the
                            <a href="#" class="text-primary-600 hover:underline dark:text-primary-500">
                                terms and conditions
                            </a>
                        </label>
                    </div>
                    <button type="submit" :disabled="form.processing"
                        class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                        Login
                    </button>
                </form>
            </div>
        </div>

    </div>
    <Link as="button" :href="route('landing')"
        class="bg-primary-700 hover:bg-primary-800 absolute bottom-5 right-5 py-2.5 px-3 rounded-lg">
    <HomeIcon class="text-white h-6 w-6" />
    </Link>
</template>


<script setup>
import LoginAnimated from '@/Pages/Components/Svg/Animation/LoginAnimated.vue'
import HomeIcon from '../Components/Svg/Icon/HomeOutlineIcon.vue'
import { useForm } from "@inertiajs/vue3"
import { ref } from 'vue'

// Form Element
let form = useForm({
    email: '',
    password: ''
})

// Submit Form
const submitLogin = () => {
    form.post(route('login.post'))
}

// Toggle Password
const passwordFieldType = ref("password")
const togglePasssword = () => {
    passwordFieldType.value = passwordFieldType.value === "password" ? "text" : "password"
}

</script>

<template>
    <Head title="Landing page" />
    <header>
        <nav class="bg-gray-200 border-gray-200 px-4 lg:px-6 py-4 dark:bg-gray-800 shadow-md">
            <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
                <a href="https://flowbite.com" class="flex items-center">
                    <img src="https://flowbite.com/docs/images/logo.svg" class="mr-3 h-6 sm:h-9" alt="Flowbite Logo" />
                    <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">APP</span>
                </a>
                <div class="flex items-center lg:order-2">
                    <Link :href="route('login')" v-if="!isLogin"
                        class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                    Log in
                    </Link>

                    <Link :href="route('dashboard')" v-else
                        class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                    Dashboard
                    </Link>
                </div>
            </div>
        </nav>
    </header>
</template>

<script>
import { initFlowbite } from 'flowbite'
import { Link } from '@inertiajs/vue3'

export default {
    components: {
        Link
    },
    computed: {
        isLogin() {
            if (this.$page.props.auth) { return true }
            return false
        }
    },
    mounted() {
        initFlowbite()
    },
}
</script>

<template>
    <Head title="Login Page" />
    <div class="h-screen bg-gray-800 text-white p-16 relative flex justify-center items-center flex-col">
        <ErrorAnimated class="h-[150px] sm:h-[200px] md:h-[400px] lg:h-[620px]" />
        <div class="text-center">
            <h1 class="-mt-2 font-quick font-bold text-3xl mb-2">
                Page Not Found
            </h1>
            <p class="mb-5 font-quick text-sm text-center">
                Page is under construction, you can contact
                <a href="https://github.com/primagiant" target="_blank" class="underline font-black">PrimaGiant</a>
                as a developer.
            </p>
            <Link :href="route('logout')" method="post" as="button"
                class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
            Log out
            </Link>
        </div>
    </div>
</template>

<script setup>
import ErrorAnimated from "@/Pages/Components/Svg/ErrorAnimated.vue"
</script>

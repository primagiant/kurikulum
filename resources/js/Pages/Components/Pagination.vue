<template>
    <nav class="flex flex-col md:flex-row justify-between items-start md:items-center space-y-3 md:space-y-0 p-4"
        aria-label="Table navigation">
        <span class="text-sm font-normal text-gray-500 dark:text-gray-400">
            Showing
            <span class="font-semibold text-gray-900 dark:text-white">{{ from }} - {{ to }}</span>
            of
            <span class="font-semibold text-gray-900 dark:text-white">{{ total }}</span>
        </span>
        <ul class="inline-flex items-stretch -space-x-px">
            <li v-for="(page) in links  " :key="page.url">
                <Component :is="page.url ? 'Link' : 'span'" v-if="page.url" :href="page.url"
                    :class="[page.url ? 'flex' : 'hidden',
                    page.active ? 'flex items-center justify-center px-3 h-8 text-blue-600 border border-gray-300 bg-blue-50 hover:bg-blue-100 hover:text-blue-700 dark:border-gray-700 dark:bg-gray-700 dark:text-white' : 'items-center justify-center px-3 h-8 leading-tight text-gray-500 bg-white border border-gray-300 hover:bg-gray-100 hover:text-gray-700 dark:bg-gray-800 dark:border-gray-700 dark:text-gray-400 dark:hover:bg-gray-700 dark:hover:text-white']"
                    v-html="page.label" />
            </li>
        </ul>
    </nav>
</template>

<script>
export default {
    props: {
        links: Array,
        from: Number,
        to: Number,
        total: Number,
    }
}
</script>

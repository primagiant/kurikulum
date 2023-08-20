<template>
    <nav class="flex px-5 py-3 text-gray-700 border bg-gray-50 dark:bg-gray-800 dark:border-gray-700 w-full"
        aria-label="Breadcrumb">
        <ol class="inline-flex items-center space-x-1 md:space-x-3">
            <li v-for="(item, index) in props.items">
                <div class="flex items-center">
                    <svg v-if="index !== 0" aria-hidden="true" class="w-6 h-6 text-gray-400" fill="currentColor"
                        viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                            clip-rule="evenodd"></path>
                    </svg>
                    <Component :is="item?.link ? 'Link' : 'span'" :href="item.link"
                        class="ml-1 text-sm font-medium text-gray-700 hover:text-blue-600 dark:text-gray-400 dark:hover:text-white"
                        v-html="item.name" />
                </div>
            </li>
        </ol>
    </nav>
</template>

<script setup>
const props = defineProps({
    items: Array,
})
</script>

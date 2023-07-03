<template>
    <aside class="fixed top-0 md:left-0 w-64 h-full transition-transform" aria-label="Sidenav">
        <div
            class="mt-14 overflow-y-auto py-5 px-3 h-full bg-white border-r border-gray-200 dark:bg-gray-800 dark:border-gray-700">
            <ul v-for="(ul, index) in props.items"
                :class="index != 0 ? 'space-y-2 pt-5 mt-5 border-t border-gray-200 dark:border-gray-700' : 'space-y-2'">
                <li v-for="li in ul">
                    <div v-if="li.includeChild == false">
                        <Link :href="li.link" as="button"
                            class="flex  w-full items-center p-2 text-base font-normal text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                        <Icon :icon="`fa-solid ${li.icon}`" />
                        <span class="ml-3">{{ li.title }}</span>
                        </Link>
                    </div>
                    <div v-else>
                        <button type="button"
                            class="flex items-center p-2 w-full text-base font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700"
                            aria-controls="dropdown-pages" :data-collapse-toggle="`dropdown-pages-${li.title}`">
                            <Icon :icon="`fa-solid ${li.icon}`" />
                            <span class="flex-1 ml-3 text-left whitespace-nowrap">{{ li.title }}</span>
                            <DropdownIcon />
                        </button>
                        <ul :id="`dropdown-pages-${li.title}`" class="hidden py-2 space-y-2">
                            <li v-for="child in li.child">
                                <Link :href="child.link"
                                    class="flex items-center p-2 pl-11 w-full text-base font-normal text-gray-900 rounded-lg transition duration-75 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                                {{ child.title }}
                                </Link>
                            </li>
                        </ul>
                    </div>
                </li>
            </ul>
        </div>
    </aside>
</template>

<script setup>
import { initFlowbite } from 'flowbite'
import DropdownIcon from '../Svg/Icon/DropdownIcon.vue'
import { onMounted } from 'vue'

const props = defineProps({
    items: Array,
})

onMounted(() => {
    initFlowbite()
})
</script>

<template>
    <aside class="fixed font-quick top-0 md:left-0 w-64 h-full transition-transform" aria-label="Sidenav">
        <div class="pt-20 overflow-y-auto scrollbar-hide py-5 px-3 h-full bg-primary-800 border-r border-gray-200">
            <ul v-for="(ul, index) in props.items" :class="index != 0 ? 'space-y-2 pt-5 mt-5' : 'space-y-2'">
                <span v-if="ul.title" class="font-bold uppercase text-xs text-white ml-2">{{ ul.title }}</span>
                <li v-for="li in    ul.child   ">
                    <Link :href="li.link" as="button"
                        :class="[route().current() == li.route_name ? 'text-black bg-gray-100' : 'text-white']"
                        class="flex w-full items-center p-2 text-base font-normal hover:text-black rounded-lg hover:bg-gray-100 group">
                    <span v-html="li.icon"></span>
                    <span class="ml-3">{{ li.title }}</span>
                    </Link>
                </li>
            </ul>
        </div>
    </aside>
</template>

<script setup>
const props = defineProps({
    items: Array,
})
</script>

<template>
    <Head title="Home" />
    <div>
        <Breadcrumb :items="breadcrumbItems" />
        <div class="p-6">
            Dashboard
        </div>
    </div>
</template>

<script>
import Layout from '@/Pages/Layouts/SuperAdminLayout.vue'
export default {
    layout: Layout
}
</script>

<script setup>
import { ref } from 'vue'
import Breadcrumb from '@/Pages/Components/Breadcrumbs/Breadcrumb.vue'

const breadcrumbItems = ref([
    {
        name: "Home",
    },
    {
        name: "Overview",
        link: route('dashboard')
    },
])
</script>

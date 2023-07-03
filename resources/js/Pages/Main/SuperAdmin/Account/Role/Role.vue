<template>
    <Head title="Role" />
    <div>
        <Breadcrumb :items="breadcrumbItems" />
        <div class="p-6">
            Role List
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
        name: "Account",
    },
    {
        name: "Role",
    },
    {
        name: "List",
        link: route('role.index')
    },
])
</script>

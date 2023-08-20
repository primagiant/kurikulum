<template>
    <Head title="Home" />
    <Layout>
        <div>
            <Breadcrumb :items="breadcrumbItems" />
            <div class="p-6">
                Dashboard
            </div>
        </div>
    </Layout>
</template>

<script setup>
import Layout from '@/Pages/Layouts/KoorProdiLayout.vue'
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

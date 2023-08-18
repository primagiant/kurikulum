<template>
    <Head title="Home" />
    <layout>
        <Breadcrumb :items="breadcrumbItems" />
        <div class="p-6">
            Dashboard
        </div>
    </layout>
</template>

<script setup>
import Layout from '@/Pages/Layouts/DosenLayout.vue'
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

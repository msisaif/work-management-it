<template>
    <Head title="Project" />

    <AppLayout>
        <template #header>
            Create Project
        </template>
        
        <Form :project="project" moduleAction="store" />
    </AppLayout>
</template>

<script>
import { Head, Link } from '@inertiajs/inertia-vue3';
import AppLayout from "@/Layouts/App.vue";
import Form from "./Form.vue";

export default {
    components: {
        AppLayout,
        Head,
        Link,
        Form,
    },

    props: {
        project: { type: Object, default: {} },
    },
};
</script>

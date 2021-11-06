<template>
    <Head title="Project" />

    <AppLayout>
        <template #header>
            Edit Project
        </template>
        
        <Form :project="project" moduleAction="update" />
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

<template>
    <Head title="Issue" />

    <AppLayout>
        <template #header>
            Create Issue
        </template>
        
        <Form :issue="issue" :projects="projects" :workTypes="workTypes" moduleAction="store" />
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
        issue: { type: Object, default: {} },
        projects: { type: Object, default: {} },
        workTypes: { type: Object, default: {} },
    },
};
</script>

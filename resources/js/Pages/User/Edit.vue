<template>
    <Head title="User" />

    <AppLayout>
        <template #header>
            Edit User
        </template>
        
        <Form :user="user" moduleAction="update" />
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
        user: { type: Object, default: {} },
    },
};
</script>

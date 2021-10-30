<template>
    <Head title="User" />

    <AppLayout>
        <template #header>
            User List
        </template>

        <DataTable :collections="users" :filters="filters" :dateFilter="true" :serialColumn="true">
            <template #head>
                <th class="py-3 px-2 text-left">ID</th>
                <th class="py-3 px-2 text-center">Status</th>
                <th class="py-3 px-2 text-left">Name</th>
                <th class="py-3 px-2 text-left">Email</th>
            </template>
            <template #default="{item: user}">
                <td class="py-3 px-2 text-left">{{ user.id }}</td>
                <td class="py-3 px-2 text-center" :class="{'text-red-500': user.deleted_at }">
                    {{ user.deleted_at ? 'Trashed' : 'Active' }}
                </td>
                <td class="py-3 px-2 text-left">{{ user.name }}</td>
                <td class="py-3 px-2 text-left">{{ user.email }}</td>
            </template>
        </DataTable>
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/App.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import DataTable from "@/Components/DataTable.vue";
import Input from '@/Components/Input.vue';
import PaginatorLinks from '@/Components/PaginatorLinks.vue';

export default {
    components: {
        AppLayout,
        DataTable,
        Head,
        Link,
        Input,
        PaginatorLinks,
    },
    props: {
        users: { type: Object, default: {} },
        filters: { type: Object, default: {} },
    },
};
</script>

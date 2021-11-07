<template>
    <Head title="User" />

    <AppLayout>
        <template #header>
            User List
        </template>

        <div class="w-full mb-4 flex">
            <a :href="route('users.create')" class="text-center cursor-pointer border border-blue-600 text-white hover:bg-blue-700 bg-blue-600 rounded-md px-3 py-1.5">
                + Add New
            </a>
        </div>

        <DataTable :collections="users" :filters="filters" :dateFilter="true" :serialColumn="true">
            <template #head>
                <th class="py-3 px-2 text-left">ID</th>
                <th class="py-3 px-2 text-left">Name</th>
                <th class="py-3 px-2 text-left">Email</th>
                <th class="py-3 px-2 text-center">Action</th>
            </template>
            <template #default="{item: user}">
                <td class="py-3 px-2 text-left">{{ user.id }}</td>
                <td class="py-3 px-2 text-left">{{ user.name }}</td>
                <td class="py-3 px-2 text-left">{{ user.email }}</td>
                <td class="py-2.5 px-2">
                    <div class="flex justify-center items-center gap-1 md:gap-2">
                        <ActionButtonShow :href="route('users.show', user.id)" />
                        <ActionButtonEdit :href="route('users.edit', user.id)" />
                    </div>
                </td>
            </template>
        </DataTable>
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/App.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import DataTable from "@/Components/DataTable.vue";
import ActionButtonShow from "@/Components/ActionButtonShow.vue";
import ActionButtonEdit from "@/Components/ActionButtonEdit.vue";

export default {
    components: {
        AppLayout,
        DataTable,
        Head,
        Link,
        ActionButtonShow,
        ActionButtonEdit,
    },
    props: {
        users: { type: Object, default: {} },
        filters: { type: Object, default: {} },
    },
};
</script>

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
                <th class="py-3 px-2 text-center">Action</th>
            </template>
            <template #default="{item: user}">
                <td class="py-3 px-2 text-left">{{ user.id }}</td>
                <td class="py-3 px-2 text-center" :class="{'text-red-500': user.deleted_at }">
                    {{ user.deleted_at ? 'Trashed' : 'Active' }}
                </td>
                <td class="py-3 px-2 text-left">{{ user.name }}</td>
                <td class="py-3 px-2 text-left">{{ user.email }}</td>
                <td class="py-3 px-2 text-center">
                    <div class="flex justify-center items-center gap-1 md:gap-2">
                        <Link :href="route('users.show', user.id)" title="Show" class="flex justify-center items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M10 12a2 2 0 100-4 2 2 0 000 4z" />
                                <path fill-rule="evenodd" d="M.458 10C1.732 5.943 5.522 3 10 3s8.268 2.943 9.542 7c-1.274 4.057-5.064 7-9.542 7S1.732 14.057.458 10zM14 10a4 4 0 11-8 0 4 4 0 018 0z" clip-rule="evenodd" />
                            </svg>
                        </Link>
                        <Link :href="route('users.edit', user.id)" title="Edit" class="flex justify-center items-center">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                            </svg>
                        </Link>
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

export default {
    components: {
        AppLayout,
        DataTable,
        Head,
        Link,
    },
    props: {
        users: { type: Object, default: {} },
        filters: { type: Object, default: {} },
    },
};
</script>

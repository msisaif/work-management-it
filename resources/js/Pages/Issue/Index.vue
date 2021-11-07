<template>
    <Head title="Issue" />

    <AppLayout>
        <template #header>
            Issue List
        </template>

        <div class="w-full mb-4 flex">
            <a :href="route('issues.create')" class="text-center cursor-pointer border border-blue-600 text-white hover:bg-blue-700 bg-blue-600 rounded-md px-3 py-1.5">
                + Add New
            </a>
        </div>

        <DataTable :collections="issues" :filters="filters" :dateFilter="true" :serialColumn="true">
            <template #head>
                <th class="py-3 px-2 text-left">Create By</th>
                <th class="py-3 px-2 text-right">Issue No (ID)</th>
                <th class="py-3 px-2 text-left">Project</th>
                <th class="py-3 px-2 text-center">Work Type</th>
                <th class="py-3 px-2 text-left">Title</th>
                <th class="py-3 px-2 text-center">Active</th>
                <th class="py-3 px-2 text-center">Created Date</th>
                <th class="py-3 px-2 text-center">Action</th>
            </template>
            <template #default="{item: issue}">
                <td class="py-3 px-2 text-left">{{ issue.userName }}</td>
                <td class="py-3 px-2 text-right">{{ issue.id }}</td>
                <td class="py-3 px-2 text-left">
                    {{ issue.projectName }} ({{ issue.projectNicname }})
                </td>
                <td class="py-3 px-2 text-center">{{ issue.workType }}</td>
                <td class="py-3 px-2 text-left">{{ issue.title }}</td>
                <td class="py-3 px-2 text-center">
                    <span :class="issue.active ? 'bg-green-600' : 'bg-red-600'" class="text-white rounded-full px-2 py-0.5">
                        {{ issue.active ? 'Open' : 'Closed' }}
                    </span>
                </td>
                <td class="py-3 px-2 text-center">{{ issue.createdDate }}</td>
                <td class="py-2.5 px-2">
                    <div class="flex justify-center items-center gap-1 md:gap-2">
                        <ActionButtonShow :href="route('issues.show', issue.id)" />
                        <ActionButtonEdit :href="route('issues.edit', issue.id)" />
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
        issues: { type: Object, default: {} },
        filters: { type: Object, default: {} },
    },
};
</script>

<template>
    <Head title="Project" />

    <AppLayout>
        <template #header>
            Project List
        </template>

        <div class="w-full mb-4 flex">
            <a :href="route('projects.create')" class="text-center cursor-pointer border border-blue-600 text-white hover:bg-blue-700 bg-blue-600 rounded-md px-3 py-1.5">
                + Add New
            </a>
        </div>

        <DataTable :collections="projects" :filters="filters" :serialColumn="true">
            <template #head>
                <th class="py-3 px-2 text-left">ID</th>
                <th class="py-3 px-2 text-left">Nikname</th>
                <th class="py-3 px-2 text-left">Name</th>
                <th class="py-3 px-2 text-center">Active</th>
                <th class="py-3 px-2 text-center">Action</th>
            </template>
            <template #default="{item: project}">
                <td class="py-3 px-2 text-left">{{ project.id }}</td>
                <td class="py-3 px-2 text-left">{{ project.nikname }}</td>
                <td class="py-3 px-2 text-left">{{ project.name }}</td>
                <td class="py-3 px-2 text-center">
                    <span :class="project.active ? 'bg-green-600' : 'bg-red-600'" class="text-white rounded-full px-2 py-0.5">
                        {{ project.active ? 'Yes' : 'No' }}
                    </span>
                </td>
                <td class="py-2.5 px-2">
                    <div class="flex justify-center items-center gap-1 md:gap-2">
                        <ActionButtonShow :href="route('projects.show', project.id)" />
                        <ActionButtonEdit :href="route('projects.edit', project.id)" />
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
        projects: { type: Object, default: {} },
        filters: { type: Object, default: {} },
    },
};
</script>

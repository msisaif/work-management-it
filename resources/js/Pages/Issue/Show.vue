<template>
    <Head title="Issue" />

    <AppLayout>
        <template #header>
            {{ issue.name }}
        </template>

        <div class="w-full mb-4 flex">
            <a :href="route('issues.create')" class="text-center cursor-pointer border border-blue-600 text-white hover:bg-blue-700 bg-blue-600 rounded-md px-3 py-1.5">
                + Add New
            </a>
        </div>
        
        <div class="overflow-auto bg-white border">
            <table class="table-auto">
                <ShowTableRow heading="Issue No (ID)">{{ issue.id }}</ShowTableRow>

                <ShowTableRow heading="Project">{{ issue.projectName }}</ShowTableRow>

                <ShowTableRow heading="Work Type">{{ issue.workType }}</ShowTableRow>

                <ShowTableRow heading="Created By">{{ issue.userName }}</ShowTableRow>

                <ShowTableRow heading="Created Date">{{ issue.createdDate }}</ShowTableRow>

                <ShowTableRow heading="Title">{{ issue.title }}</ShowTableRow>

                <ShowTableRow heading="Body">
                    <div class="whitespace-pre-wrap">{{ issue.body }}</div>
                </ShowTableRow>

                <ShowTableRow heading="Active">
                    <span :class="issue.active ? 'bg-green-600' : 'bg-red-600'" class="text-white rounded-full px-2 py-0.5">
                        {{ issue.active ? 'Yes' : 'No' }}
                    </span>
                </ShowTableRow>

                <ShowTableRow heading="Action">
                    <div class="flex justify-start items-center gap-1 md:gap-2">
                        <ActionButtonEdit :href="route('issues.edit', issue.id)" />
                    </div>
                </ShowTableRow>
            </table>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/App.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import ShowTableRow from "@/Components/ShowTableRow.vue";
import ActionButtonEdit from "@/Components/ActionButtonEdit.vue";

export default {
    components: {
        AppLayout,
        Head,
        Link,
        ShowTableRow,
        ActionButtonEdit,
    },
    props: {
        issue: { type: Object, default: {} },
    },
};
</script>

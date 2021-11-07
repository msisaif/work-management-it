<template>
    <Head title="User" />

    <AppLayout>
        <template #header>
            {{ user.name }}
        </template>

        <div class="w-full mb-4 flex">
            <a :href="route('users.create')" class="text-center cursor-pointer border border-blue-600 text-white hover:bg-blue-700 bg-blue-600 rounded-md px-3 py-1.5">
                + Add New
            </a>
        </div>
        
        <div class="overflow-auto bg-white border">
            <table class="table-auto">
                <ShowTableRow heading="ID">{{ user.id }}</ShowTableRow>

                <ShowTableRow heading="Name">{{ user.name }}</ShowTableRow>

                <ShowTableRow heading="Email">{{ user.email }}</ShowTableRow>

                <ShowTableRow heading="Action">
                    <div class="flex justify-start items-center gap-1 md:gap-2">
                        <ActionButtonEdit :href="route('users.edit', user.id)" />
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
        user: { type: Object, default: {} },
    },
};
</script>

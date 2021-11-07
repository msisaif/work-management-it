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
                <tr class="bg-blue-600 text-sm leading-normal">
                    <th class="p-2 text-right bg-gray-200 uppercase">Issue No (ID)</th>
                    <td class="p-2 text-left bg-white">
                        {{ issue.id }}
                    </td>
                </tr>
                <tr class="bg-blue-600 text-sm leading-normal">
                    <th class="p-2 text-right bg-gray-200 uppercase">Project</th> 
                    <td class="p-2 text-left bg-white">
                        {{ issue.projectName }}
                    </td>
                </tr>
                <tr class="bg-blue-600 text-sm leading-normal">
                    <th class="p-2 text-right bg-gray-200 uppercase">Work Type</th> 
                    <td class="p-2 text-left bg-white">
                        {{ issue.workType }}
                    </td>
                </tr>
                <tr class="bg-blue-600 text-sm leading-normal">
                    <th class="p-2 text-right bg-gray-200 uppercase">Created By</th> 
                    <td class="p-2 text-left bg-white">
                        {{ issue.userName }}
                    </td>
                </tr>
                <tr class="bg-blue-600 text-sm leading-normal">
                    <th class="p-2 text-right bg-gray-200 uppercase">Created Date</th> 
                    <td class="p-2 text-left bg-white">
                        {{ issue.createdDate }}
                    </td>
                </tr>
                <tr class="bg-blue-600 text-sm leading-normal">
                    <th class="p-2 text-right bg-gray-200 uppercase">Title</th> 
                    <td class="p-2 text-left bg-white">
                        {{ issue.title }}
                    </td>
                </tr>
                <tr class="bg-blue-600 text-sm leading-normal">
                    <th class="p-2 text-right bg-gray-200 uppercase align-top">Body</th> 
                    <td class="p-2 text-left bg-white">
                        <div class="whitespace-pre-wrap">{{ issue.body }}</div>
                    </td>
                </tr>
                <tr class="bg-blue-600 text-sm leading-normal">
                    <th class="p-2 text-right bg-gray-200 uppercase">Active</th> 
                    <td class="p-2 text-left bg-white">
                        <span :class="issue.active ? 'bg-green-600' : 'bg-red-600'" class="text-white rounded-full px-2 py-0.5">
                            {{ issue.active ? 'Yes' : 'No' }}
                        </span>
                    </td>
                </tr>
                <tr class="bg-blue-600 text-sm leading-normal">
                    <th class="p-2 text-right bg-gray-200 uppercase">Action</th> 
                    <td class="p-2 text-left bg-white">
                        <div class="flex justify-start items-center gap-1 md:gap-2">
                            <Link :href="route('issues.edit', issue.id)" title="Edit" class="flex justify-center items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M17.414 2.586a2 2 0 00-2.828 0L7 10.172V13h2.828l7.586-7.586a2 2 0 000-2.828z" />
                                    <path fill-rule="evenodd" d="M2 6a2 2 0 012-2h4a1 1 0 010 2H4v10h10v-4a1 1 0 112 0v4a2 2 0 01-2 2H4a2 2 0 01-2-2V6z" clip-rule="evenodd" />
                                </svg>
                            </Link>
                        </div>
                    </td>
                </tr>
            </table>
        </div>
    </AppLayout>
</template>

<script>
import AppLayout from "@/Layouts/App.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";

export default {
    components: {
        AppLayout,
        Head,
        Link,
    },
    props: {
        issue: { type: Object, default: {} },
    },
};
</script>

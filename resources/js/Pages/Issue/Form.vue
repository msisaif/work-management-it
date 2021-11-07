<template>
    <div class="w-full max-w-md mx-auto p-4 bg-white border shadow rounded">

        <ValidationErrors class="mb-4" />

        <form @submit.prevent="submit" class="">
            <div class="mb-4">
                <Label for="project" value="Project" />
                <select id="project" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" v-model="form.project_id" required>
                    <option value="">-- Select Project --</option>
                    <option v-for="(project, index) in projects" :key="index" :value="project.id">{{ project.name }} ({{ project.nikname }})</option>
                </select>
            </div>

            <div class="mb-4">
                <Label for="type" value="Type" />
                <select id="type" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" v-model="form.type" required>
                    <option value="">-- Select Project --</option>
                    <option v-for="(workType, index) in workTypes" :key="index" :value="index">{{ workType }}</option>
                </select>
            </div>

            <div class="mb-4">
                <Label for="title" value="Title" />
                <Input id="title" type="text" class="mt-1 block w-full" v-model="form.title" required />
            </div>

            <div class="mb-4">
                <Label for="body" value="Body" />
                <textarea id="body" type="text" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" v-model="form.body" rows="8"></textarea>
            </div>

            <div class="mb-4">
                <Label for="active" value="active" />
                <select id="select" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" v-model="form.active" required>
                    <option value="1">Open</option>
                    <option value="0">Closed</option>
                </select>
            </div>

            <div class="flex items-center justify-end mt-4">
                <Button class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    {{ buttonValue }}
                </Button>
            </div>
        </form>
    </div>
</template>

<script>
import Button from '@/Components/Button.vue';
import Input from '@/Components/Input.vue';
import Label from '@/Components/Label.vue';
import ValidationErrors from '@/Components/ValidationErrors.vue';

export default {
    components: {
        Button,
        Input,
        Label,
        ValidationErrors,
    },

    props: {
        issue: { type: Object, default: {} },
        projects: { type: Object, default: {} },
        workTypes: { type: Object, default: {} },
        moduleAction: String,
        buttonValue: { type: String, default: 'Submit' },
    },

    data() {
        return {
            form: this.$inertia.form({
                active: this.moduleAction == 'store' ? 1 : this.issue.active,
                project_id: this.moduleAction == 'store' ? "" : this.issue.project_id,
                type: this.moduleAction == 'store' ? "" : this.issue.type,
                title: this.issue.title,
                body: this.issue.body,
            })
        }
    },

    methods: {
        submit() {
            if(this.moduleAction == 'store') {
                return this.form.post(this.route('issues.store'));
            }

            if(this.moduleAction == 'update') {
                return this.form.put(this.route('issues.update', this.issue.id));
            }
        }
    }
};
</script>

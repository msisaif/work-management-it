<template>
    <div class="w-full max-w-md mx-auto p-4 bg-white border shadow rounded">

        <ValidationErrors class="mb-4" />

        <form @submit.prevent="submit" class="">
            <div class="mb-4">
                <Label for="name" value="Name" />
                <Input id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus />
            </div>

            <div class="mb-4">
                <Label for="nikname" value="Nikname" />
                <Input id="nikname" type="text" class="mt-1 block w-full" v-model="form.nikname" required />
            </div>

            <div class="mb-4">
                <Label for="active" value="active" />
                <select id="select" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" v-model="form.active" required>
                    <option value="1">Yes</option>
                    <option value="0">No</option>
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
        project: { type: Object, default: {} },
        moduleAction: String,
        buttonValue: { type: String, default: 'Submit' },
    },

    data() {
        return {
            form: this.$inertia.form({
                name: this.project.name,
                nikname: this.project.nikname,
                active: this.moduleAction == 'store' ? 1 : this.project.active,
            })
        }
    },

    methods: {
        submit() {
            if(this.moduleAction == 'store') {
                return this.form.post(this.route('projects.store'));
            }

            if(this.moduleAction == 'update') {
                return this.form.put(this.route('projects.update', this.project.id));
            }
        }
    }
};
</script>

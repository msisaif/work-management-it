<template>
    <div class="w-full max-w-md mx-auto p-4 bg-white border shadow rounded">

        <ValidationErrors class="mb-4" />

        <form @submit.prevent="submit" class="">
            <div>
                <Label for="name" value="Name" />
                <Input id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <Label for="email" value="Email" />
                <Input id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autocomplete="username" />
            </div>

            <slot :user="user" />

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
        user: { type: Object, default: {} },
        moduleAction: String,
        buttonValue: { type: String, default: 'Submit' },
    },

    data() {
        return {
            form: this.$inertia.form({
                name: this.user.name,
                email: this.user.email,
            })
        }
    },

    methods: {
        submit() {
            if(this.moduleAction == 'store') {
                return this.form.post(this.route('users.store'));
            }

            if(this.moduleAction == 'update') {
                return this.form.put(this.route('users.update', this.user.id));
            }
        }
    }
};
</script>

<template>
    <Head title="User" />

    <AppLayout>
        <template #header>
            {{ user.name }}
        </template>
        
        <div class="w-full max-w-md mx-auto">
            <BreezeValidationErrors class="mb-4" />
        </div>

        <form @submit.prevent="submit" class="w-full max-w-md mx-auto p-4 bg-white border shadow rounded">
            <div>
                <BreezeLabel for="name" value="Name" />
                <BreezeInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <BreezeLabel for="email" value="Email" />
                <BreezeInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autocomplete="username" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <BreezeButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Submit
                </BreezeButton>
            </div>
        </form>
    </AppLayout>
</template>

<script>
import BreezeButton from '@/Components/Button.vue'
import BreezeInput from '@/Components/Input.vue'
import BreezeLabel from '@/Components/Label.vue'
import BreezeValidationErrors from '@/Components/ValidationErrors.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';
import AppLayout from "@/Layouts/App.vue";

export default {
    components: {
        BreezeButton,
        BreezeInput,
        BreezeLabel,
        BreezeValidationErrors,
        AppLayout,
        Head,
        Link,
    },

    props: {
        user: { type: Object, default: {} },
    },

    data() {
        return {
            form: this.$inertia.form({
                name: '',
                email: '',
            })
        }
    },

    methods: {
        submit() {
            this.form.post(this.route('users.store'), {
                // onFinish: () => this.form.reset('password', 'password_confirmation'),
            })
        }
    }
};
</script>

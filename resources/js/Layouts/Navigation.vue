<template>
    <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
        Dashboard
    </NavLink>
    <NavLink :href="route('users.index')" :active="route().current('users.*')">
        Users
    </NavLink>
</template>

<script>
import NavLink from '@/Components/NavLink.vue';
export default {
    components: {
        NavLink,
    },
}
</script>
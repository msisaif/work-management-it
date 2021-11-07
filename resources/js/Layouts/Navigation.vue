<template>
    <NavLink :href="route('dashboard')" :active="route().current('dashboard')">
        Dashboard
    </NavLink>
    <NavLink :href="route('users.index')" :active="route().current('users.*')">
        Users
    </NavLink>
    <NavLink :href="route('projects.index')" :active="route().current('projects.*')">
        Projects
    </NavLink>
    <NavLink :href="route('issues.index')" :active="route().current('issues.*')">
        Issues
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
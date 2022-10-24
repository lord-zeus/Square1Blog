<script setup>
import ApplicationLogo from '@/Components/ApplicationLogo.vue';
import { Link } from '@inertiajs/inertia-vue3';
</script>

<template>
    <div class="relative flex items-top justify-center  bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
        <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
            <a :href="route('login')" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>
            <a :href="route('register')" class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
        </div>
    </div>

    <div class="">
        <slot />
    </div>
</template>

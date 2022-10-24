<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import GuestLayout from '@/Layouts/GuestLayout.vue';
import VisitorLayout from '@/Layouts/VisitorLayout.vue';
import { Head } from '@inertiajs/inertia-vue3';
import PostsTable from "@/Components/PostsTable.vue"

defineProps({
    posts: Array,
    auth: Object
})

</script>

<template>
    <Head title="Dashboard" />

    <div v-if="auth.user && auth.user.id">
        <AuthenticatedLayout>
            <template #header>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Posts
                </h2>
                <h3 class="absolute right-10 top-20"><a  :href="route('createPost')"> Create Post</a></h3>
            </template>

            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <PostsTable :posts="posts.data"></PostsTable>
                        <div class="flex justify-center">
                            <nav aria-label="Page navigation example">
                                <ul class="flex list-style-none">
                                    <li class="page-item" :class="{'active hover:bg-blue-600 bg-blue-600': link.active === true}" v-for="link in posts.links"><a
                                        class="page-link relative block py-1.5 px-3 rounded border-0 bg-transparent outline-none transition-all duration-300 rounded text-gray-800 hover:text-gray-800 hover:bg-gray-200 focus:shadow-none"
                                        :href="link.url"><span v-html="link.label"></span></a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </AuthenticatedLayout>
    </div>
    <div v-else>
        <VisitorLayout>
            <template #header>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    Posts
                </h2>
            </template>

            <div class="py-12">
                <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                        <PostsTable :posts="posts.data"></PostsTable>
                        <div class="flex justify-center">
                            <nav aria-label="Page navigation example">
                                <ul class="flex list-style-none">
                                    <li class="page-item" :class="{'active hover:bg-blue-600 bg-blue-600': link.active === true}" v-for="link in posts.links"><a
                                        class="page-link relative block py-1.5 px-3 rounded border-0 bg-transparent outline-none transition-all duration-300 rounded text-gray-800 hover:text-gray-800 hover:bg-gray-200 focus:shadow-none"
                                        :href="link.url"><span v-html="link.label"></span></a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </VisitorLayout>
    </div>
</template>

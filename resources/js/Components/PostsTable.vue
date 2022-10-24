<script setup>


defineProps({
    posts: Array,
    new_post: Object,
    lastPage: String,
    nextPage: String,
    previousPage: String,
    auth: Object

})


function makeDate(value){
    return new Date(value).toDateString()
}
</script>

<template>
    <div>
        <div class="m-4 lg:flex lg:flex-wrap">
            <div v-if="new_post" class="p-4 md:w-1/3">
                <div class="p-8 bg-white rounded shadow-md">
                    <h2 class="text-2xl font-bold text-gray-800">{{ new_post.title.slice(0, 20) }}</h2>
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-500">{{makeDate(new_post.published_at) }}</span>
                        <span class="inline-flex text-gray-500"><svg xmlns="http://www.w3.org/2000/svg"
                                                                     class="w-6 h-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>{{ auth.user.name}}</span>
                    </div>
                    <p class="text-justify text-gray-600">{{ new_post.description.slice(0, 100)+'...'}}</p>
                    <div class="flex items-center mt-4">
                        <a
                            class="inline-flex items-center px-4 py-2 text-indigo-800 bg-indigo-200 cursor-pointer md:mb-2 lg:mb-0">Read
                            More
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mt-1" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
            <div v-for="post in posts" class="p-4 md:w-1/3">
                <div class="p-8 bg-white rounded shadow-md">
                    <h2 class="text-2xl font-bold text-gray-800">{{ post.title.slice(0, 20) }}</h2>
                    <div class="flex justify-between">
                        <span class="text-sm text-gray-500">{{makeDate(post.created_at) }}</span>
                        <span class="inline-flex text-gray-500"><svg xmlns="http://www.w3.org/2000/svg"
                                                                     class="w-6 h-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>{{ post.user.name}}</span>
                    </div>
                    <p class="text-justify text-gray-600">{{ post.description.slice(0, 100)+'...'}}</p>
                    <div class="flex items-center mt-4">
                        <a
                            class="inline-flex items-center px-4 py-2 text-indigo-800 bg-indigo-200 cursor-pointer md:mb-2 lg:mb-0">Read
                            More
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mt-1" fill="none"
                                 viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M13 7l5 5m0 0l-5 5m5-5H6" />
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

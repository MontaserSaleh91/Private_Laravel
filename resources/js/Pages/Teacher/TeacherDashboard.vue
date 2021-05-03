<template>
    <breeze-authenticated-layout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                My Classes
            </h2>
        </template>
        <breeze-button class="ml-20">
            <inertia-link :href="`/room/create/`"
                >Create New Class</inertia-link
            >
        </breeze-button>
        <breeze-button class="ml-20">
            <inertia-link :href="`/teacher/classes/`"
                >My Classes</inertia-link
            >
        </breeze-button>

        <div class="py-12">
            <div class="container my-12 mx-auto px-4 md:px-12">
                <div class="flex flex-wrap -mx-1 lg:-mx-4">
                    <div
                        class="my-1 px-1 w-full md:w-1/2 lg:my-4 lg:px-4 lg:w-1/3"
                        v-for="room in rooms"
                        :key="room.id"
                    >
                        <article class="overflow-hidden rounded-lg shadow-lg">
                            <header
                                class="flex items-center justify-between leading-tight p-2 md:p-4"
                            >
                                <h1 class="text-lg">
                                    <inertia-link
                                        class="no-underline hover:underline text-black"
                                        :href="`/room/${room.id}`"
                                    >
                                        {{ room.name }}
                                    </inertia-link>
                                    <p>{{ room.description }}</p>
                                </h1>
                            </header>
                        </article>
                    </div>
                </div>
            </div>
        </div>
    </breeze-authenticated-layout>
</template>

<script>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated";
import BreezeButton from "@/Components/Button";

export default {
    components: {
        BreezeAuthenticatedLayout,
        BreezeButton,
    },

    props: {
        rooms: Object,
        auth: Object,
        errors: Object,
    },
};
</script>

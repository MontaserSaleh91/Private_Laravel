<template>
  <breeze-authenticated-layout>
          <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{room.name}}
            </h2>
        </template>
        <div v-if="$page.props.auth.user.role == 3">

            <breeze-button class=" ml-20">
                <inertia-link :href="`/admin/room/students/${room.id}`">show Students</inertia-link>
            </breeze-button>

        </div>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


        <div class="p-5 bg-blue-100" v-for="less in room.lessons" :key="less.id">
            <inertia-link :href="`/admin/lesson/${less.id}`">
                <div class="bg-white p-6 rounded-lg shadow-lg">
                    <h2 class="text-2xl font-bold mb-2 text-gray-800">{{ less.title }}</h2>
                </div>
            </inertia-link>
        </div>

    </div>
    </div>
  </breeze-authenticated-layout>
</template>

<script>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated"
import BreezeButton from '@/Components/Button'


export default {
  components: {
    BreezeAuthenticatedLayout,
    BreezeButton,

  },

  props: {
    room: Object,
    auth: Object,
    errors: Object,
  },

};
</script>

<template>
  <breeze-authenticated-layout>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <h1 class=" font-bold text-xl text-center">{{ lesson.title }}</h1>
            <p>{{ lesson.content }}</p>
            <p>

            <breeze-button class="mt-20 center">
                <inertia-link :href="`/lesson/download/${lesson.id}`">download Attachment</inertia-link>
            </breeze-button>

            </p>

        </div>

    </div>
  </breeze-authenticated-layout>
</template>

<script>
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated";
import BreezeButton from '@/Components/Button'


export default {
  components: {
    BreezeAuthenticatedLayout,
    BreezeButton
  },

  props: {
    lesson: Object,
    auth: Object,
    errors: Object,
  },
};
</script>

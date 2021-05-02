<template>
  <breeze-authenticated-layout>
          <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                All Users
            </h2>
        </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


        <!-- <div class="p-5 bg-blue-100" v-for="less in room.lessons" :key="less.id"> -->
            <table class="table-fixed bg-blue-200">
            <thead>
                <tr>
                <th class="w-1/6 ...">Name</th>
                <th class="w-1/6 ...">email</th>
                <th class="w-1/6 ...">phone</th>
                <th class="w-1/6 ...">role type</th>
                </tr>
            </thead>
            <tbody>

                <tr v-for="user in users" :key="user.id">
                <td><inertia-link :href="`/student/profile/${user.id}`"> {{user.name}}</inertia-link></td>
                <td>{{user.email}}</td>
                <td>{{user.phone}}</td>
                <td v-if="user.role == 0">Student</td>
                <td v-if="user.role == 1">Teacher</td>
                <td v-if="user.role == 3">Admin</td>

                </tr>
            </tbody>
            </table>
        <!-- </div> -->

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
    users: Object,
    auth: Object,
    errors: Object,
  },
};
</script>

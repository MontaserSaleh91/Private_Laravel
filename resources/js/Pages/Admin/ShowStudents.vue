<template>
  <breeze-authenticated-layout>
          <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
               Class {{room.name}} Students
            </h2>
        </template>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


        <!-- <div class="p-5 bg-blue-100" v-for="less in room.lessons" :key="less.id"> -->
            <table class="table-fixed bg-blue-200">
            <thead>
                <tr>
                <th class="w-1/4 ...">Student Name</th>
                <th class="w-1/6 ...">First Mark</th>
                <th class="w-1/6 ...">Mid Mark</th>
                <th class="w-1/6 ...">Final Mark</th>
                </tr>
            </thead>
            <tbody>

                <tr v-for="std in room.students" :key="std.id">
                <td><inertia-link :href="`/student/profile/${std.id}`"> {{std.name}}</inertia-link></td>
                <td>{{std.mark.first}}</td>
                <td>{{std.mark.mid}}</td>
                <td>{{std.mark.final}}</td>

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
import { Inertia } from '@inertiajs/inertia'


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

   data() {
            return {
                form:{
                    student_id: '',
                }
            }
        },


        methods: {
            submit() {
                Inertia.post('/student/room/' + this.room.id , this.form)
            }
        }
};
</script>

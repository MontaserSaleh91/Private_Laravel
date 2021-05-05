<template>
  <breeze-authenticated-layout>
          <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
               Class {{room.name}} Students
            </h2>
        </template>
            <breeze-button class=" ml-20">
                <inertia-link :href="`/mark/create/${room.id}`">Add Marks</inertia-link>
            </breeze-button>
            <form @submit.prevent="submit">
            <select id="student_id" v-model="form.student_id">
                <option disabled value="">Please select Student</option>
                <option v-for="student in all_students" :key="student.id" :value="student.id">{{student.name}}</option>
            </select>
        <breeze-button class="m-5" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                ADD
        </breeze-button>
        </form>
    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">


        <!-- <div class="p-5 bg-blue-100" v-for="less in room.lessons" :key="less.id"> -->
            <table class="table-fixed bg-blue-200 w-full text-center">
            <thead>
                <tr>
                <th class="w-1/3 ...">Student Name</th>
                <th>First Mark</th>
                <th>Mid Mark</th>
                <th>Final Mark</th>
                <th>action</th>
                </tr>
            </thead>
            <tbody>

                <tr v-for="std in room.students" :key="std.id">
                <td><inertia-link :href="`/student/profile/${std.id}`"> {{std.name}}</inertia-link></td>
                <td v-if="std.mark.first != null">{{std.mark.first}}</td>
                <td v-if="std.mark.mid != null">{{std.mark.mid}}</td>
                <td v-if="std.mark.final != null">{{std.mark.final}}</td>

                <td v-if="std.mark.first == null">_</td>
                <td v-if="std.mark.mid == null">_</td>
                <td v-if="std.mark.final == null">_</td>
                <td v-if="std.mark.first != null || std.mark.first != mid || std.mark.final != null">
                    <breeze-button class=" ml-20">
                        <inertia-link :href="`/edit/mark/${room.id}/${std.id}`"> Edit Marks</inertia-link>
                    </breeze-button>
                </td>
                </tr>
            </tbody>
            </table>
        <!-- </div> -->

    </div>
    </div>
  </breeze-authenticated-layout>
</template>

<script>
import { useForm } from '@inertiajs/inertia-vue3'
import { reactive } from 'vue'
import { Inertia } from '@inertiajs/inertia'
import BreezeAuthenticatedLayout from "@/Layouts/Authenticated"
import BreezeButton from '@/Components/Button'



export default {
  components: {
    BreezeAuthenticatedLayout,
    BreezeButton,

  },

  props: {
    room: Object,
    all_students:Object,
    auth: Object,
    errors: Object,
  },

    setup (props) {
    const form = reactive({
      student_id: '',
    })

    //   setup (props) {
    // const form = useForm({
    //     student_id: '',
    // })

    function submit() {
      Inertia.post('/student/room/' + props.room.id , form)
    }
    Inertia.reload({ only: ['room'] })

    return { form, submit }
  },

//    data() {
//             return {
//                 form:{
//                     student_id: '',
//                 }
//             }
//         },


//         methods: {

//             submit() {
//                 Inertia.post('/student/room/' + this.room.id , this.form)
//             }
//         },



};
</script>

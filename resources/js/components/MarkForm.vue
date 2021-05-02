<template>
    <div class="container">
    <form @submit.prevent="submit">
        <div>
            <breeze-label for="first" value="first" />
            <breeze-input id="first" type="text" v-model="form.student.name" class="mt-1 block w-full"  autofocus autocomplete="first" />
        </div>

        <div>
            <breeze-label for="mid" value="mid" />
            <breeze-input id="mid" type="text" class="mt-1 block w-full"  autofocus autocomplete="mid" />
        </div>

        <div>

            <breeze-label for="final" value="final" />
            <breeze-input id="final"  type="text" class="mt-1 block w-full"  autofocus autocomplete="final" />
        </div>


        <div>

            <!-- <breeze-label for="student name" value="student name" />
            <select v-model="form.student_id">
            <option disabled value="">Please select student</option>
            <option v-for="student in room.students" :key="student.id" :value="student.id">{{student.name}}</option>
            </select> -->
        </div>



    </form>
    </div>
</template>

<script>

    import BreezeButton from '@/Components/Button'
    import BreezeInput from '@/Components/Input'
    import BreezeLabel from '@/Components/Label'
    import BreezeValidationErrors from '@/Components/ValidationErrors'
    export default {


         components: {
            BreezeButton,
            BreezeInput,
            BreezeLabel,
            BreezeValidationErrors,

        },

        props: {
            room: Object,
            student: Object,
            auth: Object,
            errors: Object,
        },


        mounted() {
            console.log('Component mounted.')
        }
    }
</script>

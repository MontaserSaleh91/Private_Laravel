<template>
    <div class="px-66 m-10 py-4">
            <breeze-validation-errors class="mb-4" />

            <h2>Add marks </h2>

    <form @submit.prevent="submit">
        <div>
            <breeze-label for="first" value="first" />
            <breeze-input id="first" type="text" class="mt-1 block w-full" v-model="form.first" :value="student.mark.first" autofocus autocomplete="first" />
        </div>

        <div>
            <breeze-label for="mid" value="mid" />
            <breeze-input id="mid" type="text" class="mt-1 block w-full" v-model="form.mid" :value="student.mark.mid" autofocus autocomplete="mid" />
        </div>

        <div>
            <breeze-label for="final" value="final" />
            <breeze-input id="final" type="text" class="mt-1 block w-full" v-model="form.final" :value="student.mark.final" autofocus autocomplete="final" />
        </div>



        <breeze-button class="m-5" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Update
        </breeze-button>
    </form>
    </div>
</template>

<script>
    import BreezeButton from '@/Components/Button'
    import BreezeAuthenticatedLayout from '@/Layouts/Authenticated'
    import BreezeInput from '@/Components/Input'
    import BreezeLabel from '@/Components/Label'
    import BreezeValidationErrors from '@/Components/ValidationErrors'


    export default {
        layout: BreezeAuthenticatedLayout,

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

        data() {
            return {
                form: this.$inertia.form({
                    first: '',
                    mid: '',
                    final: '',
                })
            }
        },


        methods: {
            submit() {
                this.form.post('/edit/mark/' + this.room.id)
            }
        }
    }
</script>

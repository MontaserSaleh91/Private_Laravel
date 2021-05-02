<template>
    <div class="px-66 m-10 py-4">
            <breeze-validation-errors class="mb-4" />

            <h2>Add new lesson to </h2>

    <form @submit.prevent="submit">
        <div>
            <breeze-label for="title" value="Title" />
            <breeze-input id="title" type="text" class="mt-1 block w-full" v-model="form.title" required autofocus autocomplete="title" />
        </div>

        <div>
            <breeze-label for="content" value="Content" />
            <textarea id="content" rows="10" class="mt-1 block w-full" cols="" v-model="form.content" required autofocus autocomplete="content"></textarea>
        </div>

        <div>
            <input type="file" @input="form.file = $event.target.files[0]" />
        </div>

        <!-- <div>

            <select v-model="form.room_id">
            <option disabled value="">Please select Class</option>
            <option v-for="room in rooms" :key="room.id" :value="room.id">{{room.name}}</option>
            </select>

        </div> -->



        <breeze-button class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Create
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
            auth: Object,
            errors: Object,
        },

        data() {
            return {
                form: this.$inertia.form({
                    title: '',
                    content: '',
                    file: '',
                })
            }
        },


        methods: {
            submit() {
                this.form.post('/lesson/create/' + this.room.id)
            }
        }
    }
</script>

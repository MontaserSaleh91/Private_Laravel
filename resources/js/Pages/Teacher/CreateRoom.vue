<template>
    <breeze-validation-errors class="mb-4" />

    <form @submit.prevent="submit">
        <div>
            <breeze-label for="name" value="Name" />
            <breeze-input id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus autocomplete="name" />
        </div>

        <div>
            <breeze-label for="description" value="description" />
            <breeze-input id="description" type="text" class="mt-1 block w-full" v-model="form.description" required autofocus autocomplete="description" />
        </div>

        <breeze-button class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                Create
        </breeze-button>
    </form>
</template>

<script>
    import BreezeButton from '@/Components/Button'
    import BreezeGuestLayout from '@/Layouts/Guest'
    import BreezeInput from '@/Components/Input'
    import BreezeLabel from '@/Components/Label'
    import BreezeValidationErrors from '@/Components/ValidationErrors'


    export default {
        layout: BreezeGuestLayout,

        components: {
            BreezeButton,
            BreezeInput,
            BreezeLabel,
            BreezeValidationErrors,

        },

        props: {
            auth: Object,
            errors: Object,
        },

        data() {
            return {
                form: this.$inertia.form({
                    name: '',
                    description: '',
                })
            }
        },

        methods: {
            submit() {
                this.form.post(this.route('room.store'))
            }
        }
    }
</script>

<script setup>
import { Link, useForm } from '@inertiajs/inertia-vue3'
import { UserIcon, MailIcon, LockClosedIcon, UserAddIcon } from '@heroicons/vue/outline'
import GuestLayout from '@/Layouts/Guest.vue'
import InputIconWrapper from '@/Components/InputIconWrapper.vue'
import Input from '@/Components/Input.vue'
import Label from '@/Components/Label.vue'
import ValidationErrors from '@/Components/ValidationErrors.vue'
import Button from '@/Components/Button.vue'

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
    userType: '',
    terms: false,
})

const submit = () => {
    form.post(route('register'), {

        onFinish: () => form.reset('password', 'password_confirmation'),

        data: {
            userType: form.userType,
        },
    });
    console.log(form.userType);
}
</script>

<template>
    <GuestLayout title="Register">
        <ValidationErrors class="mb-4" />

        <form @submit.prevent="submit">
            <div class="grid gap-6">
                <div class="space-y-2">
                    <Label for="name" value="Name" />
                    <InputIconWrapper>
                        <template #icon>
                            <UserIcon aria-hidden="true" class="w-5 h-5" />
                        </template>
                        <Input withIcon id="name" type="text" placeholder="Name" class="block w-full" v-model="form.name" required autofocus autocomplete="name" />
                    </InputIconWrapper>
                </div>

                <div class="space-y-2">
                    <Label for="email" value="Email" />
                    <InputIconWrapper>
                        <template #icon>
                            <MailIcon aria-hidden="true" class="w-5 h-5" />
                        </template>
                        <Input withIcon id="email" type="email" class="block w-full" placeholder="Email" v-model="form.email" required autocomplete="username" />
                    </InputIconWrapper>
                </div>


                <div class="space-y-2">
                    <Label for="userType" value="User Function" />
                    <select @input="form.userType = $event.target.value" id="userType" v-model="form.userType" class="block w-full py-2 border-gray-400 rounded-md focus:border-gray-400 focus:ring focus:ring-blue-1 focus:ring-offset-2 focus:ring-offset-white dark:border-gray-600 dark:bg-dark-eval-1 dark:text-gray-300 dark:focus:ring-offset-dark-eval-1">
                        <option value="company">Company</option>
                        <option value="developer">Developer</option>
                        <option value="designer">Designer</option>
                    </select>

                </div>

                <div class="space-y-2">
                    <Label for="password" value="Password" />
                    <InputIconWrapper>
                        <template #icon>
                            <LockClosedIcon aria-hidden="true" class="w-5 h-5" />
                        </template>
                        <Input withIcon id="password" type="password" class="block w-full" placeholder="Password" v-model="form.password" required autocomplete="new-password" />
                    </InputIconWrapper>
                </div>

                <div class="space-y-2">
                    <Label for="password_confirmation" value="Confirm Password" />
                    <InputIconWrapper>
                        <template #icon>
                            <LockClosedIcon aria-hidden="true" class="w-5 h-5" />
                        </template>
                        <Input withIcon id="password_confirmation" type="password" class="block w-full" placeholder="Confirm Password" v-model="form.password_confirmation" required autocomplete="new-password" />
                    </InputIconWrapper>
                </div>

                <div>
                    <Button class="justify-center gap-2 w-full" :disabled="form.processing" v-slot="{ iconSizeClasses }">
                        <UserAddIcon aria-hidden="true" :class="iconSizeClasses" />
                        <span>Register</span>
                    </Button>
                </div>

                <p class="text-sm text-gray-600 dark:text-gray-400">
                    Already have an account?
                    <Link :href="route('login')" class="text-blue-500 hover:underline">
                        Login
                    </Link>
                </p>
            </div>

        </form>
    </GuestLayout>
</template>

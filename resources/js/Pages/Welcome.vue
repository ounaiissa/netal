
<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3'
import { Link as InertiaLink } from '@inertiajs/inertia-vue3';
import PageFooter from '@/Components/PageFooter.vue'

components: {
  InertiaLink
}
defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
})


</script>

<template>
     <!-- <inertia-link :href="route('chat')" class="text-sm text-gray-700 underline">
  chat here
</inertia-link> -->

    <Head title="Welcome" />



<div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-dark-eval-0 dark:text-gray-200 sm:items-center sm:pt-0">

    <div class="main-container-1">
        <!-- navbar -->
        <div class="hidden w-full md:block md:w-auto" id="navbar-default">
            <div v-if="canLogin" class="hidden fixed top-0 right-0 px-6 py-4 sm:block  ">


                <Link v-if="$page.props.auth.user" href="/dashboard" class="text-sm common-btn ">
                    Dashboard
                </Link>


                <template v-else>
                    <div class="flex">
                        <div class="logo">
                            <img src="" alt="">
                            <span>Logo here</span>
                        </div>
                        <div class="flex gap-1">

                                <Link  href="/" class="text-sm common-span ">
                                    Home
                                </Link>
                                <Link  href="/" class="text-sm common-span ">
                                    About
                                </Link>
                                <Link  href="/" class="text-sm common-span ">
                                    Job Board
                                </Link>
                                <Link  href="/" class="text-sm common-span ">
                                    Talents
                                </Link>

                                <Link :href="route('login')" class="text-sm common-btn ">
                                    Log in
                                </Link>

                                <Link v-if="canRegister" :href="route('register')" class="ml-4 text-sm common-btn ">
                                    Register
                                </Link>
                        </div>
                    </div>


                </template>

            </div>

        </div>

        <div class="main-content">
            <!-- <h1>here</h1> -->
        </div>
    </div>



</div>

    <PageFooter />
</template>

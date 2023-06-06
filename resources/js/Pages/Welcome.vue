
<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3'
import { Link as InertiaLink } from '@inertiajs/inertia-vue3';
import PageFooter from '@/Components/PageFooter.vue'
// import { useVuetify } from 'vuetify';
// import 'vuetify/dist/vuetify.min.css';

// const vuetify = useVuetify()

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

<style scoped>
.slide-animation {
  animation: slide 10s infinite;
}

@keyframes slide {
  0% {
    background-image: url("https://s3-alpha-sig.figma.com/img/e727/bfc0/9822cee7c94a7891a98177f6e1317e40?Expires=1685923200&Signature=LzHwZAoGAxm7J9KgF5BbseT8M~AJdPKWghaenZkpgemV0RdY4Srh21A7opWTXttN~eYcp9cflNxPbpvDlraU1zg5MohyUHvF3ZxNpgJFDPpgnbPBgk7es~umTqohyJfYNhSxzQji5NRXQNqT1qncmApFMNVklqfv14T5JXFA7DECnRLI1cNWolLqJBhpObAcBsPEaIDxNKTA4Unk4ciInanVFm4oKbohaotcwZKU9YWLN61hf56ZYL7lEACmkrHwlTZc0syjm8sqko1M2uaUBYivNIwVa~DZeocLa3hoqMxUQHSvng0jbqtX4GzAmBauxyeWDLxbi-jLpXDSL6jH7A__&Key-Pair-Id=APKAQ4GOSFWCVNEHN3O4");

  }
  25% {
    background-image: url("https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80");

  }
  50% {
    background-image: url("https://images.unsplash.com/photo-1522202801620-eb6f71f5bf05?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=870&q=80");
  }
  75% {
    background-image: url("https://images.unsplash.com/photo-1528901166007-3784c7dd3653?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=870&q=80");
  }
  100% {
    background-image: url("https://images.unsplash.com/photo-1519074002996-a69e7ac46a42?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=870&q=80");
  }
}
</style>


<template>
     <!-- <inertia-link :href="route('chat')" class="text-sm text-gray-700 underline">
  chat here
</inertia-link> -->

    <Head title="Welcome" />



<div class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-dark-eval-0 dark:text-gray-200 sm:items-center sm:pt-0">

    <div class="main-container-1 slide-animation">
        <!-- navbar -->
        <div class="logo mt-5 ml-4">
                            <img src="" alt="">
                            <span>Logo here</span>
                        </div>
        <div class="hidden w-full md:block md:w-auto " id="navbar-default">
            <div v-if="canLogin" class="hidden fixed top-0 right-0 px-6 py-4 sm:block  ">



                <Link v-if="$page.props.auth.user" href="/dashboard" class="text-sm common-btn ">
                    Dashboard
                </Link>


                <template v-else>
                    <div >

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
            <h1 class="ml-10 mt-[200px]">Connect, Collaborate, and Showcase Your Skills</h1>
            <p class="ml-20 text-justify text-white">
                Join our community of designers and developers and take your career to new heights.
            </p>
            <button class="mt-10 ml-10 common-btn">Get started</button>
        </div>

    </div>




</div>



    <PageFooter />
</template>

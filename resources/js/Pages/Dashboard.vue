

<template>

    <AuthenticatedLayout title="Dashboard">
        <template #header>
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <h2 class="text-xl font-semibold leading-tight">
                    Dashboard
                </h2>
                <!-- <div>{{ auth.user.userType }}</div> -->
                <!-- <div>{{ getUserType() }}</div> -->


            </div>
        </template>

        <div class="p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
            You're logged in!
        </div>
    </AuthenticatedLayout>
</template>
<script setup>
import { usePage } from '@inertiajs/inertia-vue3'
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'



const { props } = usePage()
const { auth } = props
// const isUserType = (userType) => {
//     console.log(form.userType);
// //   return auth.user && auth.user.userType === userType
// }
</script>

<script>
import { usePage } from '@inertiajs/inertia-vue3'

const { props } = usePage()
const { auth } = props
export default {
  props: {
    auth: {
      type: Object,
      required: true
    }
  },
  setup(props) {
    const { auth } = props

    // Do any additional setup or logic here

    const getUserType = () => {
      if (auth && auth.user) {
        return auth.user.userType;
      }
      return '';
    }

    return {
      getUserType
    }
  }
}

</script>

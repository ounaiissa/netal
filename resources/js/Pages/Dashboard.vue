
<template>

    <AuthenticatedLayout title="Dashboard">
        <template #header>
            <div class="flex flex-col gap-4 md:flex-row md:items-center md:justify-between">
                <!-- <h2 class="text-xl font-semibold leading-tight">
                    Dashboard
                </h2> -->



            </div>
        </template>


        <div v-if="this.auth.user.userType === 'designer'|| this.auth.user.userType === 'developer'" class="py-4">
            <p>Current user type: {{ this.auth.user.userType }}</p>
            <div class=" p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
                <h1 class="title-blue py-2">Overview</h1>
                <p class="pb-3">Welcome back, your progress is really good. keep it up!</p>

                <div class="grid">

                        <v-card class="w-[280px] h-[230px] d-flex align-center justify-center" text="" variant="outlined" style="border-color: #1B73F8;">
                            <a :href="route('portfolio')" class="title-blue-md">ADD PROJECT</a>
                            <v-icon color="#1B73F8">mdi-plus</v-icon>

                        </v-card>

                         <!-- Display portfolios in v-cards -->
                        <!-- <div v-for="portfolio in portfolios" :key="portfolio.id">
                            <v-card class="portfolio-card">
                            <img :src="portfolio.image" alt="Uploaded Image" />
                            <div class="portfolio-details" v-if="showName === portfolio.id">
                                <h3>{{ portfolio.title }}</h3>
                                <p>{{ portfolio.description }}</p>
                                <a :href="portfolio.link" class="portfolio-link">View Project</a>
                            </div>
                            </v-card>
                        </div> -->

                        <div v-if="portfolios.length > 0">
                <div v-for="portfolio in portfolios" :key="portfolio.id">
                    <h3>{{ portfolio.title }}</h3>
                    <p>{{ portfolio.description }}</p>
                    <div v-if="portfolio.images.length > 0">
                    <ul>
                        <li v-for="image in portfolio.images" :key="image.id">
                        <img :src="image.fullImagePath" alt="Portfolio Image" />
                        </li>
                    </ul>
                    </div>
                </div>
                </div>
                <div v-else>
                <p>No portfolios found.</p>
                </div>

                </div>

            </div>

        </div>

        <!-- here dashboard company -->

        <div v-else-if="this.auth.user.userType === 'company'">
            <h1>heey you're a company</h1>
        </div>
    </AuthenticatedLayout>
</template>




<style scoped>
.v-card--outlined {
  border-color: #1B73F8;
}
</style>



<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'



</script>

<script>
// import { usePage } from '@inertiajs/inertia-vue3'
// import { reactive, onMounted } from 'vue'
import axios from 'axios';


export default {

  props: {
    auth: {
      type: Object,
      required: true
    },

  },
  data() {
  return {
    userType: '',
    files: [],
    imageData: localStorage.getItem('uploadedImage'),
    portfolios: [],
  };
},
mounted() {
    axios.get('/api/users')
      .then(response => {
        const currentUser =  this.auth.user.id;
        console.log(this.auth.user.userType);
        if (currentUser) {
          this.userType = currentUser.userType;
        }
      })
      .catch(error => {
        console.log(error);
      });

    axios.get('/api/portfolios')
        .then(response => {
            console.log(response.data);
            this.portfolios = response.data.title.map((title, index) => ({
                // title,
                // description: response.data.description[index],
                title: Object.values(title).join(" "),
                description: Object.values(response.data.description[index]).join(" "),
                images: [{ fullImagePath: `/portfolioImages/${response.data.imagesPath[index].path.split('/').pop()}` }],
            }));


        })
        .catch(error => {
            console.log(error);
        });


  }
}


</script>

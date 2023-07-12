<template>
    <AuthenticatedLayout>
        <div v-if="portfolios.length > 0" class="portfolio grid grid-cols-3 gap-2 my-7">

                          <div v-for="portfolio in portfolios" :key="portfolio.id">
                            <v-card  class="portfolio-card  d-flex align-center justify-center" text="" variant="outlined" style="border-color: #1B73F8;">
                              <!-- <h3>{{ portfolio.title }}</h3>
                              <p>{{ portfolio.description }}</p>
                              <h1>{{portfolio.id }}</h1> -->
                              <div  class="portfolio-detail hidden">
                                <v-btn @click="openModal(portfolio)">View</v-btn>

                              </div>
                              <div v-if="portfolio.images.length > 0">
                              <ul>
                                  <li v-for="image in portfolio.images" :key="image.id">
                                  <img :src="image.fullImagePath" alt="Portfolio Image" class="w-fit h-fit m-0 p-0" />
                                  </li>
                              </ul>
                              </div>
                            </v-card>
                          </div>
                        </div>
                        <div v-else>
                            <p>No portfolios found.</p>
                        </div>


          <!-- Modal component -->
  <div v-if="selectedPortfolio" class="fixed inset-0 flex items-center justify-center z-50">
    <div class="absolute inset-0 bg-gray-900 opacity-50"></div>
    <div class="relative bg-white p-11">
      <h3>{{ selectedPortfolio.title }}</h3>
      <p>{{ selectedPortfolio.description }}</p>
      <p>Created by: <b>{{ selectedPortfolio.user_name }}</b></p>
      <div v-if="selectedPortfolio.images.length > 0">
        <ul>
          <li v-for="image in selectedPortfolio.images" :key="image.id">
            <img :src="image.fullImagePath" alt="Portfolio Image" class="w-fit h-fit m-0 p-0" />
          </li>
        </ul>
      </div>
      <v-btn @click="closeModal">Close</v-btn>
    </div>
  </div>
    </AuthenticatedLayout>
</template>

<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'
</script>

<script>
import { ref } from 'vue'
import axios from 'axios'
const users = ref([])

export default {

props: {
  auth: {
    type: Object,
    required: true,
  },

},
data() {
return {
  files: [],
  imageData: localStorage.getItem('uploadedImage'),
  portfolios: [],
  selectedPortfolio: null,
    imageFiles: [],
    newImages: [],


};
},
methods: {
  openModal(portfolio) {
    this.selectedPortfolio = portfolio;
  },
  closeModal() {
    this.selectedPortfolio = null;
  },


},
mounted() {
//   axios.get('/api/portfolios')
//       .then(response => {
//           console.log(response.data);
//           this.portfolios = response.data.title.map((title, index) => ({
//               id: Object.values(response.data.id[index]).join(" "),
//               title: Object.values(title).join(" "),
//               description: Object.values(response.data.description[index]).join(" "),
//               images: [{ fullImagePath: `/portfolioImages/${response.data.imagesPath[index].path.split('/').pop()}` }],
//               user_id: Object.values(response.data.user_id).join(" "),
//               user_name: response.data.user_name[index] ? response.data.user_name[index].name : '',
//             //   user_name: response.data.user_name[index]?.name,
//            // user_name: Object.values(response.data.user_name).find(user => user.id === response.data.user_id),
//         //    user_name: response.data.user_name[index] ? response.data.user_name[index].name : null


//         //    user_name: user ? user.name : null


//           }));



//       })
//       .catch(error => {
//           console.log(error);
//       });


  axios.get('/api/portfolios')
    .then(response => {
      console.log(response.data);
      // Process the response data here
      this.portfolios = response.data.map(portfolio => ({
        id: portfolio.id,
        title: portfolio.title,
        description: portfolio.description,
        images: portfolio.imagesPath.map(path => ({ fullImagePath: `/portfolioImages/${path.split('/').pop()}` })),
        user_id: portfolio.user_id,
        user_name: portfolio.user_name,
      }));
    })
    .catch(error => {
      console.log(error);
    });



      axios.get('/api/users')
        .then(response => {
            users.value = response.data;
        //    console.log('users api: ', users.value);
        })
        .catch(error => {
          console.log(error);
        });

}





// mounted() {
//   axios.get('/api/portfolios')
//     .then(response => {
//       console.log(response.data);
//       const portfolios = response.data;
//       const userIds = portfolios.user_id.map(user => user.user_id);

//       axios.get('/api/users')
//         .then(response => {
//           const users = response.data;
//           const userNameMap = {};

//           for (const user of users) {
//             userNameMap[user.id] = user.name;
//           }

//           this.portfolios = portfolios.title.map((title, index) => ({
//             id: portfolios.id[index].id,
//             title: title.title,
//             description: portfolios.description[index].description,
//             images: [{ fullImagePath: `/portfolioImages/${portfolios.imagesPath[index].path.split('/').pop()}` }],
//             user_id: portfolios.user_id[index].user_id,
//             user_name: userNameMap[portfolios.user_id[index].user_id] || null
//           }));
//         })
//         .catch(error => {
//           console.log(error);
//         });
//     })
//     .catch(error => {
//       console.log(error);
//     });
// }







}


</script>


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

                <div class="">

                        <!-- <v-card class="w-[280px] h-[230px] d-flex align-center justify-center" text="" variant="outlined" style="border-color: #1B73F8;">
                            <a :href="route('portfolio')" class="title-blue-md">ADD PROJECT</a>
                            <v-icon color="#1B73F8">mdi-plus</v-icon>

                        </v-card> -->

                         <!-- Display portfolios in v-cards -->


                          <div v-if="portfolios.length > 0" class="grid grid-cols-3 gap-2">
                            <v-card class="w-[340px] h-[260px] d-flex align-center justify-center" text="" variant="outlined" style="border-color: #1B73F8;">
                            <a :href="route('portfolio')" class="title-blue-md">ADD PROJECT</a>
                            <v-icon color="#1B73F8">mdi-plus</v-icon>
                            </v-card>
                          <div v-for="portfolio in portfolios" :key="portfolio.id">
                            <v-card  class="portfolio-card  d-flex align-center justify-center" text="" variant="outlined" style="border-color: #1B73F8;">
                              <!-- <h3>{{ portfolio.title }}</h3>
                              <p>{{ portfolio.description }}</p>
                              <h1>{{portfolio.id }}</h1> -->
                              <div  class="portfolio-detail hidden">
                                <v-btn text @click="openEditDialog(portfolio)">edit</v-btn>
                                <v-btn  @click="deletePortfolio(portfolio.id)">delete</v-btn>
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
                          <v-card class="w-[280px] h-[230px] d-flex align-center justify-center" text="" variant="outlined" style="border-color: #1B73F8;">
                            <a :href="route('portfolio')" class="title-blue-md">ADD PROJECT</a>
                            <v-icon color="#1B73F8">mdi-plus</v-icon>
                            </v-card>
                        <p>No portfolios found.</p>
                        </div>



                </div>

            </div>

        </div>
<!-- Edit Popup Form -->
<v-dialog v-model="editDialog" max-width="600px">
      <v-card>
        <v-card-title>Edit Portfolio</v-card-title>
        <v-card-text>
          <v-form ref="editForm" @submit.prevent="saveEdit" method="put" enctype="multipart/form-data">
            <v-text-field v-model="editedPortfolio.title" label="Title"></v-text-field>
            <v-textarea v-model="editedPortfolio.description" label="Description"></v-textarea>
            <input type="file" name="images" multiple @change="handleImageChange">
        <!-- Display the existing images -->
        <ul>
          <li v-for="image in editedPortfolio.images" :key="image.id">
            <img :src="image.fullImagePath" alt="Portfolio Image" class="w-fit h-fit m-0 p-0" />
            <v-icon small @click="removeFile(image)">mdi-close</v-icon>
          </li>
        </ul>
          </v-form>
        </v-card-text>
        <v-card-actions>
          <v-btn text @click="closeEditDialog">Cancel</v-btn>
          <v-btn color="primary" @click="saveEdit">Save</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>


        <!-- Modal component -->
  <div v-if="selectedPortfolio" class="fixed inset-0 flex items-center justify-center z-50 ">
    <div class="absolute inset-0 bg-gray-900 opacity-50"></div>
    <div class="relative bg-white p-6">
      <h3>{{ selectedPortfolio.title }}</h3>
      <p>{{ selectedPortfolio.description }}</p>
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
      required: true,
    },

  },
  data() {
  return {
    userType: '',
    files: [],
    imageData: localStorage.getItem('uploadedImage'),
    portfolios: [],
    selectedPortfolio: null,
    editDialog: false,
      editedPortfolio: {
        id: null,
        title: '',
        description: '',
        images: [],
      },
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
    deletePortfolio(id) {
        console.log(id);
  axios.delete(`/api/portfolios/${id}`)
    .then(response => {
      console.log(response.data);
      window.location.reload();

    })
    .catch(error => {
      console.log(error);
      console.log(error.response.data);
    });
},

openEditDialog(portfolio) {
      this.editedPortfolio = {
        id: portfolio.id,
        title: portfolio.title,
        description: portfolio.description,
        images: [...portfolio.images],
      };
      this.editDialog = true;
    },
    closeEditDialog() {
      this.editDialog = false;
      this.editedPortfolio = {
        id: null,
        title: '',
        description: '',
      };
    },
    saveEdit() {


      axios.put(`/api/portfolios/${this.editedPortfolio.id}`, this.editedPortfolio)
        .then(response => {
          console.log(response.data);
          this.closeEditDialog();
        //   window.location.reload();
        })
        .catch(error => {
          console.log(error);
          console.log(error.response.data);
        });
    },
    handleImageChange(event) {
  const files = event.target.files;
  const newImages = [];
  for (let i = 0; i < files.length; i++) {
    const file = files[i];
    const image = {
      file,
      fullImagePath: URL.createObjectURL(file),
      path: 'public/portfolio_images/' + file.name,
    };
    newImages.push(image);
  }
  this.editedPortfolio.images = newImages;
},


// handleImageChange(event) {
//   const files = Array.from(event.target.files);
//   const newImages = [];
//   files.forEach((file) => {
//     const image = {
//       file,
//       fullImagePath: URL.createObjectURL(file),
//     //   path: 'public/portfolio_images/' + file.name,
//     // path: '',
//     };
//     newImages.push(image);
//     console.log(newImages);

//   });
// //   this.newImages = newImages;
//   this.editedPortfolio.images = newImages;
// // this.editedPortfolio.images = [...this.editedPortfolio.images, ...newImages];
// },



removeFile(image) {
  const index = this.editedPortfolio.images.indexOf(image);
  if (index !== -1) {
    this.editedPortfolio.images.splice(index, 1);
    localStorage.setItem('uploadedFiles', JSON.stringify(this.editedPortfolio.images));
  }
//   const fileIndex = this.imageFiles.indexOf(image.file);
//   if (fileIndex !== -1) {
//     this.imageFiles.splice(fileIndex, 1);
//   }
},


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
                id: Object.values(response.data.id[index]).join(" "),
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

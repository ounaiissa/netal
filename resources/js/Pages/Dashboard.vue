
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
            <!-- <p>Current user type: {{ this.auth.user.userType }}</p> -->
            <div class=" p-6 overflow-hidden bg-white rounded-md shadow-md dark:bg-dark-eval-1">
                <h1 class="title-blue py-2">Overview</h1>
                <p class="pb-3">Welcome back, your progress is really good. keep it up!</p>

                <div class="">

                        <!-- <v-card class="w-[280px] h-[230px] d-flex align-center justify-center" text="" variant="outlined" style="border-color: #1B73F8;">
                            <a :href="route('portfolio')" class="title-blue-md">ADD PROJECT</a>
                            <v-icon color="#1B73F8">mdi-plus</v-icon>

                        </v-card> -->

                         <!-- Display portfolios in v-cards -->


                          <div v-if="portfolios.length > 0" class="chbun grid grid-cols-3 gap-2">
                            <v-card class="w-[400px] h-[300px] d-flex align-center justify-center" text="" variant="outlined" style="border-color: #1B73F8;">
                            <a :href="route('project')" class="title-blue-md">ADD PROJECT</a>
                            <v-icon color="#1B73F8">mdi-plus</v-icon>
                            </v-card>
                          <div v-for="portfolio in portfolios" :key="portfolio.id">
                            <v-card  class="portfolio-card  d-flex align-center justify-center" text="" variant="outlined" style="border-color: #1B73F8;">
                              <!-- <h3>{{ portfolio.title }}</h3>
                              <p>{{ portfolio.description }}</p>
                              <h1>{{portfolio.id }}</h1> -->
                              <div  class="portfolio-detail hidden">
                                <div class="flex gap-4 justify-end mt-1 mr-1">
                                    <button class="" @click="openEditDialog(portfolio)">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<g clip-path="url(#clip0_954_4080)">
<path d="M19.83 0C19.32 0 18.81 0.2 18.42 0.59L16.01 3L21.01 8L23.42 5.59C24.2 4.81 24.2 3.54 23.42 2.76L21.25 0.59C20.86 0.2 20.35 0 19.84 0L19.83 0ZM14 5L2.26 16.74C2.26 16.74 3.18 16.66 3.52 17C3.86 17.34 3.58 19.58 4 20C4.42 20.42 6.64 20.12 6.96 20.44C7.28 20.76 7.26 21.74 7.26 21.74L19 10L14 5ZM1 20L0.06 22.67C0.02 22.78 0 22.89 0 23C0 23.55 0.45 24 1 24C1.11 24 1.22 23.98 1.33 23.94H1.36V23.93L3.99 23L2.49 21.5L0.99 20H1Z" fill="black"/>
</g>
<defs>
<clipPath id="clip0_954_4080">
<rect width="24" height="24" fill="white"/>
</clipPath>
</defs>
</svg>

                                </button>
                                <button class="" @click="deletePortfolio(portfolio.id)">
                                    <svg width="21" height="24" viewBox="0 0 21 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M8.01 0.556641C7.46 0.556641 7 0.986641 7 1.54664C7 1.54664 7 1.54664 7 1.55664H1.01C0.46 1.54664 0 1.98664 0 2.54664C0 3.10664 0.43 3.55664 0.99 3.55664C0.99 3.55664 1.01 3.55664 1.02 3.55664H19.01C19.56 3.55664 20.02 3.12664 20.02 2.56664C20.02 2.00664 19.59 1.55664 19.03 1.55664C19.03 1.55664 19.01 1.55664 19 1.55664H13.01C13.01 1.00664 12.56 0.556641 12.01 0.556641C12.01 0.556641 12.01 0.556641 12 0.556641H8H8.01ZM1.01 5.55664V21.5566C1.01 22.6566 1.9 23.5566 3.01 23.5566H17.01C18.11 23.5566 19.01 22.6566 19.01 21.5566V5.55664H1.01Z" fill="black"/>
</svg>


                                </button>
                                <button class="" @click="openModal(portfolio)">

                                    <svg width="30" height="21" viewBox="0 0 30 21" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M14.7025 0.136719C7.8125 0.136719 1.9425 7.18672 0.2325 9.44672C-0.0775 9.85672 -0.0775 10.4067 0.2325 10.8167C1.9325 13.0667 7.8125 20.1267 14.7025 20.1267C21.5925 20.1267 27.4625 13.0667 29.1625 10.8167C29.4725 10.4067 29.4725 9.85672 29.1625 9.44672C27.4625 7.19672 21.5825 0.136719 14.7025 0.136719ZM14.7025 17.2067C10.3125 17.2067 6.8525 13.2067 7.7725 8.65672C8.3125 5.98672 10.4525 3.80672 13.1225 3.23672C17.7025 2.24672 21.7725 5.71672 21.7725 10.1367C21.7725 14.0467 18.5925 17.2167 14.6925 17.2167L14.7025 17.2067Z" fill="#231F20"/>
<path d="M15.6131 3.10714C10.7631 2.50714 6.74313 6.78714 7.79313 11.7071C8.35313 14.3071 10.4331 16.4171 13.0231 17.0171C17.9631 18.1571 22.3331 14.0971 21.7131 9.20714C21.3131 6.06714 18.7531 3.50714 15.6131 3.11714V3.10714ZM14.7031 13.0571C12.8431 13.0571 11.3931 11.3271 11.8631 9.38714C12.1031 8.40714 12.8931 7.59714 13.8631 7.32714C15.8231 6.77714 17.6131 8.23714 17.6131 10.1271C17.6131 11.7471 16.3031 13.0571 14.6931 13.0571H14.7031Z" fill="white"/>
<path d="M17.6127 10.127C17.6127 12.017 15.8227 13.487 13.8627 12.937C12.8827 12.657 12.1027 11.847 11.8627 10.857C11.3927 8.91703 12.8427 7.20703 14.7027 7.20703C16.3027 7.20703 17.6227 8.50703 17.6227 10.127H17.6127Z" fill="#231F20"/>
</svg>


                                </button>
                                </div>


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
                            <a :href="route('project')" class="title-blue-md">ADD PROJECT</a>
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
  <div v-if="selectedPortfolio" class="fixed inset-0 flex items-center justify-center z-50 " >
    <div class="absolute inset-0 bg-gray-900 opacity-50"></div>
    <div class="relative bg-white p-6 modal-content">
      <h3>{{ selectedPortfolio.title }}</h3>
      <p>{{ selectedPortfolio.description }}</p>
      <div v-if="selectedPortfolio.images.length > 0" class="image-container">
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
            <!-- <h1>heey you're a company</h1> -->
              <div>
                <h1 class="title-blue">Your Postings Jobs</h1>
                <div v-if="jobboards.length > 0" >
                  <div v-if="displayJobBoards">
                    <v-card v-for="jobboard in jobboards" :key="jobboard.id" class="job-card py-7 px-3">
                        <div class="d-flex gap-[600px] chun">
                            <p class="project-title">Looking for - {{ jobboard.jobTitle }}</p>
                            <div class="flex gap-7 items-center justify-center">
                                <button @click="openEditDialogJob(jobboard)" class="flex" >
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd" d="M17.2047 10.7957L19.0007 8.9997C19.546 8.45445 19.8186 8.18182 19.9644 7.88773C20.2416 7.32818 20.2416 6.67122 19.9644 6.11167C19.8186 5.81757 19.546 5.54495 19.0007 4.9997C18.4555 4.45445 18.1829 4.18182 17.8888 4.03609C17.3292 3.7588 16.6723 3.7588 16.1127 4.03609C15.8186 4.18182 15.546 4.45445 15.0007 4.9997L13.1821 6.81835C14.146 8.46895 15.5321 9.84451 17.2047 10.7957ZM11.7276 8.27281L4.85713 15.1433C4.43207 15.5684 4.21954 15.7809 4.0798 16.042C3.94007 16.3031 3.88112 16.5978 3.76323 17.1873L3.14784 20.2643C3.08131 20.5969 3.04805 20.7632 3.14266 20.8578C3.23727 20.9524 3.40357 20.9191 3.73618 20.8526L6.81316 20.2372C7.40262 20.1193 7.69734 20.0604 7.95844 19.9206C8.21954 19.7809 8.43207 19.5684 8.85713 19.1433L15.7465 12.2539C14.1249 11.2383 12.7532 9.87597 11.7276 8.27281Z" fill="black" fill-opacity="0.6"/>
                                    </svg>
                                    <!-- <span>edit</span> -->
                                </button>
                                <button  @click="showProposals(jobboard.id)" class="flex" >
                                    <svg width="25" height="13" viewBox="0 0 25 13" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M11.5898 9.84961C9.65984 9.84961 8.08984 8.27961 8.08984 6.34961C8.08984 4.41961 9.65984 2.84961 11.5898 2.84961C13.5198 2.84961 15.0898 4.41961 15.0898 6.34961C15.0898 8.27961 13.5198 9.84961 11.5898 9.84961ZM11.5898 4.04961C10.3198 4.04961 9.28984 5.07961 9.28984 6.34961C9.28984 7.61961 10.3198 8.64961 11.5898 8.64961C12.8598 8.64961 13.8898 7.61961 13.8898 6.34961C13.8898 5.07961 12.8598 4.04961 11.5898 4.04961Z" fill="#646566"/>
<path d="M11.71 12.71C7.06 12.71 2.72 10.16 0.49 5.86L0 4.92L2.66 3C5.38 1.04 8.59 0 11.94 0H12.05C14.18 0 16.3 0.54 18.17 1.55L24.46 4.96L21.08 8.63C19.43 10.42 17.31 11.69 14.95 12.3C13.87 12.58 12.78 12.72 11.72 12.72L11.71 12.71ZM2.19 5.44C4.65 9.78 9.65 11.92 14.51 10.65C16.55 10.12 18.39 9.02 19.82 7.47L21.72 5.41L17.36 3.05C15.73 2.17 13.9 1.7 12.05 1.7H11.94C8.95 1.7 6.08 2.63 3.66 4.38L2.19 5.44Z" fill="#646566"/>
</svg>


                                </button>

                            </div>

                            <!-- openJobDetails(jobboard) -->
                        </div>

                        <p class="project-desc">{{ jobboard.description }}</p>
                        <div class="d-flex gap-10">
                            <p class="project-details">Proposlas:{{ interestedUsersCount }}</p>
                            <p class="project-details">Due: {{ jobboard.dueDate }}</p>
                            <p class="project-details">Budget: {{ jobboard.budget }} $/h</p>
                        </div>

                    </v-card>
                  </div>
                    <div v-else>
                    <v-btn @click="goBack">Back</v-btn>
                    <Proposals :jobboardId="selectedJobboardId" />
<!--  @interested-users-count-changed="updateInterestedUsersCount" -->
                  </div>
                </div>
  <div v-else>
    <p>no job board found</p>
  </div>

<!-- edit pop up -->
<v-dialog v-model="editDialogJob" max-width="600px">
  <v-card>
    <v-card-title>Edit Job Board</v-card-title>
    <v-card-text>
      <v-form ref="editForm" @submit.prevent="saveEditJob">
        <v-text-field v-model="editedJobboard.jobTitle" label="Job Title"></v-text-field>
        <v-textarea v-model="editedJobboard.description" label="Description"></v-textarea>
        <v-text-field type="number" v-model="editedJobboard.budget" label="Budget"></v-text-field>
        <v-text-field type="date" v-model="editedJobboard.dueDate" label="Due Date"></v-text-field>
      </v-form>
    </v-card-text>
    <v-card-actions>
      <v-btn text @click="closeEditDialoJob">Cancel</v-btn>
      <v-btn color="primary" @click="saveEditJob">Save</v-btn>
    </v-card-actions>
  </v-card>
</v-dialog>


              </div>
        </div>

    </AuthenticatedLayout>
</template>




<style scoped>
.v-card--outlined {
  border-color: #1B73F8;
}

.modal-content {
  max-height: 900px;
  overflow: auto;
}

.image-container {
  max-height: 500px;
  overflow-y: auto;
}

.w-fit {
  width: auto;
  max-width: 100%;
}

.h-fit {
  height: auto;
  max-height: 100%;
}
</style>


<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'
import Proposals from '../Pages/discover/jobboards/proposals.vue';
</script>

<script>
import axios from 'axios';
import { router } from '@inertiajs/vue3';
import store from './store';

export default {

  props: {
    interestedUsersCount: {
    type: Number,
    required: true
  },
    auth: {
      type: Object,
      required: true,
    },
    jobboardId:[],


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
      jobboards: [],
      editDialogJob:false,
      editedJobboard: {
      id: null,
      jobTitle: '',
      description: '',
      budget: '',
      dueDate: '',
      jobboardId: null,

    },
    displayJobBoards: true,
    selectedJobboardId: null,
    interestedUsersCount: 0,

  };
},
methods: {
//     updateInterestedUsersCount(newCount) {
//     this.interestedUsersCount = newCount;
//   },

  showProposals(jobboardId) {
    this.selectedJobboardId = jobboardId;
      this.displayJobBoards = false;
    },
    goBack() {
      this.displayJobBoards = true;
    },


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
          window.location.reload();
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
removeFile(image) {
  const index = this.editedPortfolio.images.indexOf(image);
  if (index !== -1) {
    this.editedPortfolio.images.splice(index, 1);
    localStorage.setItem('uploadedFiles', JSON.stringify(this.editedPortfolio.images));
  }
},

// job board methods
// openJobDetails(jobboard) {
//   const jobboardId = jobboard.id;
//   console.log('this is the job board id', jobboardId);
//   this.$inertia.visit('/proposals', { data: { jobboardId } });
// //   router.visit('/proposals', {method: 'post', data: { jobboardId } });
// // this.$inertia.visit('/proposals?jobboardId=' + jobboardId);

// },

openJobDetails(jobboard) {
    this.$inertia.visit('/proposals', {
      data: {
        jobboardId: jobboard.id,
      },
      props: {
      jobboardId: jobboard.id,
    },

    });
    // this.$emit('jobboard-selected', jobboard.id);
    // eventBus.$emit('jobboard-selected', jobboard.id);
    console.log('jobboard id from dashboard is: ', jobboard.id);
  },
// openJobDetails(jobboard) {
//     store.commit('setSelectedJobboardId', jobboard.id);
//     this.$inertia.visit('/proposals');
//     console.log('jobboard id from dashboard is: ', jobboard.id);
//   },
openEditDialogJob(jobboard){
    this.editedJobboard = {
      id: jobboard.id,
      jobTitle: jobboard.jobTitle,
      description: jobboard.description,
      budget: jobboard.budget,
      dueDate: jobboard.dueDate,
    };
    this.editDialogJob = true;
},
closeEditDialoJob() {
    this.editDialogJob = false;
    this.editedJobboard = {
      id: null,
      jobTitle: '',
      description: '',
      budget: '',
      dueDate: '',
    };
  },
  saveEditJob() {
    // Send a request to update the job board data on the server
    axios.put(`/api/jobboards/${this.editedJobboard.id}`, this.editedJobboard)
      .then(response => {
        console.log(response.data);
        this.closeEditDialoJob();
        window.location.reload();
      })
      .catch(error => {
        console.log(error);
        console.log(error.response.data);
      });
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
            // this.portfolios = response.data.title.map((title, index) => ({
            //     // title,
            //     // description: response.data.description[index],
            //     id: Object.values(response.data.id[index]).join(" "),
            //     title: Object.values(title).join(" "),
            //     description: Object.values(response.data.description[index]).join(" "),
            //     images: [{ fullImagePath: `/portfolioImages/${response.data.imagesPath[index].path.split('/').pop()}` }],
            // }));

            this.portfolios = response.data.map(portfolio => ({
      id: portfolio.id,
      title: portfolio.title,
      description: portfolio.description,
      images: portfolio.imagesPath.map(path => ({ fullImagePath: `/portfolioImages/${path.split('/').pop()}` })),
    }));

        })
        .catch(error => {
            console.log(error);
        });

    axios.get('/jobboards')
    .then(response => {
      // console.log('tt', response.data);

    const currentUser =  this.auth.user.id;
    const idArray = response.data.id;
    const jobTitleArray = response.data.job_title;
    const descriptionArray = response.data.description;
    const companyIdArray = response.data.company_id;
    const budgetArray = response.data.budget;
    const dueDateArray = response.data.due_date;


    const transformedData = idArray.map((item, index) => {
      return {
        id: item.id,
        jobTitle: jobTitleArray[index].job_title,
        description: descriptionArray[index].description,
        companyId: companyIdArray[index].company_id,
        budget: budgetArray[index].budget,
        dueDate: dueDateArray[index].due_date,
      };
    });
    this.jobboards = transformedData.filter(jobboard => jobboard.companyId === currentUser);
    console.log('tdata', transformedData);
    // this.jobboards = transformedData;

       })
    .catch(error => {
      console.error(error);
      console.log(error.response.data);
    });

  }
}


</script>

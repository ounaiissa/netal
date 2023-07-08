
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


                          <div v-if="portfolios.length > 0" class="grid grid-cols-3 gap-2">
                            <v-card class="w-[340px] h-[260px] d-flex align-center justify-center" text="" variant="outlined" style="border-color: #1B73F8;">
                            <a :href="route('project')" class="title-blue-md">ADD PROJECT</a>
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
            <!-- <h1>heey you're a company</h1> -->
              <div>
                <h1 class="title-blue">Your Postings Jobs</h1>
                <div v-if="jobboards.length > 0" >
                  <div v-if="displayJobBoards">
                    <v-card v-for="jobboard in jobboards" :key="jobboard.id" class="job-card py-7 px-3">
                        <div class="d-flex gap-[600px]">
                            <p class="project-title">Looking for - {{ jobboard.jobTitle }}</p>
                            <div class="flex gap-7">
                                <button @click="openEditDialogJob(jobboard)" class="flex" >
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
<path fill-rule="evenodd" clip-rule="evenodd" d="M17.2047 10.7957L19.0007 8.9997C19.546 8.45445 19.8186 8.18182 19.9644 7.88773C20.2416 7.32818 20.2416 6.67122 19.9644 6.11167C19.8186 5.81757 19.546 5.54495 19.0007 4.9997C18.4555 4.45445 18.1829 4.18182 17.8888 4.03609C17.3292 3.7588 16.6723 3.7588 16.1127 4.03609C15.8186 4.18182 15.546 4.45445 15.0007 4.9997L13.1821 6.81835C14.146 8.46895 15.5321 9.84451 17.2047 10.7957ZM11.7276 8.27281L4.85713 15.1433C4.43207 15.5684 4.21954 15.7809 4.0798 16.042C3.94007 16.3031 3.88112 16.5978 3.76323 17.1873L3.14784 20.2643C3.08131 20.5969 3.04805 20.7632 3.14266 20.8578C3.23727 20.9524 3.40357 20.9191 3.73618 20.8526L6.81316 20.2372C7.40262 20.1193 7.69734 20.0604 7.95844 19.9206C8.21954 19.7809 8.43207 19.5684 8.85713 19.1433L15.7465 12.2539C14.1249 11.2383 12.7532 9.87597 11.7276 8.27281Z" fill="black" fill-opacity="0.6"/>
                                    </svg>
                                    <span>edit</span>
                                </button>
                                <button  @click="showProposals(jobboard.id)" class="flex" >
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M17.2047 10.7957L19.0007 8.9997C19.546 8.45445 19.8186 8.18182 19.9644 7.88773C20.2416 7.32818 20.2416 6.67122 19.9644 6.11167C19.8186 5.81757 19.546 5.54495 19.0007 4.9997C18.4555 4.45445 18.1829 4.18182 17.8888 4.03609C17.3292 3.7588 16.6723 3.7588 16.1127 4.03609C15.8186 4.18182 15.546 4.45445 15.0007 4.9997L13.1821 6.81835C14.146 8.46895 15.5321 9.84451 17.2047 10.7957ZM11.7276 8.27281L4.85713 15.1433C4.43207 15.5684 4.21954 15.7809 4.0798 16.042C3.94007 16.3031 3.88112 16.5978 3.76323 17.1873L3.14784 20.2643C3.08131 20.5969 3.04805 20.7632 3.14266 20.8578C3.23727 20.9524 3.40357 20.9191 3.73618 20.8526L6.81316 20.2372C7.40262 20.1193 7.69734 20.0604 7.95844 19.9206C8.21954 19.7809 8.43207 19.5684 8.85713 19.1433L15.7465 12.2539C14.1249 11.2383 12.7532 9.87597 11.7276 8.27281Z" fill="black" fill-opacity="0.6"/>
                                    </svg>
                                    <span>View</span>
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

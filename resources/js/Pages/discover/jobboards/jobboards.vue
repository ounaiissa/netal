<template>
    <AuthenticatedLayout>
        <div class="d-flex items-center px-2 my-5 bg-white w-[370px]" style="border-radius: 19px; ">
  <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
    <g id="Basic / Search">
      <path id="Vector" d="M21 21L16.6569 16.6569M16.6569 16.6569C18.1046 15.2091 19 13.2091 19 11C19 6.58172 15.4183 3 11 3C6.58172 3 3 6.58172 3 11C3 15.4183 6.58172 19 11 19C13.2091 19 15.2091 18.1046 16.6569 16.6569Z" stroke="black" stroke-opacity="0.5" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
    </g>
  </svg>
  <input type="text" v-model="searchTerm" placeholder="Search by title" />
  <button style="border-left: 1px solid ; font-size: 18px; font-weight: 500;" class="pl-4 text-blue-1 hover:text-blue-2" @click="searchJobBoards">Search</button>
</div>


    <div v-if="displayedJobBoards.length > 0" class="my-9">
        <div class="grid grid-cols-4 gap-9">
        <v-card v-for="jobboard in displayedJobBoards" :key="jobboard.id" class="alljob-card py-4 px-2">
            <p class="project-title">{{ jobboard.jobTitle }}</p>
            <p>Fixed price: {{ jobboard.budget }}</p>
            <p>Deadline: {{ jobboard.dueDate }}</p>
            <p class="py-2">{{ jobboard.description }}</p>
            <div class="ml-[180px] mt-3">
                <v-btn @click="applyToJob(jobboard.id)" color="#1C4EFE">apply</v-btn>
            </div>

        </v-card>
        </div>
    </div>

<div v-else>
  <p>no job board found</p>
</div>

<v-dialog v-model="showConfirmationDialog">
      <v-card>
        <v-card-title>Application Confirmation</v-card-title>
        <v-card-text>
          The company will receive a notification about your application and will contact you if interested.
        </v-card-text>
        <v-card-actions>
          <v-btn @click="showConfirmationDialog = false">Close</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
    </AuthenticatedLayout>

</template>
<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'

</script>
<script>
import axios from 'axios'
export default {
data() {
    return {
        jobboards:[],
        showConfirmationDialog: false,
        searchTerm: '',
        displayedJobBoards: [],
    }},
    props: {
    auth: {
      type: Object,
      required: true,
    },},
methods:{
    applyToJob(jobboardId) {
      const userId = this.auth.user.id;

      const data = {
        jobboardId: jobboardId,
        user_id: userId,
      };

      axios
        .post('/api/interested-users', data)
        .then((response) => {
          console.log(response.data);
          this.showConfirmationDialog = true;
        })
        .catch((error) => {
          console.error(error);
          console.log(error.response.data);
        });
    },
    searchJobBoards() {
    if (this.searchTerm) {
      this.displayedJobBoards = this.jobboards.filter(jobboard =>
        jobboard.jobTitle.toLowerCase().includes(this.searchTerm.toLowerCase())
      );
    } else {
      this.displayedJobBoards = this.jobboards;
    }
  },

},
mounted() {
    axios.get('/api/jobboards')
    .then(response => {
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

    this.jobboards = transformedData;
    this.displayedJobBoards = this.jobboards;

       })
    .catch(error => {
      console.error(error);
      console.log(error.response.data);
    });

    // users
    axios.get('/api/users')
      .then(response => {
        // const currentUser =  this.auth.user.id;
        console.log(response.data);
      })
      .catch(error => {
        console.log(error);
        console.log(error.response.data);
      });
}
}

</script>

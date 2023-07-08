<template>
    <!-- <AuthenticatedLayout> -->


        <div v-if="selectedJobboard">
      <v-card class="selected-job-card py-4 px-2">
        <p class="project-title px-4 py-3" style="border-bottom: solid 1px #000;">Project Title - Looking for {{ selectedJobboard.jobTitle }}</p>
        <hr >
        <p class="py-3 px-4 text-justify" style="border-bottom: solid 1px #000;">{{ selectedJobboard.description }}</p>
       <div class="ml-4 flex gap-7">
        <p class="selected-job-card-spam">Budget: <div>{{ selectedJobboard.budget }}</div></p>
        <p class="selected-job-card-spam">Due: <div>{{ selectedJobboard.dueDate }}</div></p>
       </div>


      </v-card>

      <h1 class="title-blue-md">proposals:</h1>
      <h1 class="common-span-2">Proposals for Job Board: {{ interestedUsersCount }}</h1>
      <div v-for="interestedUser in interestedUsers" :key="interestedUser.id">
        <v-card class="proposals-card px-5 py-4">
            <div class="flex gap-7">
                <div>
                <img src="" alt="avatar.png">
            </div>
          <div>
            <div class="flex gap-[600px] items-center">
                <div>
                    <h1 class="selected-spam">{{ interestedUser.user ? interestedUser.user.name : 'Loading...' }}</h1>
          <h1 class="selected-spam-2">{{ interestedUser.user ? interestedUser.user.title : 'Loading...' }}</h1>
                </div>

          <div class="d-flex justify-between mx-3 mt-3 items-center">
            <!-- <p>{{ interestedUser.user ? interestedUser.user.budget : 'Loading...' }} $/hr</p> -->
            <v-btn @click="" class="custom-button">See more</v-btn>
          </div>
            </div>
          <p class="text-justify">{{ interestedUser.user ? interestedUser.user.about : 'Loading...' }}</p>

          </div>
            </div>


        </v-card>
      </div>
    </div>




    <div v-else>
      <p>No job board selected.</p>
    </div>

    <!-- </AuthenticatedLayout> -->
  </template>

  <script>
  import AuthenticatedLayout from '@/Layouts/Authenticated.vue';
  import axios from 'axios';


  export default {
    components: {
      AuthenticatedLayout,
    },
    props: {
    jobboardId: {
      type: Number,
      default: null,
      required: false,
    },

    // auth: {
    //   type: Object,
    //   required: true,
    // },
  },
    data() {
      return {
        jobboards: [],
        selectedJobboard: null,
    selectedJobboardId: null,
    interestedUsers: [],
    interestedUsersCount: 0,

      };
    },
    watch: {
  interestedUsersCount: function(newCount) {
    console.log('interestedUsersCount changed:', newCount);
    this.$emit('interested-users-count-changed', newCount);
  },
},


    methods: {
      handleJobboardSelected(jobboardId) {
      this.selectedJobboardId = jobboardId;
    },
    fetchInterestedUsers(jobboardId) {
    axios
      .get(`/api/jobboards/${jobboardId}/interested-users`)
      .then((response) => {
        this.interestedUsers = response.data;
        this.interestedUsersCount = response.data.length;
        this.$emit('interested-users-count-changed', this.interestedUsersCount);

        console.log('interested users: ', this.interestedUsers);
        // console.log('interested users: ', this.interestedUsers.user_id);
        console.log('jb jb', jobboardId);

        this.interestedUsers.forEach((interestedUser) => {
        console.log('user_id:', interestedUser.user_id);
        this.fetchUserInformation(interestedUser);

        // You can use the user_id here as needed
      });

      })
      .catch((error) => {
        console.log(error);
        console.log(error.response.data);
      });
  },
  fetchUserInformation() {
    this.interestedUsers.forEach(interestedUser => {
      axios.get(`/api/users/${interestedUser.user_id}`)
        .then(response => {
          console.log('api interested',response.data);
          interestedUser.user = response.data;
          console.log(interestedUser.user.name);
        })
        .catch(error => {
          console.log(error);
        });
    });
  }
    },

mounted() {


    // this.fetchInterestedUsers();
    // const jobboardId = this.$page.props.jobboardId;
    // const jobboardId = this.jobboardId;
    // console.log('hh',this.$page.props.jobboardId);
    // console.log('jobboardId', jobboardId);

    const jobboardId = this.jobboardId;
    console.log('jobboardId from proposals', jobboardId);
  axios.get('/api/jobboards')
    .then((response) => {
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
    const jobboardId = this.jobboardId;
    console.log('jobboardId', jobboardId);
      this.jobboards = transformedData;
      console.log('this transformed data', transformedData);
    //   console.log('this.jobboards',this.jobboards);

    this.selectedJobboard = this.jobboards.find(
          (jobboard) => jobboard.id === parseInt(jobboardId)
        );
        if (this.selectedJobboard) {
        this.fetchInterestedUsers(this.selectedJobboard.id);
      }
    })
    .catch((error) => {
      console.error(error);
      console.log(error.response.data);
    });

    axios.get('/api/users')
      .then(response => {
        console.log(response);
      })
      .catch(error => {
        console.log(error);
      });


},



  };
  </script>

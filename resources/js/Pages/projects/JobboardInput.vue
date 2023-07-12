<template>
    <AuthenticatedLayout>
        <v-sheet class="mx-auto px-4 py-5 my-4">
            <h1 class="title-blue my-9">Create New project</h1>
            <v-form ref="" @submit.prevent="submitJobBoard"  method="post">


                <div class="my-5">
                    <label class="project-label" for="job_title">Project Title:</label> <br>
                    <input class="project-input w-[823px]"  type="text" name="job_title" id="job_title" v-model="jobboard.job_title" :rules="[v => !!v || 'Project Title is required']" required />
                </div>
                <div class="my-5">
                    <label class="project-label" for="description">Description:</label><br>
                    <input class="project-input h-[300px] w-[823px]"  name="description" id="description" v-model="jobboard.description"  :rules="[v => !!v || 'Description is required']" required />
                </div>
                <div class="nun flex  gap-4 ">
                    <div class="my-5">
                        <label class="project-label" for="budget">Budget:</label> <br>
                        <div class="mun flex">
                            <input class="project-input"  type="number" name="budget" id="budget" v-model="jobboard.budget" :rules="[v => !!v || 'Budget is required']" required /> <div class="project-input">USD</div>
                        </div>

                    </div>
                    <div class="my-5">
                        <label class="project-label" for="due_date">Deadline due:</label> <br>
                        <input  class="project-input" type="date" name="due_date" id="due_date" v-model="jobboard.due_date" :rules="[v => !!v || 'Deadline due is required']"  required />
                    </div>
                    <div class="my-5 w-[300px]">
                        <label class="project-label" for="">looking for:</label>
                        <v-select :items="items" multiple></v-select>
                    </div>
                </div>

                <div>
                    <label class="project-label">Files:</label>
                   <div class="project-files items-center flex gap-2 text-center justify-center">
                    <svg width="24" height="22" viewBox="0 0 24 22" fill="none" xmlns="http://www.w3.org/2000/svg">
<path d="M3.99762 13.8976C3.25458 13.1384 2.69405 12.2201 2.35848 11.2122C2.02291 10.2043 1.92111 9.13332 2.06078 8.08027C2.20045 7.02721 2.57793 6.01975 3.16462 5.1342C3.75132 4.24864 4.53186 3.50821 5.4471 2.96899C6.36234 2.42977 7.3883 2.1059 8.44725 2.02191C9.5062 1.93793 10.5704 2.09603 11.5592 2.48424C12.548 2.87246 13.4355 3.4806 14.1544 4.26261C14.8734 5.04461 15.4049 5.97998 15.7088 6.99785H17.499C18.4646 6.99774 19.4047 7.30821 20.1803 7.88339C20.9559 8.45856 21.526 9.26795 21.8062 10.192C22.0865 11.116 22.0622 12.1057 21.7368 13.0149C21.4114 13.924 20.8022 14.7044 19.9993 15.2407" stroke="black" stroke-opacity="0.6" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M11.998 10.998V19.999" stroke="black" stroke-opacity="0.6" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
<path d="M16.0008 14.9985L12.0004 10.998L8 14.9985" stroke="black" stroke-opacity="0.6" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Upload Files:
                    <br>
                    Drag & drop any images or documents that could be auxiliary to clarify your abstract here
                   </div>

                </div>


              <v-btn type="submit" block class="mt-2 w-20 common-btn btn">Submit</v-btn>
            </v-form>
          </v-sheet>

          <v-dialog v-model="dialog" max-width="500px">
      <v-card>
        <v-card-title class="headline">Error</v-card-title>
        <v-card-text>
          Please fill in all the required fields.
        </v-card-text>
        <v-card-actions>
          <v-btn color="primary" text @click="dialog = false">OK</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
    </AuthenticatedLayout>

</template>
<script setup>
import AuthenticatedLayout from '@/Layouts/Authenticated.vue'
</script>

<script>
import { ref } from 'vue';
import axios from 'axios';
const jobboardForm = ref(null);
export default {
    data() {
      return {
        jobboard: {
        job_title: '',
        description: '',
        budget: '',
        due_date:'',
        items: ['designer', 'developer'],
      },
      jobboards: [],
      dialog: false ,
      };
    },
    methods: {
        submitJobBoard() {
            console.log("called")
            const formData = new FormData();
            formData.append('job_title', this.jobboard.job_title);
            formData.append('description', this.jobboard.description);
            formData.append('budget', this.jobboard.budget);
            formData.append('due_date', this.jobboard.due_date);

            axios.post('/jobboard', formData)
            .then(response => {
                this.isLoading = false;
                console.log(response.data);
                const newJobboard = {
                job_title: this.jobboard.job_title,
                description: this.jobboard.description,
                budget: this.jobboard.budget,
                due_date: this.jobboard.due_date,
            };
            this.jobboards.push(newJobboard);
            this.$inertia.visit('/dashboard');
            window.location.reload();

            })
            .catch(error => {
                this.isLoading = false;
                console.error(error);
                // console.error(error.response.data);
            });
        }
    },
        }
</script>

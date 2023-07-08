<template>
    <AuthenticatedLayout>
        <v-sheet class="mx-auto px-4 py-5 my-4">
            <h1 class="title-blue">Craete New project</h1>
            <v-form ref="" @submit.prevent="submitJobBoard"  method="post">


                <div>
                    <label class="selected-spam py-7" for="job_title">Project Title:</label>
                    <v-text-field  type="text" name="job_title" id="job_title" v-model="jobboard.job_title" :rules="[v => !!v || 'Project Title is required']" required></v-text-field>
                </div>
                <div>
                    <label class="selected-spam py-7" for="description">Description:</label>
                    <v-text-field  name="description" id="description" v-model="jobboard.description"  :rules="[v => !!v || 'Description is required']" required ></v-text-field>
                </div>
                <div>
                    <div>
                        <label class="selected-spam py-7" for="budget">Budget:</label>
                        <v-text-field  type="number" name="budget" id="budget" v-model="jobboard.budget" :rules="[v => !!v || 'Budget is required']" required ></v-text-field>
                    </div>
                    <div>
                        <label class="selected-spam py-7" for="due_date">Deadline due:</label>
                        <v-text-field  type="date" name="due_date" id="due_date" v-model="jobboard.due_date" :rules="[v => !!v || 'Deadline due is required']"  required ></v-text-field>
                    </div>
                    <!-- <div>
                        <label for="">looking for:</label>
                        <textarea name="" id="description" required></textarea>
                    </div> -->
                </div>

              <v-btn type="submit" block class="mt-2 w-20 common-btn">Submit</v-btn>
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
      },
      jobboards: [],
      dialog: false ,
      };
    },
    methods: {
        submitJobBoard() {
    //         if (!this.$refs.jobboardForm.validate()) {
    //     this.dialog = true
    //     return
    //   }
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

            // Clear the form fields and files array after successful submission
            jobboardForm.value.reset();
            // window.location.reload();
            // this.jobboard.job_title = '';
            // this.jobboard.description = '';
            // this.jobboard.budget = '';
            // this.jobboard.due_date = '';

            this.$inertia.visit('/dashboard');
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

<template>
    <AuthenticatedLayout>
      <template #header>
        <div class="md:items-center md:justify-between">
          <!-- <h2 class="text-xl font-semibold leading-tight">
            Upload a new project
          </h2> -->
          <v-sheet class="mx-auto">
            <h1 class="title-blue">Upload a new project</h1>
            <v-form ref="portfolioForm" @submit.prevent="submitPortfolio"  method="post">

                <div>
                    <label for="title">Title:</label>
                    <input type="text" name="title" id="title" v-model="portfolio.title" required>
                </div>
                <div>
                    <label for="description">Description:</label>
                    <textarea name="description" id="description" v-model="portfolio.description" required></textarea>
                </div>
            <div>
                <label for="images">Images:</label>
                <input name="images" id="images" ref="fileInput"  class="h-40 p-3" type="file" multiple @change="handleFileUpload" />
                <div
                    class="drop-area"
                    :class="{ 'drag-over': isDragOver }"
                    @dragenter="handleDragEnter"
                    @dragover="handleDragOver"
                    @dragleave="handleDragLeave"
                    @drop="handleDrop"
                >
                    <div v-if="files.length > 0">
                        <ul>

                            <li v-for="file in files" :key="file">
                                <img :src="file.preview" alt="Uploaded Image" />
                                <v-icon small @click="removeFile(file)">mdi-close</v-icon>
                            </li>

                        </ul>
                    </div>


                    <div v-else>
                    <span v-if="isDragOver">Drop the files here</span>
                    <span v-else>Drag and drop files here or click to select files</span>
                    </div>
                </div>
            </div>

              <v-btn type="submit" block class="mt-2 w-20 common-btn">Submit</v-btn>
            </v-form>
          </v-sheet>
        </div>
      </template>
    </AuthenticatedLayout>
  </template>

  <script>
  import AuthenticatedLayout from '@/Layouts/Authenticated.vue';
  import axios from 'axios';


  export default {
    components: {
      AuthenticatedLayout,
    },
    data() {
      return {
        portfolio: {
        title: '',
        description: '',
        images: [],
      },
        isDragOver: false,
        files: JSON.parse(localStorage.getItem('uploadedFiles') || '[]') ,
        portfolios: [],
      };
    },
    methods: {
        submitPortfolio() {

            console.log("called")
            const formData = new FormData();
            formData.append('title', this.portfolio.title);
            formData.append('description', this.portfolio.description);

            for (let i = 0; i < this.files.length; i++) {
                // formData.append('images[]', this.files[i]);
                const file = this.files[i];
                if (file.type && file.type.startsWith('image/')) {
                    formData.append('images[]', file);
                }
            }
            // console.log(formData);

            axios.post('/dashboard', formData)
            .then(response => {
                this.isLoading = false;
                console.log(response.data);
                const newPortfolio = {
                title: this.portfolio.title,
                description: this.portfolio.description,
                images: response.data.images,
            };
            this.portfolios.push(newPortfolio);

            // Clear the form fields and files array after successful submission
            this.portfolio.title = '';
            this.portfolio.description = '';
            this.files = [];
            localStorage.removeItem('uploadedFiles');
            this.$inertia.visit('/dashboard');
            })
            .catch(error => {
                this.isLoading = false;
                console.error(error);
                // console.error(error.response.data);
            });
            },
    handleFileUpload(event) {
        console.log('handleFileUpload called');
        // const fileList = this.$refs.fileInput.files;
        const fileList = event.target.files;
    //   const fileList = event.target.files;
      for (let i = 0; i < fileList.length; i++) {
        const file = fileList[i];
        // const fileURL = URL.createObjectURL(file);
        file.preview = URL.createObjectURL(file);
        this.files.push(file);
        const reader = new FileReader();
        reader.onload = (e) => {
          const imageData = e.target.result;
          file.preview = imageData;
          this.files.splice(i, 1, file);
        //   this.files.push(imageData);
          localStorage.setItem('uploadedFiles', JSON.stringify(this.files));
        };
        reader.readAsDataURL(file);
        console.log(file.name);
      }
    },
      handleDragEnter(event) {
        event.preventDefault();
        event.stopPropagation();
      },
      handleDragOver(event) {
        event.preventDefault();
        event.stopPropagation();
        event.target.classList.add('drag-over');
      },
      handleDragLeave(event) {
        event.target.classList.remove('drag-over');
        this.isDragOver = false;
      },
      handleDrop(event) {
        event.preventDefault();
        event.stopPropagation();
        event.target.classList.remove('drag-over');
        const fileList = event.dataTransfer.files;
        for (let i = 0; i < fileList.length; i++) {
          const file = fileList[i];
          this.files.push(file);
          console.log(file.name);
        }
        localStorage.setItem('uploadedFiles', JSON.stringify(this.files));
      },
      removeFile(file) {
        const index = this.files.indexOf(file);
        if (index !== -1) {
          this.files.splice(index, 1);
          localStorage.setItem('uploadedFiles', JSON.stringify(this.files));
        }
      },
    },
  };
  </script>

  <style scoped>
  .drop-area {
    border: 2px dashed #ccc;
    padding: 20px;
    text-align: center;
    cursor: pointer;
  }

  .drag-over {
    background-color: #f0f0f0;
  }
  </style>

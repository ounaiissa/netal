<template>

<div v-if="this.auth.user.userType === 'designer'|| this.auth.user.userType === 'developer'" class="py-4">
    <PortfolioInput></PortfolioInput>
</div>

<div v-else-if="this.auth.user.userType === 'company'">
    <JobBoardInput></JobBoardInput>
</div>
</template>
<script setup>
import PortfolioInput from './PortfolioInput.vue'
import JobBoardInput from './JobboardInput.vue'
</script>

<script>
import axios from 'axios';

export default {

props: {
  auth: {
    type: Object,
    required: true,
  },

},
data(){
    return{
        userType:'',
    }
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
    },
}
</script>

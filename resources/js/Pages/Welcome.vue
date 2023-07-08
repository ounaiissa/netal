
<script setup>
import { Head, Link } from '@inertiajs/inertia-vue3'
import { Link as InertiaLink } from '@inertiajs/inertia-vue3';
import { ref, onMounted, onUnmounted } from 'vue';
import PageFooter from '@/Components/PageFooter.vue'
import Footer from '../Pages/WelcomeComp/Footer.vue';
// import Navbar from '../Pages/WelcomeComp/navbar.vue';
import MainContent from '../Pages/WelcomeComp/mainContent.vue';
import JobBoards from '../Pages/discover/jobboards/jobboards.vue';

// import VueCarousel from 'vue-carousel';
// Use VueCarousel
// Vue.use(VueCarousel);

components: {
  InertiaLink
}

defineProps({
    canLogin: Boolean,
    canRegister: Boolean,
    laravelVersion: String,
    phpVersion: String,
})

const isNavbarActive = ref(false);
const isNavOpen = ref(false);

onMounted(() => {
  window.addEventListener('scroll', handleScroll);
  window.addEventListener('click', closeNav);
});

onUnmounted(() => {
  window.removeEventListener('scroll', handleScroll);
});

const handleScroll = () => {
  const scrollHeight = window.scrollY;
  isNavbarActive.value = scrollHeight > 100;
};



const toggleNav = () => {
  if (window.innerWidth <= 700) {
    isNavOpen.value = !isNavOpen.value;
    console.log(isNavOpen.value ? 'opened toggle' : 'closed toggle');
  }
};

const closeNav = () => {
  isNavOpen.value = false;
  console.log('closed toggle');
};

</script>


<template>
     <!-- <inertia-link :href="route('chat')" class="text-sm text-gray-700 underline">
  chat here
</inertia-link> -->

    <Head title="Welcome" />
<div class="relative  items-top justify-center min-h-screen bg-gray-100 dark:bg-dark-eval-0 dark:text-gray-200 sm:items-center sm:pt-0">
    <div class="main-container-1 slide-animation ">
        <!-- <Navbar /> -->
        <div class="">
            <nav class="navbar w-full flex gap-80" :class="{ 'navbar--active': isNavbarActive, 'navbar--transparent': !isNavbarActive }">
            <div class="logo mt-5 ml-4">
            <svg width="138" height="45" viewBox="0 0 138 45" :fill="isNavbarActive ? 'black' : 'white'" xmlns="http://www.w3.org/2000/svg">
            <g clip-path="url(#clip0_804_3523)">
            <path d="M66.4627 24.935H66.2941L58.0721 13.0586H54.5352V31.9432H58.5619V20.0588H58.7024L66.9967 31.9432H70.4734V13.0586H66.4627V24.935Z" fill="white"/>
            <path d="M105.368 13.0586H94.155H89.7188H74.0938V31.9432H86.9688V28.6499H78.1245V24.1435H86.2742V20.8503H78.1245V16.3519H89.7188H94.155H95.5521V31.9432H99.5347V16.3519H105.368V13.0586Z" fill="white"/>
            <path d="M111.455 13.0586L104.875 31.9392H109.195C109.231 31.8358 110.435 28.1647 111.628 24.5373V27.6357H117.489L118.902 31.9432H123.218L116.65 13.0626H111.459L111.455 13.0586ZM111.632 24.5174C112.812 20.9219 113.976 17.374 113.976 17.374H114.125L116.469 24.5174H111.632Z" fill="white"/>
            <path d="M129.829 28.6499V13.0586H125.803V31.9432H137.999V28.6499H129.829Z" fill="white"/>
            <path d="M3.24385 25.7145C5.03537 25.7145 6.48769 24.2757 6.48769 22.5008C6.48769 20.7259 5.03537 19.2871 3.24385 19.2871C1.45232 19.2871 0 20.7259 0 22.5008C0 24.2757 1.45232 25.7145 3.24385 25.7145Z" fill="white"/>
            <path d="M42.1774 25.7145C43.969 25.7145 45.4213 24.2757 45.4213 22.5008C45.4213 20.7259 43.969 19.2871 42.1774 19.2871C40.3859 19.2871 38.9336 20.7259 38.9336 22.5008C38.9336 24.2757 40.3859 25.7145 42.1774 25.7145Z" fill="white"/>
            <path d="M22.7106 44.9997C24.5022 44.9997 25.9545 43.5609 25.9545 41.786C25.9545 40.0111 24.5022 38.5723 22.7106 38.5723C20.9191 38.5723 19.4668 40.0111 19.4668 41.786C19.4668 43.5609 20.9191 44.9997 22.7106 44.9997Z" fill="white"/>
            <path d="M22.7106 6.42743C24.5022 6.42743 25.9545 4.98861 25.9545 3.21372C25.9545 1.43883 24.5022 0 22.7106 0C20.9191 0 19.4668 1.43883 19.4668 3.21372C19.4668 4.98861 20.9191 6.42743 22.7106 6.42743Z" fill="white"/>
            <path d="M36.4331 29.7185V15.2806C36.8305 15.0698 37.2039 14.7954 37.5411 14.4652C39.3959 12.6277 39.3959 9.64465 37.5411 7.80711C35.6863 5.96956 32.6753 5.96956 30.8206 7.80711C28.9658 9.64465 28.9658 12.6277 30.8206 14.4652C31.1578 14.7993 31.5312 15.0698 31.9286 15.2806V28.4735L27.3559 23.9433C27.5004 23.4859 27.5767 23.0007 27.5767 22.4995C27.5767 19.8387 25.3968 17.6789 22.711 17.6789C22.2011 17.6789 21.7153 17.7545 21.2536 17.8977L15.9744 12.6675C16.5364 10.9572 16.1349 9.0043 14.7619 7.64404C12.8148 5.71501 9.6633 5.71501 7.71619 7.64404C5.76908 9.57306 5.76908 12.6953 7.71619 14.6243C8.09759 15.0022 8.52715 15.3084 8.98483 15.5351V29.4599C8.52715 29.6906 8.09759 29.9929 7.71619 30.3707C5.76908 32.2998 5.76908 35.422 7.71619 37.351C9.6633 39.2801 12.8148 39.2801 14.7619 37.351C16.709 35.422 16.709 32.2998 14.7619 30.3707C14.3805 29.9929 13.951 29.6866 13.4933 29.4599V16.5215L18.066 21.0518C17.9215 21.5092 17.8452 21.9944 17.8452 22.4955C17.8452 25.1564 20.0251 27.3161 22.711 27.3161C23.2208 27.3161 23.7066 27.2406 24.1683 27.0974L29.6282 32.5066C29.1424 34.1095 29.5399 35.9192 30.8206 37.188C32.6753 39.0255 35.6863 39.0255 37.5411 37.188C39.3959 35.3504 39.3959 32.3674 37.5411 30.5298C37.2039 30.1957 36.8305 29.9253 36.4331 29.7145V29.7185Z" fill="white"/>
            </g>
            <defs>
            <clipPath id="clip0_804_3523">
            <rect width="138" height="45" fill="white"/>
            </clipPath>
            </defs>
            </svg>
            </div>
        <!-- <button class="navbar-toggle" @click="toggleNav">
            <span class="navbar-toggle-icon">toggle</span>
        </button> -->
        <!-- <div class="navbar-collapse" :class="{ 'navbar-collapse--open': isNavOpen, 'md:hidden': !isNavOpen }"> -->

            <div v-if="canLogin" class="hidden  px-6 py-4 sm:block  ">
                <Link v-if="$page.props.auth.user" href="/dashboard" class="text-sm common-btn ">
                    Dashboard
                </Link>

                <template v-else>
                    <div >

                        <div class="flex gap-1">

                                <Link  href="/" class="text-sm common-span ">
                                    Home
                                </Link>
                                <Link  href="/" class="text-sm common-span ">
                                    About
                                </Link>
                                <Link  href="/" class="text-sm common-span ">
                                    Job Board
                                </Link>
                                <Link  href="/" class="text-sm common-span ">
                                    Talents
                                </Link>

                                <Link :href="route('login')" class="text-sm common-btn ">
                                    Log in
                                </Link>

                                <Link v-if="canRegister" :href="route('register')" class="ml-4 text-sm common-btn ">
                                    Register
                                </Link>
                        </div>
                    </div>


                </template>

            </div>


        <!-- </div> -->

            </nav>
        </div>
        <!-- <MainContent /> -->
        <div class="main-content">
            <h1 class="ml-10 mt-[200px]">Connect, Collaborate, and Showcase Your Skills</h1>
            <p class="ml-20 text-justify text-white">
                Join our community of designers and developers and take your career to new heights.
            </p>
            <button class="mt-10 ml-10 common-btn">Get started</button>
        </div>
    </div>
    <div class="main-container-2">
        <div class="search-bar ">
            <div><v-icon class="search-icon">mdi-magnify</v-icon></div>
            <v-select
            v-model="value"
            :items="items"
            chips
            label="web developer"
            multiple
        ></v-select>
        <v-text-field  placeholder="Search" outlined></v-text-field>
        <v-btn
            class=" ms-4 text-white common-btn"
            color="#1C4EFE"
            rounded="0"
            variant="flat"
        >
            Search
        </v-btn>
        </div>

        <p>
            Welcome to our platform, where connection, collaboration, and skill showcase intersect. Our community of designers and developers is dedicated to pushing boundaries and unlocking new career heights. Connect with industry experts, collaborate with talented peers, and showcase your skills to a wider audience. Join now and embark on a transformative journey where creativity knows no bounds. Get started today and shape your future in the world of design and development.
        </p>
    </div>

    <!-- job boards -->
    <div class="jobBoards" >
        <div class="jobTilte flex items-center py-11 mx-72 gap-4" >Explore <div style="color: #1C74F4;">Job Opportunities</div></div>
        <div class="flex gap-4 mx-96">
            <v-btn >Developer</v-btn>
            <v-btn>Designer</v-btn>
        </div>
            <div v-if="jobboards.length > 0" class="my-9">
        <div class="grid grid-cols-4 gap-9">
        <v-card v-for="jobboard in jobboards" :key="jobboard.id" class="alljob-card py-4 px-2">
            <p class="project-title">{{ jobboard.jobTitle }}</p>
            <p>Fixed price: {{ jobboard.budget }}</p>
            <p>Deadline: {{ jobboard.dueDate }}</p>
            <p class="py-2">{{ jobboard.description }}</p>
        </v-card>
        </div>
        <div v-if="displayedJobBoards.length < jobboards.length" class="text-center">
          <v-btn @click="showMoreJobBoards" color="#1C4EFE">See More</v-btn>
        </div>
    </div>

    </div>

     <!-- talents -->
     <div class="talents" >
        <div class="jobTilte flex items-center py-11 mx-96 gap-4" >Discover <div style="color: #1C74F4;">Talent</div></div>
        <div class="flex gap-4 mx-96">
            <v-btn >Developer</v-btn>
            <v-btn>Designer</v-btn>
        </div>
        <div class="grid grid-cols-4 gap-2">
            <!-- <vue-carousel> -->
        <v-card v-for="user in users" :key="user.id" class="user-card" text="" variant="outlined" style="border-color: #1B73F8; background-color: #ffffff4f;">
          <img src="" alt="avatar.png">
          <h1>{{ user.name }}</h1>
          <h5>{{ user.title }}</h5>
          <p>{{ user.about }}</p>
          <div class="d-flex justify-between mx-3 mt-3 items-center">
            <p>{{ user.budget }} $/hr</p>
            <v-btn @click="openModal(portfolio)" class="custom-button"> See more</v-btn>
          </div>
        </v-card>
    <!-- </vue-carousel> -->
      </div>
    </div>


   <!-- portfolios -->
<div class="">
  <div class="jobTilte flex items-center py-11 mx-96 gap-4">Talents <div style="color: #1C74F4;">work</div></div>
  <span class="welcome-span">Display your best projects and inspire others in the community.</span>

    <vueper-slides
  class="no-shadow"
  :visible-slides="3"
  slide-multiple
  :gap="3"
  :slide-ratio="1 / 4"
  :dragging-distance="200"
  :breakpoints="{ 800: { visibleSlides: 2, slideMultiple: 2 } }">
  <vueper-slide v-for="i in 10" :key="i" :title="i.toString()" />
  hw
</vueper-slides>


</div>


<!-- how it works -->
<div>
    <div class="jobTilte flex items-center py-11 mx-96 gap-4" ><div style="color: #1C74F4;">How</div> it works</div>
    <span class="welcome-span">the process of using the website, from signing up to finding jobs or collaborating with others.</span>

    <div class="flex gap-9 col-span-4">
        <div class="step">
            <div class="step-title">
                <p>Step 1</p>
            </div>
            <div class="step-text">
                <p>the process of using the website, from signing up to finding jobs or collaborating with others.</p>
            </div>
        </div>
        <div class="step">
            <div class="step-title">
                <p>Step 2</p>
            </div>
            <div class="step-text">
                <p>the process of using the website, from signing up to finding jobs or collaborating with others.</p>
            </div>
        </div>
        <div class="step">
            <div class="step-title">
                <p>Step 3</p>
            </div>
            <div class="step-text">
                <p>the process of using the website, from signing up to finding jobs or collaborating with others.</p>
            </div>
        </div>
        <div class="step">
            <div class="step-title">
                <p>Step 4</p>
            </div>
            <div class="step-text">
                <p>the process of using the website, from signing up to finding jobs or collaborating with others.</p>
            </div>
        </div>


        <!-- FAQ -->
    <div>
        <!--  -->
    </div>
</div>

    <!--  -->
</div>


<!-- FAQ -->
<!-- <section class="bg-white dark:bg-gray-900">
    <div class="container px-6 py-12 mx-auto">
        <h1 class="text-2xl font-semibold text-gray-800 lg:text-3xl dark:text-white">Frequently asked questions</h1>

        <div class="mt-8 space-y-8 lg:mt-12">
            <div class="p-8 bg-gray-100 rounded-lg dark:bg-gray-800">
                <button class="flex items-center justify-between w-full">
                    <h1 class="font-semibold text-gray-700 dark:text-white">How i can play for my appoinment ?</h1>

                    <span class="text-gray-400 bg-gray-200 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 12H6" />
                        </svg>
                    </span>
                </button>

                <p class="mt-6 text-sm text-gray-500 dark:text-gray-300">
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptas eaque nobis, fugit odit omnis fugiat deleniti animi ab maxime cum laboriosam recusandae facere dolorum veniam quia pariatur obcaecati illo ducimus?
                </p>
            </div>

            <div class="p-8 bg-gray-100 rounded-lg dark:bg-gray-800">
                <button class="flex items-center justify-between w-full">
                    <h1 class="font-semibold text-gray-700 dark:text-white">Is the cost of the appoinment covered by private health insurance?</h1>

                    <span class="text-white bg-blue-500 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                    </span>
                </button>
                <p class="mt-6 text-sm text-gray-500 dark:text-gray-300">
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptas eaque nobis, fugit odit omnis fugiat deleniti animi ab maxime cum laboriosam recusandae facere dolorum veniam quia pariatur obcaecati illo ducimus?
                </p>
            </div>

            <div class="p-8 bg-gray-100 rounded-lg dark:bg-gray-800">
                <button class="flex items-center justify-between w-full">
                    <h1 class="font-semibold text-gray-700 dark:text-white">Do i need a referral?</h1>

                    <span class="text-white bg-blue-500 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                    </span>
                </button>
                <p class="mt-6 text-sm text-gray-500 dark:text-gray-300">
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptas eaque nobis, fugit odit omnis fugiat deleniti animi ab maxime cum laboriosam recusandae facere dolorum veniam quia pariatur obcaecati illo ducimus?
                </p>
            </div>

            <div class="p-8 bg-gray-100 rounded-lg dark:bg-gray-800">
                <button class="flex items-center justify-between w-full">
                    <h1 class="font-semibold text-gray-700 dark:text-white">What are your opening house?</h1>

                    <span class="text-white bg-blue-500 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                    </span>
                </button>
                <p class="mt-6 text-sm text-gray-500 dark:text-gray-300">
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptas eaque nobis, fugit odit omnis fugiat deleniti animi ab maxime cum laboriosam recusandae facere dolorum veniam quia pariatur obcaecati illo ducimus?
                </p>
            </div>

            <div class="p-8 bg-gray-100 rounded-lg dark:bg-gray-800">
                <button class="flex items-center justify-between w-full">
                    <h1 class="font-semibold text-gray-700 dark:text-white">What can i expect at my first consultation?</h1>

                    <span class="text-white bg-blue-500 rounded-full">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                    </span>
                </button>
                <p class="mt-6 text-sm text-gray-500 dark:text-gray-300">
                    Lorem ipsum dolor sit, amet consectetur adipisicing elit. Voluptas eaque nobis, fugit odit omnis fugiat deleniti animi ab maxime cum laboriosam recusandae facere dolorum veniam quia pariatur obcaecati illo ducimus?
                </p>
            </div>
        </div>
    </div>
</section> -->

<div>
    <div
      class="p-8 bg-gray-100 rounded-lg dark:bg-gray-800"
      v-for="(faq, index) in faqs"
      :key="index"
    >
      <button
        class="flex items-center justify-between w-full"
        @click="toggleAnswer(index)"
      >
        <h1 class="font-semibold text-gray-700 dark:text-white">{{ faq.question }}</h1>

        <span :class="{'text-gray-400 bg-gray-200': !faq.showAnswer, 'text-white bg-blue-500': faq.showAnswer}"
              class="rounded-full">
          <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path v-if="!faq.showAnswer" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 12H6" />
            <path v-else stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
          </svg>
        </span>
      </button>
      <p v-if="faq.showAnswer" class="mt-6 text-sm text-gray-500 dark:text-gray-300">
        {{ faq.answer }}
      </p>
    </div>
  </div>
<!--  -->
    <div>
 <footer class="footer">
    <div class="footer__logo">
      <img src="/path/to/logo.png" alt="Logo">
      <p class="footer__tagline">As a creative agency we work with you to develop solutions.</p>
      <div class="footer__social-media">
        <a href="#"><i class="fab fa-facebook"></i></a>
        <a href="#"><i class="fab fa-twitter"></i></a>
        <a href="#"><i class="fab fa-instagram"></i></a>
      </div>
    </div>
    <div class="footer__menu">
      <router-link :to="{ name: 'Home' }">Home</router-link>
      <router-link :to="{ name: 'JobBoards' }">Job Boards</router-link>
      <router-link :to="{ name: 'Talents' }">Talents</router-link>
      <router-link :to="{ name: 'Portfolio' }">Portfolio</router-link>
    </div>
    <div class="footer__help">
      <a href="#">Contact Us</a>
      <a href="#">FAQs</a>
      <a href="#">Terms of Service</a>
      <a href="#">Privacy & Policy</a>
    </div>
</footer>
</div>
</div>
    <PageFooter />
</template>

<script>
import axios from 'axios'
import { ref, reactive } from 'vue';
// import VueCarousel from 'vue-carousel';

const users = ref([])

  export default {
//     components: {
//     VueCarousel,
//   },
    props: {
    auth: {
      type: Object,
      required: true,
    },

  },
    data: () => ({
        jobboards:[],
        users:[],
        name: '',



      items: ['designer', 'developer'],
      value: ['designer', 'developer'],
      faqs: [
        {
          question: 'Why do you have a monthly project cap?',
          answer: 'As a creative agency we work with you to develop solutions to address your brand needs. That includes various aspects of brand planning and strategy, marketing and design.',
          showAnswer: false
        },
        {
          question: 'Is the cost of the appointment covered by private health insurance?',
          answer: 'The coverage for the appointment cost depends on your specific health insurance plan. We recommend contacting your insurance provider for more information.',
          showAnswer: false
        },
        {
          question: 'Do I need a referral?',
          answer: 'A referral is not required for most appointments. However, certain specialized services may require a referral from your primary care physician. Please contact us for more details.',
          showAnswer: false
        },
        {
          question: 'What are your opening hours?',
          answer: 'Our clinic is open from Monday to Friday, 9:00 AM to 5:00 PM. We are closed on weekends and public holidays.',
          showAnswer: false
        },
        {
          question: 'What can I expect at my first consultation?',
          answer: 'During your first consultation, our healthcare professionals will evaluate your medical history, discuss your concerns, and develop a personalized treatment plan. It may include physical examinations, diagnostic tests, and further appointments as needed.',
          showAnswer: false
        }
      ]
    }),
    methods: {
    toggleAnswer(index) {
      this.faqs[index].showAnswer = !this.faqs[index].showAnswer;
    },

  },
  mounted() {

    this.displayedJobBoards = this.jobboards.slice(0, this.itemsPerPage);
    this.displayedTalents = this.users.slice(0, this.itemsPerPage);

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


    axios.get('/api/users')
        .then(response => {
            users.value = response.data
            console.log(users.value);
            // const currentUser =  this.auth.user.id;

        })
        .catch(error => {
          console.log(error);
        });

}
  }
</script>

<style scoped>


.slide-animation {
  animation: slide 10s infinite;
  /* z-index: -1; */
}

@keyframes slide {
  0% {
    background-image: url("https://s3-alpha-sig.figma.com/img/e727/bfc0/9822cee7c94a7891a98177f6e1317e40?Expires=1685923200&Signature=LzHwZAoGAxm7J9KgF5BbseT8M~AJdPKWghaenZkpgemV0RdY4Srh21A7opWTXttN~eYcp9cflNxPbpvDlraU1zg5MohyUHvF3ZxNpgJFDPpgnbPBgk7es~umTqohyJfYNhSxzQji5NRXQNqT1qncmApFMNVklqfv14T5JXFA7DECnRLI1cNWolLqJBhpObAcBsPEaIDxNKTA4Unk4ciInanVFm4oKbohaotcwZKU9YWLN61hf56ZYL7lEACmkrHwlTZc0syjm8sqko1M2uaUBYivNIwVa~DZeocLa3hoqMxUQHSvng0jbqtX4GzAmBauxyeWDLxbi-jLpXDSL6jH7A__&Key-Pair-Id=APKAQ4GOSFWCVNEHN3O4");

  }
  25% {
    background-image: url("https://images.unsplash.com/photo-1517245386807-bb43f82c33c4?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1470&q=80");

  }
  50% {
    background-image: url("https://images.unsplash.com/photo-1522202801620-eb6f71f5bf05?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=870&q=80");
  }
  75% {
    background-image: url("https://images.unsplash.com/photo-1528901166007-3784c7dd3653?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=870&q=80");
  }
  100% {
    background-image: url("https://images.unsplash.com/photo-1519074002996-a69e7ac46a42?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=870&q=80");
  }
}
</style>

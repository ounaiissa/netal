import { createApp } from 'vue';
import Vuex from 'vuex';

const app = createApp({});

app.use(Vuex);

export default new Vuex.Store({
  state: {
    selectedJobboardId: null,
  },
  mutations: {
    setSelectedJobboardId(state, jobboardId) {
      state.selectedJobboardId = jobboardId;
    },
  },
});

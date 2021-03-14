// css
import './styles/app.css';

// js
import naja from 'naja'

import Vue from 'vue'
import vuetify from './plugins/vuetify'

new Vue({
  vuetify,
  components: {
  }
}).$mount('#app')

document.addEventListener('DOMContentLoaded', () => naja.initialize({
  history: false
}));
// let hello = require('./components/hellovue.vue').default

import Dashboard from "./components/pages/Dashboard";


import Tags from './components/pages/tags/Tag';
export const routes = [
    //starting project routing

    {
      path: '/',
      component: Dashboard
    },
    {
      path: '/tags',
      component: Tags
    },





]

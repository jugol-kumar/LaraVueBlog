// let hello = require('./components/hellovue.vue').default

import Dashboard from "./components/pages/Dashboard";


import Tags from './components/pages/tags/Tag'
import Category from './components/pages/category/Category'
import VueXCOm from './vuex/useCom'
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
    {
        path: '/categories',
        component: Category,
    },
    {
        path: '/vuex-page',
        component: VueXCOm,
    }


]

// let hello = require('./components/hellovue.vue').default

import Dashboard from "./components/pages/Dashboard";


import Tags from './components/pages/tags/Tag'
import Category from './components/pages/category/Category'
import AdminUser from './components/pages/adminuser/AdminUser'
import VueXCOm from './vuex/useCom'

import Login from './components/pages/auth/Login'


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
    },
    {
        path:'/user',
        component: AdminUser,
    },
    {
        path:'/login',
        component: Login,
    }


]

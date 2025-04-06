import Dashboard from "./components/pages/Dashboard";


import Tags from './components/pages/tags/Tag'
import Category from './components/pages/category/Category'
import AdminUser from './components/pages/adminuser/AdminUser'
import VueXCOm from './vuex/useCom'
<<<<<<< HEAD
=======

import Login from './components/pages/auth/Login'


export const routes = [
    //starting project routing
>>>>>>> 1ff7428dea13caf829d7929fb49abb7921cd2959

import Adminusers from './components/pages/adminusers/AdminUser'


import Login from './components/login'
export const routes = [
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
        path: '/adminusers',
        component: Adminusers,
    },
    {
        path: '/vuex-page',
        component: VueXCOm,
    },
<<<<<<< HEAD


    {
        path: '/login',
        component: Login,
    }



=======
    {
        path:'/user',
        component: AdminUser,
    },
    {
        path:'/login',
        component: Login,
    },
    {
        path: '/user-panel',
        component: UserPanel,
    }

>>>>>>> 1ff7428dea13caf829d7929fb49abb7921cd2959
]

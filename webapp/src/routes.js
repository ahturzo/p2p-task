import Login from "./components/auth/login";
import Dashboard from "./components/app/dashboard";
//users
import AllUsers from "./components/app/user/index"

//company
import AllCompany from "./components/app/company/index";

//employee
import AllEmployee from "./components/app/employee/index";

import store from './store/index';

export const routes = [

  // login
  {
    path: '/',
    component: Dashboard,
    beforeEnter(to, from, next) {
      if (store.getters["auth/authenticated"]) {
        next()
      } else {
        next('/login')
      }
    }
  },

  {
    path: '/login',
    component: Login,
    beforeEnter(to, from, next) {
      if (store.getters["auth/authenticated"]) {
        next('/')
      } else {
        next()
      }
    }
  },

  //  users
  {
    path: '/users',
    component: AllUsers,
    beforeEnter(to, from, next) {
      if (store.getters["auth/authenticated"]) {
        next()
      } else {
        next('/login')
      }
    }
  },

  //  company
  {
    path: '/companies',
    component: AllCompany,
    beforeEnter(to, from, next) {
      if (store.getters["auth/authenticated"]) {
        next()
      } else {
        next('/login')
      }
    }
  },

  //  Employee
  {
    path: '/employees',
    component: AllEmployee,
    beforeEnter(to, from, next) {
      if (store.getters["auth/authenticated"]) {
        next()
      } else {
        next('/login')
      }
    }
  }
]

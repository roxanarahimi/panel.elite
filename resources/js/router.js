import {createRouter, createWebHistory} from 'vue-router'

import Login from "./components/panel/admin/Login";

import ArticleCreate from "./components/panel/article/ArticleCreate";
import ArticleEdit from "./components/panel/article/ArticleEdit";
import Article from "./components/panel/article/Article";
import UserEdit from "./components/panel/user/UserEdit";
import SlideCreate from "./components/panel/slide/SlideCreate";
import SlideEdit from "./components/panel/slide/SlideEdit";
import Resume from "./components/panel/employ/Resume";

import TeacherCreate from "./components/panel/teacher/TeacherCreate";
import TeacherEdit from "./components/panel/teacher/TeacherEdit";
import Teacher from "./components/panel/teacher/Teacher";

import ProjectCreate from "./components/panel/project/ProjectCreate";
import ProjectEdit from "./components/panel/project/ProjectEdit";
import Project from "./components/panel/project/Project";

import Profile from "./components/panel/admin/Profile";
import Error404 from "./components/panel/error/Error404";

import CourseCreate from "./components/panel/course/CourseCreate";
import CourseEdit from "./components/panel/course/CourseEdit";
import Course from "./components/panel/course/Course";


const routes = [
    //panel

    {
        // {
        //     path: "/panel/test",
        //     component: () => import(/* webpackChunkName: "test" */ '../js/components/panel/product/ProductsT'),
        //     params: true
        // },
        path: "/panel",
        // name: "Home",
        component: () => import(/* webpackChunkName: "home" */ '../js/components/panel/Home'),

    },
    {
        path: "/panel/categories",
        //     component: () => import(/* webpackChunkName: "test" */ '../js/components/panel/product/Categories'),
        // name: "Categories",
        component: () => import(/* webpackChunkName: "Categories" */ '../js/components/panel/Categories'),
        props: true,
        params: true
    },
    {
        path: "/panel/products",
        component: () => import(/* webpackChunkName: "productAllData" */  './components/panel/allData'),
        name: "productAllData",
        params: true,
        props: true,
    },
    {
        path: "/panel/new/product",
        name: "ProductCreate",
        component: () => import(/* webpackChunkName: "ProductCreate" */ '../js/components/panel/product/ProductCreate'),
        // component: ProductCreate,
        params: true
    },
    {
        path: "/panel/edit/product/:id",
        name: "ProductEdit",
        component: () => import(/* webpackChunkName: "ProductEdit" */ '../js/components/panel/product/ProductEdit'),
        params: true
    },
    {
        path: "/panel/product/:id",
        name: "Product",
        component: () => import(/* webpackChunkName: "Product" */ '../js/components/panel/product/Product'),
        params: true

    },

    {

        path: "/panel/orders",
        component: () => import(/* webpackChunkName: "orderAllData" */  './components/panel/allData'),
        name: 'orderAllData',
        params: true,
        props: true,

        // component: Orders,
    },
    {
        path: "/panel/new/order",
        name: "OrderCreate",
        component: () => import(/* webpackChunkName: "OrderCreate" */ '../js/components/panel/order/OrderCreate'),
        params: true
    },
    {
        path: "/panel/edit/order/:id",
        name: "OrderEdit",
        component: () => import(/* webpackChunkName: "OrderEdit" */ '../js/components/panel/order/OrderEdit'),
        params: true
    },
    {
        path: "/panel/order/:id",
        name: "Order",
        component: () => import(/* webpackChunkName: "Order" */ '../js/components/panel/order/Order'),
        params: true

    },

    {
        path: "/panel/articles",
        component: () => import(/* webpackChunkName: "ArticleAllData" */ './components/panel/allData'),
        name: 'articleAllData',
        params: true,
        props: true

    },
    {
        path: "/panel/new/article",
        name: "ArticleCreate",
        component: ArticleCreate,
        params: true
    },
    {
        path: "/panel/edit/article/:id",
        name: "ArticleEdit",
        component: ArticleEdit,
        params: true
    },
    {
        path: "/panel/article/:id",
        name: "Article",
        component: Article,
    },

    {
        path: "/panel/projects",
        component: () => import(/* webpackChunkName: "projectAllData" */  './components/panel/allData'),
        name: "projectAllData",
        params: true,
        props: true
    },
    {
        path: "/panel/new/project",
        name: "ProjectCreate",
        component: ProjectCreate,
        params: true
    },
    {
        path: "/panel/edit/project/:id",
        name: "ProjectEdit",
        component: ProjectEdit,
        params: true
    },
    {
        path: "/panel/project/:id",
        name: "Project",
        component: Project,
    },

    {
        path: "/panel/courses",
        component: () => import(/* webpackChunkName: "courseAllData" */ './components/panel/allData'),
        name: "courseAllData",
        params: true,
        props: true

    },
    {
        path: "/panel/new/course",
        name: "CourseCreate",
        component: CourseCreate,
        params: true
    },
    {
        path: "/panel/edit/course/:id",
        name: "CourseEdit",
        component: CourseEdit,
        params: true
    },
    {
        path: "/panel/course/:id",
        name: "Course",
        component: Course,
    },

    {
        path: "/panel/slides",
        name: "Slides",
        component: () => import(/* webpackChunkName: "Slides" */ '../js/components/panel/slide/Slides'),

        // component: Slides,
    },
    {
        path: "/panel/icon",
        name: "Icon",
        component: () => import(/* webpackChunkName: "Icon" */ '../js/components/panel/icon/Icon'),

        // component: Slides,
    },
    {
        path: "/panel/new/slide",
        name: "SlideCreate",
        component: SlideCreate,
        params: true
    },
    {
        path: "/panel/edit/slide/:id",
        name: "SlideEdit",
        component: SlideEdit,
        params: true
    },

    {
        path: "/panel/user/:id",
        name: "User",
        component: () => import(/* webpackChunkName: "User" */ '../js/components/panel/user/User'),

        // component: User,
    },
    {
        path: "/panel/users",
        component: () => import(/* webpackChunkName: "userAllData" */  './components/panel/allData'),
        name: 'userAllData',
        params: true,
        props: true,

    },
    {
        path: "/panel/edit/user/:id",
        name: "UserEdit",
        component: UserEdit,
        params: true
    },
    {
        path: "/",
        name: 'Login0',
        component: Login,
    },
    {
        path: "/panel/login",
        name: "Login",
        component: Login,
    },
    {
        path: "/panel/profile",
        name: "Profile",
        component: Profile,
    },


    {
        path: "/panel/admins",
        component: () => import(/* webpackChunkName: "adminAllData" */  './components/panel/allData'),
        name: "adminAllData",
        params: true,
        props: true

    },

    {
        path: "/panel/finance",
        component: () => import(/* webpackChunkName: "financeAllData" */  './components/panel/allData'),
        name: "financeAllData",
        params: true,
        props: true
    },

    {
        path: "/panel/resumes",
        component: () => import(/* webpackChunkName: "resumeAllData" */ './components/panel/allData'),
        name: "resumeAllData",
        params: true,
        props: true,
    },
    {
        path: "/panel/new/resume",
        name: "ResumeCreate",
        component: () => import(/* webpackChunkName: "OrderCreate" */ '../js/components/panel/employ/ResumeCreate'),
        params: true
    },
    {
        path: "/panel/edit/resume/:id",
        name: "ResumeEdit",
        component: () => import(/* webpackChunkName: "OrderEdit" */ '../js/components/panel/employ/ResumeEdit'),
        params: true
    },

    {
        path: "/panel/resume/:id",
        name: "Resume",
        component: () => import(/* webpackChunkName: "Resume" */ '../js/components/panel/employ/Resume'),
    },
    {
        path: "/panel/teachers",
        component: () => import(/* webpackChunkName: "teacherAllData" */ './components/panel/allData'),
        name: "teacherAllData",
        params: true,
        props: true
    },
    {
        path: "/panel/new/teacher",
        name: "TeacherCreate",
        component: TeacherCreate,
        params: true
    },
    {
        path: "/panel/edit/teacher/:id",
        name: "TeacherEdit",
        component: TeacherEdit,
        params: true
    },
    {
        path: "/panel/teacher/:id",
        name: "Teacher",
        component: Teacher,
    },
    // {
    //     path: "/sample",
    //     name: "sample",
    //     component: () => import(/* webpackChunkName: "sample" */ './components/panel/report/catSample'),
    // },
    // {
    //     path: "/chart",
    //     name: "chart",
    //     component: () => import(/* webpackChunkName: "chart" */ './components/panel/report/Chart'),
    // },
    {
        path: "/:catchAll(.*)",
        name: "Error404",
        component: Error404,
    } ,

];

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes
})

export default router

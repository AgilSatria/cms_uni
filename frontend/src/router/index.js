import { createRouter, createWebHistory } from 'vue-router'
import Login from '@/pages/Login.vue'
import Dashboard from '@/pages/admin/Dashboard.vue'
import Articles from '@/pages/admin/Articles.vue'
import ArticleForm from '@/pages/admin/ArticleForm.vue'
import AdminLayout from '@/layouts/AdminLayout.vue'
import ArticleDetail from '@/pages/ArticleDetail.vue'
import Home from '@/pages/Home.vue'


// routes
const routes = [

    // 🌐 PUBLIC (USER)
    { path: '/', component: Home },
    { path: '/article/:slug', component: ArticleDetail },




    // Login  
    { path: '/login', component: Login },


    //admin
    {
        path: '/admin',
        component: AdminLayout,
        children: [
            { path: 'dashboard', component: Dashboard },
            { path: 'articles', component: Articles },
            { path: 'articles/create', component: ArticleForm },
            { path: 'articles/edit/:id', component: ArticleForm },
            { path: '/admin/articles/create', component: ArticleForm },
            { path: '/article/:slug', component: ArticleDetail },
            { path: '/admin/articles/edit/:id', component: ArticleForm }
        ]
    }

    
]

// ✅ simpan ke variable router dulu
const router = createRouter({
    history: createWebHistory(),
    routes
})

// ✅ baru pakai router
router.beforeEach((to, from, next) => {

    const token = localStorage.getItem('token')

    if (to.path.startsWith('/admin') && !token) {
        return next('/login')
    }

    if (to.path === '/login' && token) {
        return next('/admin/dashboard')
    }

    next()
})

// ✅ export terakhir
export default router
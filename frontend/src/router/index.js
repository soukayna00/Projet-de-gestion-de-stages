import { createRouter, createWebHistory } from 'vue-router'
import { useAuthStore } from '../stores/auth'

const routes = [

  // Pages publiques 
  {
    path: '/',
    name: 'home',
    component: () => import('../pages/Home.vue'),
  },
  {
    path: '/login',
    name: 'login',
    component: () => import('../pages/Auth/Login.vue'),
  },
  {
    path: '/register',
    name: 'register',
    component: () => import('../pages/Auth/Register.vue'),
  },

  // Espace Admin 
  {
    path: '/admin/dashboard',
    name: 'admin.dashboard',
    component: () => import('../pages/Admin/Dashboard.vue'),
    meta: { requiresAuth: true, role: 'admin' },
  },
  {
    path: '/admin/users',
    name: 'admin.users',
    component: () => import('../pages/Admin/Users.vue'),
    meta: { requiresAuth: true, role: 'admin' },
  },
  {
    path: '/admin/offres',
    name: 'admin.offres',
    component: () => import('../pages/Admin/Offres.vue'),
    meta: { requiresAuth: true, role: 'admin' },
  },
  {
    path: '/admin/signalements',
    name: 'admin.signalements',
    component: () => import('../pages/Admin/Signalements.vue'),
    meta: { requiresAuth: true, role: 'admin' },
  },
  {
    path: '/admin/statistiques',
    name: 'admin.statistiques',
    component: () => import('../pages/Admin/Statistiques.vue'),
    meta: { requiresAuth: true, role: 'admin' },
  },
  {
    path: '/admin/bloques',
    name: 'admin.bloques',
    component: () => import('../pages/Admin/Bloques.vue'),
    meta: { requiresAuth: true, role: 'admin' },
  },

  // Espace Entreprise
  {
    path: '/entreprise/dashboard',
    name: 'entreprise.dashboard',
    component: () => import('../pages/Entreprise/Dashboard.vue'),
    meta: { requiresAuth: true, role: 'entreprise' },
  },
  {
    path: '/entreprise/offres',
    name: 'entreprise.offres',
    component: () => import('../pages/Entreprise/Offres.vue'),
    meta: { requiresAuth: true, role: 'entreprise' },
  },
  {
    path: '/entreprise/candidatures',
    name: 'entreprise.candidatures',
    component: () => import('../pages/Entreprise/Candidatures.vue'),
    meta: { requiresAuth: true, role: 'entreprise' },
  },
  {
    path: '/entreprise/stagiaires',
    name: 'entreprise.stagiaires',
    component: () => import('../pages/Entreprise/Stagiaires.vue'),
    meta: { requiresAuth: true, role: 'entreprise' },
  },
  {
    path: '/entreprise/signalements',
    name: 'entreprise.signalements',
    component: () => import('../pages/Entreprise/Signalements.vue'),
    meta: { requiresAuth: true, role: 'entreprise' },
  },
  {
    path: '/entreprise/profil',
    name: 'entreprise.profil',
    component: () => import('../pages/Entreprise/Profil.vue'),
    meta: { requiresAuth: true, role: 'entreprise' },
  },

  // Espace Stagiaire
  {
    path: '/stagiaire/dashboard',
    name: 'stagiaire.dashboard',
    component: () => import('../pages/Stagiaire/Dashboard.vue'),
    meta: { requiresAuth: true, role: 'stagiaire' },
  },
  {
    path: '/stagiaire/offres',
    name: 'stagiaire.offres',
    component: () => import('../pages/Stagiaire/Offres.vue'),
    meta: { requiresAuth: true, role: 'stagiaire' },
  },
  {
    path: '/stagiaire/candidatures',
    name: 'stagiaire.candidatures',
    component: () => import('../pages/Stagiaire/MesCandidatures.vue'),
    meta: { requiresAuth: true, role: 'stagiaire' },
  },
  {
    path: '/stagiaire/stage',
    name: 'stagiaire.stage',
    component: () => import('../pages/Stagiaire/MonStage.vue'),
    meta: { requiresAuth: true, role: 'stagiaire' },
  },
  {
    path: '/stagiaire/favoris',
    name: 'stagiaire.favoris',
    component: () => import('../pages/Stagiaire/Favoris.vue'),
    meta: { requiresAuth: true, role: 'stagiaire' },
  },
  {
    path: '/stagiaire/commentaires',
    name: 'stagiaire.commentaires',
    component: () => import('../pages/Stagiaire/Commentaires.vue'),
    meta: { requiresAuth: true, role: 'stagiaire' },
  },
  {
    path: '/stagiaire/profil',
    name: 'stagiaire.profil',
    component: () => import('../pages/Stagiaire/Profil.vue'),
    meta: { requiresAuth: true, role: 'stagiaire' },
  },

  // 404 
  {
    path: '/:pathMatch(.*)*',
    redirect: '/',
  },
]

const router = createRouter({
  history: createWebHistory(),
  routes,
})

// Guard global — vérifie auth + rôle avant chaque navigation
router.beforeEach((to, from, next) => {
  const auth = useAuthStore()

  // Page protégée mais pas connecté
  if (to.meta.requiresAuth && !auth.isAuthenticated) {
    return next('/login')
  }

  // Connecté mais mauvais rôle
  if (to.meta.role && auth.user?.role !== to.meta.role) {
    if (auth.isAdmin)      return next('/admin/dashboard')
    if (auth.isEntreprise) return next('/entreprise/dashboard')
    if (auth.isStagiaire)  return next('/stagiaire/dashboard')
    return next('/login')
  }

  // Connecté et essaie d'aller sur login/register
  if ((to.name === 'login' || to.name === 'register') && auth.isAuthenticated) {
    if (auth.isAdmin)      return next('/admin/dashboard')
    if (auth.isEntreprise) return next('/entreprise/dashboard')
    if (auth.isStagiaire)  return next('/stagiaire/dashboard')
  }

  next()
})

export default router
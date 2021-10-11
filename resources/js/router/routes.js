function page (path) {
  return () => import(/* webpackChunkName: '' */ `~/pages/${path}`).then(m => m.default || m)
}

export default [
  { path: '/', name: 'welcome', component: page('welcome.vue') },

  { path: '/login', name: 'login', component: page('auth/login.vue') },
  { path: '/register', name: 'register', component: page('auth/register.vue') },
  { path: '/password/reset', name: 'password.request', component: page('auth/password/email.vue') },
  { path: '/password/reset/:token', name: 'password.reset', component: page('auth/password/reset.vue') },
  { path: '/email/verify/:id', name: 'verification.verify', component: page('auth/verification/verify.vue') },
  { path: '/email/resend', name: 'verification.resend', component: page('auth/verification/resend.vue') },

  { path: '/home', name: 'home', component: page('home.vue') },


  
  /*********************
   ***Settings Route***
  /*********************/
  { 
    path: '/settings', 
    name: 'settings', 
    component: page('settings/Index.vue'),
  },
  { 
    path: '/settings/general', 
    name: 'settings.general', 
    component: page('settings/company/Settings.vue'),
    meta: { permissions:['company_settings'] }
  },
  { path: '/settings/team', name: 'settings.team', component: page('settings/team/Index.vue') },
  { path: '/settings/team/create', name: 'team.create', component: page('settings/team/Create.vue') },
  { path: '/settings/team/edit/:slug', name: 'team.edit', component: page('settings/team/Edit.vue') },
  { path: '/settings/payment', name: 'settings.payment', component: page('settings/payment/payment.vue') },
  { path: '/settings/roles', name: 'settings.roles', component: page('settings/roles/Roles.vue') },
  { path: '/settings/role/create', name: 'role.create', component: page('settings/roles/RoleCreate.vue') },
  { path: '/settings/role/edit/:slug', name: 'role.edit', component: page('settings/roles/RoleEdit.vue') },
  { path: '/settings/permission/create', name: 'settings.permission.create', component: page('settings/roles/Permission.vue') },
  { path: '/settings/orders', name: 'settings.orders', component: page('settings/order/Order.vue') },
  { path: '/settings/tags', name: 'settings.tags', component: page('settings/tags/Index.vue') },
  { path: '/settings/emails', name: 'settings.emails', component: page('settings/emails/emails.vue') },
  { path: '/settings/logs', name: 'settings.logs', component: page('settings/logs/logs.vue') },


  // Service page
  { 
    path: '/services', 
    name: 'services', 
    component: page('service/Index.vue'),
    meta: { permissions:['service_view'] }
  },
  { 
    path: '/service/create', 
    name: 'service.create', 
    component: page('service/Create.vue') ,
    meta: { permissions:['service_create'] }
  },

  // Order form
  { 
    path: '/order-form', 
    name: 'forms', 
    component: page('order-form/Index.vue'),
    meta: { permissions:['order_form_view'] }
  },
  { 
    path: '/order-form/create', 
    name: 'form.create', 
    component: page('order-form/Create.vue'),
    meta: { permissions:['order_form_create'] }
  },

  // error page
  { path: '/permission-denied', name: 'permission-denied', component: page('errors/101.vue') },
  { path: '*', component: page('errors/404.vue') }
]

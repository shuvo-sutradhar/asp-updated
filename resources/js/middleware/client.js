import store from '~/store'

export default (to, from, next) => {
  if (store.getters['auth/user'].account_role !== 2) {
    next({ name: 'home' })
  } else {
    next()
  }
}

import Vue from 'vue'
import Card from './Card'
import Child from './Child'
import Button from './Button'
import Checkbox from './Checkbox'
import Dropdown from './Dropdown'
import Pagination from './Pagination'
import TableLoading from './TableLoading'
import Search from './Search'
import Breadcrumbs from './Breadcrumbs'
import SidebarDrawer from './SidebarDrawer'
// import VueSelect from './VueSelect'
import Modal from './Modal'
import { HasError, AlertError, AlertSuccess } from 'vform'

// Components that are registered globaly.
[
  Card,
  Child,
  Button,
  Checkbox,
  Dropdown,
  HasError,
  AlertError,
  AlertSuccess,
  Pagination,
  TableLoading,
  Search,
  Breadcrumbs,
  SidebarDrawer,
  //VueSelect,
  Modal
].forEach(Component => {
  Vue.component(Component.name, Component)
})

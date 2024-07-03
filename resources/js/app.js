require('./bootstrap');

import { createApp } from 'vue';
import Dashboard from './components/Dashboard.vue';
import HighchartsVue from 'highcharts-vue';
import tooltip from './components/directives/tooltip';
import DataTables from 'datatables.net-vue3';

// Import CSS
import 'bootstrap-daterangepicker/daterangepicker.css';
import './components/directives/tooltip.css'

const currencyFormatter = function(value) {
  if (!value) return '';
  value = value.toString();
  let numberString = value.replace(/[^,\d]/g, '').toString(),
      split = numberString.split(','),
      sisa = split[0].length % 3,
      rupiah = split[0].substr(0, sisa),
      ribuan = split[0].substr(sisa).match(/\d{3}/gi);

  if (ribuan) {
      let separator = sisa ? '.' : '';
      rupiah += separator + ribuan.join('.');
  }

  rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
  return rupiah;
};

const app = createApp({});

app.config.globalProperties.$currencyFormatter = currencyFormatter;

app.use(HighchartsVue);

app.use(DataTables);

app.directive("tooltip", tooltip);

app.component('dashboard', Dashboard);

app.mount('#app');

<template>
  <div class="mt-4">
    <div class="col-12">
      <div class="card">
        <div class="card-header border-bottom mb-3">
          <h5 class="card-title mb-4">Filter By Quarters</h5>
          <div class="row">
            <div class="col-lg-4">
              <select class="form-control form-select" v-model="selectedYear">
                <option v-for="year in years" :key="year" :value="year">
                  {{ year }}
                </option>
              </select>
            </div>
            <div class="col-lg-8">
              <div class="container pt-2">
                <Slider v-model="selectedQuarter" />
              </div>
            </div>
          </div>
        </div>

        <div class="card-body">
          <DataTable
            :data="rows"
            :columns="columns"
            :options="tableOptions"
            @page="onPage"
            :loading="loading"
          >
          </DataTable>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { defineComponent, ref, onMounted, watch } from "vue";
import axios from "axios";
import DataTable from "datatables.net-vue3";
import Slider from "./Slider.vue";
import DataTablesCore from "datatables.net";
import "datatables.net-responsive";

DataTable.use(DataTablesCore);

export default defineComponent({
  components: {
    DataTable,
    Slider,
  },
  props: {
    theme: {
      type: String,
      default: "light",
    },
  },
  setup(props) {
    const selectedYear = ref("");
    const selectedQuarter = ref(1);
    const years = ref([]);
    const rows = ref([]);
    const pagination = ref({
      page: 0,
      perPage: 10,
      total: 0,
    });
    const loading = ref(false);

    const fetchData = async (page = 1) => {
      if (!selectedYear.value) {
        selectedYear.value = new Date().getFullYear();
      }

      loading.value = true;
      try {
        const response = await axios.get(`/dashboard/data-quarter`, {
          params: {
            page,
            perPage: pagination.value.perPage,
            quarter: selectedQuarter.value,
            year: selectedYear.value,
          },
        });
        const data = response.data;
        console.log("Data received from API:", data);

        rows.value = data.content.data || [];
        pagination.value.total = data.content.total || 0;
      } catch (error) {
        console.error("Failed to fetch data:", error);
      } finally {
        loading.value = false;
      }
    };

    const onPage = (event) => {
      const page = event.page + 1;
      pagination.value.page = event.page;
      fetchData(page);
    };

    onMounted(() => {
      const currentYear = new Date().getFullYear();
      for (let i = 0; i <= 10; i++) {
        years.value.push(currentYear - i);
      }
      selectedYear.value = currentYear;
      fetchData();
    });

    watch(
      () => [selectedYear.value, selectedQuarter.value],
      () => {
        pagination.value.page = 0;
        fetchData();
      },
      { immediate: true }
    );

    function replaceAndUcwords(str) {
      let newStr = str.replace(/_/g, " ");

      newStr = newStr.replace(/\b\w/g, function (char) {
        return char.toUpperCase();
      });

      return newStr;
    }

    const columns = ref([
      {
        title: "Tanggal Transaksi",
        data: "tanggal",
        className: "text-left",
        render: (data, type, row) => {
          return new Date(data).toLocaleDateString();
        },
      },
      {
        title: "Jenis Transaksi",
        data: "jenis_transaksi",
        render: (data) => replaceAndUcwords(data),
      },
      {
        title: "Komponen",
        data: "category",
        render: (data) => replaceAndUcwords(data),
      },
      { title: "Project", data: "project_name" },
      { title: "Nama Tujuan", data: "nama_tujuan" },
      {
        title: "Nominal",
        data: "nominal",
        render: (data) => `Rp ${data.toLocaleString()}`,
      },
    ]);

    const tableOptions = ref({
      paging: true,
      searching: false,
      ordering: true,
      info: true,
      pageLength: pagination.value.perPage,
      responsive: true,
    });

    return {
      selectedYear,
      selectedQuarter,
      years,
      rows,
      columns,
      tableOptions,
      pagination,
      loading,
      fetchData,
      onPage,
    };
  },
});
</script>

<style scoped>
@import "datatables.net-dt";

/* Add any additional styles here */
.theme-dark .dataTables_wrapper {
  background-color: #2c3e50;
  color: #ecf0f1;
}

.theme-dark .dataTables_wrapper .dataTables_length,
.theme-dark .dataTables_wrapper .dataTables_filter,
.theme-dark .dataTables_wrapper .dataTables_info,
.theme-dark .dataTables_wrapper .dataTables_paginate {
  color: #ecf0f1;
}

.theme-light .dataTables_wrapper {
  background-color: #ffffff;
  color: #000000;
}

.dataTables_wrapper .text-left {
  text-align: left;
}
</style>

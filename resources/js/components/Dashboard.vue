<template>
  <div class="row">
    <!-- Welcome Page -->
    <div class="col-12">
      <div class="card bg-transparent shadow-none my-6 border-0">
        <div class="card-body pb-3">
          <div class="col-md-12">
            <h3 class="text-capitalize">
              Welcome back, {{ userData.name }} 👋🏻
            </h3>
            <div class="col-12 col-lg-10">
              <p>
                Agar tampilan lebih maksimal, ubah settingan scale pada display
                desktop anda menjadi 100% atau zoom out menjadi 80% pada page
                zoom <mark>Browser</mark> menggunakan
                <mark> ctrl - atau command - </mark>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Welcome Page -->

    <!-- Statistics -->
    <div class="col-lg-6 col-sm-6 mb-4">
      <div class="card card-border-shadow-primary">
        <div class="card-body">
          <div class="d-flex align-items-center mb-2">
            <div class="avatar me-4">
              <span class="avatar-initial rounded bg-label-danger">
                <i class="ti ti-hexagonal-prism ti-28px"></i>
              </span>
            </div>
            <h4 class="mb-0">{{ dataCard.percent?.totalDataThisYear }}</h4>
          </div>
          <p class="mb-1">Total Transaction Project Maker</p>
          <p
            class="mb-0"
            style="cursor: pointer"
            v-tooltip="
              dataCard.percent?.status == 'positif'
                ? `Kenaikan ${
                    dataCard.percent?.percentageThisYear
                  }% dibanding dengan tahun lalu (${
                    new Date().getFullYear() - 1
                  }) : ${
                    dataCard.percent?.percentageLastYear
                  }%. dengan total trasaction ${
                    dataCard.percent?.totalDataLastyear
                  }`
                : `Penurunan ${
                    dataCard.percent?.percentageThisYear
                  }% dibanding dengan tahun lalu (${
                    new Date().getFullYear() - 1
                  }) : ${
                    dataCard.percent?.percentageLastYear
                  }%, dengan total trasaction ${
                    dataCard.percent?.totalDataLastyear
                  }`
            "
          >
            <span class="text-heading fw-medium me-2">
              <i
                :class="
                  dataCard.percent?.status == 'positif'
                    ? 'ti ti-stairs-up ti-18px text-danger'
                    : 'ti ti-stairs-down ti-18px text-success'
                "
              />
              <b>{{ dataCard.percent?.percentageThisYear }}%</b>
            </span>
            <small class="text-muted">than last Year</small>
          </p>
        </div>
      </div>
    </div>

    <div class="col-lg-6 col-sm-6 mb-4">
      <div class="card card-border-shadow-primary">
        <div class="card-body">
          <div class="d-flex align-items-center mb-2">
            <div class="avatar me-4">
              <span class="avatar-initial rounded bg-label-danger">
                <i class="ti ti-businessplan ti-28px"></i>
              </span>
            </div>
            <h4 class="mb-0">
              IDR
              {{ $currencyFormatter(dataCard.nominal?.totalNominalThisYear) }}
            </h4>
          </div>
          <p class="mb-1">Total Nominal Transaction Project Maker</p>
          <p
            class="mb-0"
            style="cursor: pointer"
            v-tooltip="
              dataCard.nominal?.status == 'positif'
                ? `Kenaikan ${
                    dataCard.nominal?.percentageThisYear
                  }% dibanding dengan tahun lalu (${
                    new Date().getFullYear() - 1
                  }) : ${
                    dataCard.nominal?.percentageLastYear
                  }%, dengan total nominal ${dataCard.nominal?.totalLastYear}`
                : `Penurunan ${
                    dataCard.nominal?.percentageThisYear
                  }% dibanding dengan tahun lalu (${
                    new Date().getFullYear() - 1
                  }) : ${
                    dataCard.nominal?.percentageLastYear
                  }%, dengan total nominal ${dataCard.nominal?.totalLastYear}`
            "
          >
            <span class="text-heading fw-medium me-2">
              <i
                :class="
                  dataCard.nominal?.status == 'positif'
                    ? 'ti ti-stairs-up ti-18px text-danger'
                    : 'ti ti-stairs-down ti-18px text-success'
                "
              />
              <b>{{ dataCard.nominal?.percentageThisYear }}%</b>
            </span>
            <small class="text-muted">than last year</small>
          </p>
        </div>
      </div>
    </div>
    <!--/ Statistics -->

    <!-- start char bar and pie -->
    <div class="col-12">
      <div class="card">
        <div class="card-header border-bottom">
          <h5 class="card-title mb-3">Filter</h5>
          <div class="row">
            <div class="col-lg-6 col-12">
              <FilterDateRange
                :isLoading="isLoading"
                :noData="noData"
                sizeInput="col-lg-8 col-12 mt-2"
                :startDate="filterDate.startDate"
                :endDate="filterDate.endDate"
                inputId="daterange"
                @clear="clearDateRange"
              />
            </div>
            <div class="col-lg-6 col-12">
              <div class="col-lg-8 col-12 mt-2">
                <Multiselect
                  v-model="selectedProject"
                  :options="projects"
                  :custom-label="customLabelForProject"
                  placeholder="Select Project"
                  @select="handleSelect"
                />
              </div>
            </div>
          </div>
        </div>
        <div class="card-body boorder-top">
          <div class="row">
            <div class="col-lg-6 col-12 card-separator">
              <div v-if="!isLoading && !noDataBar" class="row">
                <div class="col-12">
                  <h6 class="mt-4 mb-3">
                    Transaction Maker (Jenis Transaction)
                  </h6>
                  <BarChart :chartData="barChartData" />
                </div>
                <div class="col-12">
                  <BarTable :data="barData" :theme="theme" />
                  <p class="mt-3">
                    Grand Total : <b>IDR {{ $currencyFormatter(barChartData.grand_total) }}</b>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-lg-6 col-12">
              <div v-if="!isLoading && !noData" class="row">
                <div class="col-12">
                  <h6 class="mt-4 mb-3" style="text-align: right">
                    Transaction Maker (Komponen)
                  </h6>
                  <PieChart :chartData="chartData" />
                </div>
                <div class="col-12">
                  <PieTable :data="groupData" :theme="theme" />
                  <p class="mt-3" style="text-align: right;">
                    Grand Total : <b>IDR {{ $currencyFormatter(chartData.grand_total) }}</b>
                  </p>
                </div>
              </div>
            </div>
            <div v-if="isLoading" class="loading-spinner-container">
              <div
                class="spinner-border spinner-border-lg text-primary"
                role="status"
              >
                <span class="visually-hidden">Loading...</span>
              </div>
            </div>
            <div v-else-if="noData" class="no-data-container text-secondary">
              Tidak ada data pada
              <span v-if="filterDate.startDate !== null">
                &nbsp;periode
                <b>{{ filterDate.startDate }} - {{ filterDate.endDate }}</b>
              </span>
              <span v-if="selectedProject !== null"
                >&nbsp;Project : <b>{{ selectedProject.name }}</b></span
              >
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- end chat bar and pie -->
    <div class="mt-4">
      <CardStatistic :data="dataStatistic" />
    </div>

    <QuarterTable :theme="theme"/>
  </div>
</template>

<script>
import { ref, onMounted, watch } from "vue";
import PieChart from "./partials/PieChart.vue";
import PieTable from "./partials/PieTable.vue";
import BarTable from "./partials/BarTable.vue";
import BarChart from "./partials/BarChart.vue";
import CardStatistic from "./partials/CardStatistic.vue";
import FilterDateRange from "./partials/FilterDateRange.vue";
import QuarterTable from "./partials/QuarterTable.vue";
import Slider from "./partials/Slider.vue";
import Multiselect from "vue-multiselect";
import "vue-multiselect/dist/vue-multiselect.css";

import axios from "axios";
import $ from "jquery";
import "bootstrap-daterangepicker";

export default {
  components: {
    PieChart,
    PieTable,
    FilterDateRange,
    BarChart,
    BarTable,
    Multiselect,
    CardStatistic,
    Slider,
    QuarterTable
  },
  setup() {
    const filterDate = ref({
      startDate: null,
      endDate: null,
      daterangePicker: null,
    });

    const barChartData = ref({
      total_transfer: 0,
      total_cash: 0,
      total_po: 0,
      grand_total: 0,
    });

    const chartData = ref(null);
    const barData = ref([]);
    const noDataBar = ref(false);
    const isLoading = ref(true);
    const noData = ref(false);
    const groupData = ref([]);
    const userData = window.auth;
    const projects = ref([]);
    const selectedProject = ref(null);
    const dataStatistic = ref({});
    const dataCard = ref({
      percent: null,
      nominal: null,
    });

    const theme =
      localStorage.getItem(
        "templateCustomizer-vertical-menu-template--Style"
      ) || "light";

    const fetchDataPie = async () => {
      isLoading.value = true;
      try {
        let url = "/pie-data?";
        if (filterDate.value.startDate && filterDate.value.endDate) {
          url += `start_date=${filterDate.value.startDate}&end_date=${filterDate.value.endDate}&`;
        }

        if (selectedProject.value !== null) {
          url += `projectId=${selectedProject.value.id}&`;
        }

        const response = await axios.get(url);
        const data = response.data.content.data_sum;
        chartData.value = data;
        groupData.value = response.data.content.data_group;

        noData.value =
          !data.total_delivery &&
          !data.total_end_user &&
          !data.total_service &&
          !data.total_wapu;
      } catch (error) {
        console.error("Failed to fetch data:", error);
      } finally {
        isLoading.value = false;
      }
    };

    const fetchProjectList = async () => {
      try {
        const response = await axios.get(`/dashboard/project-list`);
        projects.value = response.data;
      } catch (error) {
        console.error("Failed to fetch project data:", error);
      }
    };

    const fetchDataBar = async () => {
      try {
        let url = "/bar-data?";
        if (filterDate.value.startDate && filterDate.value.endDate) {
          url += `start_date=${filterDate.value.startDate}&end_date=${filterDate.value.endDate}&`;
        }

        if (selectedProject.value !== null) {
          url += `projectId=${selectedProject.value.id}&`;
        }

        const response = await axios.get(url);
        const data = response.data.content.data_sum;

        barChartData.value = {
          total_transfer: parseInt(data.total_transfer),
          total_cash: parseInt(data.total_cash),
          total_po: parseInt(data.total_po),
          grand_total: parseInt(data.grand_total),
        };

        barData.value = response.data.content.data_group;

        noDataBar.value =
          !data.total_cash && !data.total_po && !data.total_transfer;
      } catch (error) {
        console.error("Failed to fetch bar data:", error);
      } finally {
        isLoading.value = false;
      }
    };

    const fetchDataCard = async () => {
      try {
        const response = await axios.get(`/dashboard/card-header/total-data`);
        const statistic = await axios.get(`/dashboard/card-statistic`);
        const getCardNominal = await axios.get(
          "dashboard/card-header/total-nominal"
        );

        dataCard.value.percent = response.data;
        dataCard.value.nominal = getCardNominal.data;
        dataStatistic.value = statistic.data;
      } catch (error) {
        console.error("Failed to fetch data:", error);
      }
    };

    const clearDateRange = () => {
      filterDate.value.startDate = null;
      filterDate.value.endDate = null;
      if (filterDate.value.daterangePicker) {
        $(filterDate.value.daterangePicker).val("");
      }
      fetchDataPie();
      fetchDataBar();
    };

    const handleSelect = () => {
      fetchDataBar();
      fetchDataPie();
    };

    const customLabelForProject = (option) => `${option.name} - ${option.code}`;

    onMounted(() => {
      filterDate.value.daterangePicker = $("#daterange");
      $(filterDate.value.daterangePicker).daterangepicker(
        {
          opens: "left",
          autoApply: true,
        },
        function (start, end) {
          filterDate.value.startDate = start.format("YYYY-MM-DD");
          filterDate.value.endDate = end.format("YYYY-MM-DD");
          fetchDataPie();
          fetchDataBar();
        }
      );

      fetchDataPie();
      fetchDataBar();
      fetchProjectList();
      fetchDataCard();
    });

    watch(
      [() => filterDate.value.startDate, () => filterDate.value.endDate],
      fetchDataPie,
      fetchDataBar
    );

    return {
      filterDate,
      clearDateRange,
      chartData,
      barChartData,
      isLoading,
      noData,
      noDataBar,
      groupData,
      fetchDataPie,
      fetchDataBar,
      userData,
      barData,
      theme,
      projects,
      selectedProject,
      customLabelForProject,
      handleSelect,
      dataCard,
      dataStatistic,
    };
  },
};
</script>

<style scoped>
.loading-spinner-container,
.no-data-container {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 200px;
  width: 100%;
  text-align: center;
}
</style>

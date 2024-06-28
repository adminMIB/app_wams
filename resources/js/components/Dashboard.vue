<template>
  <div class="row">
    <!-- Welcome Page -->
    <div class="col-xl-4 mb-4 col-lg-5 col-12">
      <div class="card">
        <div class="card-body pb-3">
          <div class="col-md-12">
            <h3 class="text-capitalize">Welcome back, {{ userData.name }} 👋🏻</h3>
            <div class="col-12 col-lg-10">
              <p>
                Agar tampilan lebih maksimal, ubah settingan scale pada display
                desktop anda menjadi 100% atau zoom out menjadi 80% pada page
                zoom menggunakan <mark> ctrl - atau command - </mark>
              </p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Welcome Page -->

    <!-- Statistics -->
    <div class="col-xl-8 mb-4 col-lg-7 col-12">
      <div class="card h-100">
        <div class="card-header d-flex justify-content-between mb-3">
          <h5 class="card-title mb-0">Statistics</h5>
        </div>
        <div class="card-body">
          <div class="row gy-3">
            <StatCard
              v-for="(item, index) in statItems"
              :key="index"
              :badgeClass="item.badgeClass"
              :iconClass="item.iconClass"
              :value="item.value"
              :label="item.label"
            />
          </div>
        </div>
      </div>
    </div>
    <!--/ Statistics -->

    <!-- Start chart bar trans maker by jenis trx -->
    <div class="col-12 col-lg-4 mb-4">
      <div class="card">
        <div class="card-header">
          <h6>Total Transaction Maker Projects (Jenis Transaksi)</h6>
        </div>
        <div class="card-body">
          <FilterDateRange
            :isLoading="isBarLoading"
            :noData="noDataBar"
            inputId="barFilter"
            :startDate="barFilter.startDate"
            :endDate="barFilter.endDate"
            sizeInput="col-12 col-lg-10 mb-4"
            @clear="clearDateRangeBar"
          />
          <div v-if="!isBarLoading && !noDataBar" class="row">
            <div class="col-12">
              <BarChart :chartData="barChartData" />
            </div>
            <div class="col-12 mt-2">
              <BarTable :data="barData" />
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End chart bar -->

    <!-- Chart pie transaction maker by category -->
    <div class="col-12 col-lg-8 mb-4">
      <div class="card">
        <div class="card-header">
          <h6>Total Transaction Maker Projects (Komponen)</h6>
        </div>
        <div class="card-body">
          <FilterDateRange
            :isLoading="isLoading"
            :noData="noData"
            :startDate="pieFilter.startDate"
            :endDate="pieFilter.endDate"
            inputId="daterange"
            @clear="clearDateRange"
          />
          <div v-if="!isLoading && !noData" class="row">
            <div class="col12 col-lg-6">
              <PieTable :data="groupData" />
            </div>
            <div class="col-12 col-lg-6">
              <PieChart :chartData="chartData" />
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- End chart pie transaction maker -->
  </div>
</template>

<script>
import { ref, onMounted, watch } from "vue";
import PieChart from "./partials/PieChart.vue";
import PieTable from "./partials/PieTable.vue";
import BarTable from "./partials/BarTable.vue";
import BarChart from "./partials/BarChart.vue";
import StatCard from "./partials/StatCard.vue";
import FilterDateRange from "./partials/FilterDateRange.vue";

import axios from "axios";
import $ from "jquery";
import "bootstrap-daterangepicker";

export default {
  components: {
    PieChart,
    PieTable,
    StatCard,
    FilterDateRange,
    BarChart,
    BarTable
  },
  setup() {
    const pieFilter = ref({
      startDate: null,
      endDate: null,
      daterangePicker: null,
    });

    const barFilter = ref({
      daterangePicker: "",
      startDate: "",
      endDate: "",
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
    const isBarLoading = ref(true);
    const noData = ref(false);
    const groupData = ref([]);
    const userData = window.auth;

    const fetchDataPie = async () => {
      isLoading.value = true;
      try {
        let url = "/pie-data";
        if (pieFilter.value.startDate && pieFilter.value.endDate) {
          url += `?start_date=${pieFilter.value.startDate}&end_date=${pieFilter.value.endDate}`;
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

    const fetchDataBar = async () => {
      try {
        let url = "/bar-data";
        if (barFilter.value.startDate && barFilter.value.endDate) {
          url += `?start_date=${barFilter.value.startDate}&end_date=${barFilter.value.endDate}`;
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
        isBarLoading.value = false;
      }
    };

    const clearDateRange = () => {
      pieFilter.value.startDate = null;
      pieFilter.value.endDate = null;
      if (pieFilter.value.daterangePicker) {
        $(pieFilter.value.daterangePicker).val("");
      }
      fetchDataPie();
    };

    const clearDateRangeBar = () => {
      barFilter.value.startDate = null;
      barFilter.value.endDate = null;
      if (barFilter.value.daterangePicker) {
        $(barFilter.value.daterangePicker).val("");
      }
      fetchDataBar();
    };

    onMounted(() => {
      pieFilter.value.daterangePicker = $("#daterange");
      $(pieFilter.value.daterangePicker).daterangepicker(
        {
          opens: "left",
          autoApply: true,
        },
        function (start, end) {
          pieFilter.value.startDate = start.format("YYYY-MM-DD");
          pieFilter.value.endDate = end.format("YYYY-MM-DD");
          fetchDataPie();
        }
      );

      barFilter.value.daterangePicker = $("#barFilter");
      $(barFilter.value.daterangePicker).daterangepicker(
        {
          opens: "left",
          autoApply: true,
        },
        function (start, end) {
          barFilter.value.startDate = start.format("YYYY-MM-DD");
          barFilter.value.endDate = end.format("YYYY-MM-DD");
          fetchDataBar();
        }
      );

      fetchDataPie();
      fetchDataBar();
    });

    watch(
      [() => pieFilter.value.startDate, () => pieFilter.value.endDate],
      fetchDataPie
    );

    watch(
      [() => barFilter.value.startDate, () => barFilter.value.endDate],
      fetchDataBar
    );

    const statItems = [
      {
        badgeClass: "bg-label-primary",
        iconClass: "ti ti-chart-pie-2 ti-sm",
        value: "230k",
        label: "Total Opties",
      },
      {
        badgeClass: "bg-label-info",
        iconClass: "ti ti-users ti-sm",
        value: "8.549k",
        label: "Total Projects",
      },
      {
        badgeClass: "bg-label-danger",
        iconClass: "ti ti-shopping-cart ti-sm",
        value: "1.423k",
        label: "Total Project Maker",
      },
      {
        badgeClass: "bg-label-success",
        iconClass: "ti ti-currency-dollar ti-sm",
        value: "$9745",
        label: "Revenue",
      },
    ];

    return {
      pieFilter,
      barFilter,
      clearDateRange,
      clearDateRangeBar,
      chartData,
      barChartData,
      isLoading,
      isBarLoading,
      noData,
      noDataBar,
      groupData,
      statItems,
      fetchDataPie,
      fetchDataBar,
      userData,
      barData
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

.row > .row {
  width: 100%;
}
</style>

<template>
  <div>
    <highcharts :options="chartOptions" class="highchart-dark" />
  </div>
</template>

<script>
import { ref, defineComponent, watch } from "vue";
import Highcharts from "highcharts";
import accessibility from "highcharts/modules/accessibility";
import Highcharts3D from "highcharts/highcharts-3d";
import "./chart.css";

// Inisialisasi modul 3D
Highcharts3D(Highcharts);
accessibility(Highcharts);

export default defineComponent({
  name: "PieChart3D",
  props: {
    chartData: {
      type: Object,
      default: () => ({
        total_delivery: 0,
        total_end_user: 0,
        total_service: 0,
      }),
    },
    theme: {
      type: String,
      default: "light",
    },
  },
  setup(props) {
    const percentages = ref([]);

    const calculatePercentages = () => {
      const total =
        parseInt(props.chartData.total_delivery) +
        parseInt(props.chartData.total_end_user) +
        parseInt(props.chartData.total_service);

      percentages.value = [
        total ? ((props.chartData.total_delivery / total) * 100).toFixed(2) : 0,
        total ? ((props.chartData.total_end_user / total) * 100).toFixed(2) : 0,
        total ? ((props.chartData.total_service / total) * 100).toFixed(2) : 0,
      ];
    };

    const currencyFormatter = function (value) {
      if (!value) return "";
      value = value.toString();
      let numberString = value.replace(/[^,\d]/g, "").toString(),
        split = numberString.split(","),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

      if (ribuan) {
        let separator = sisa ? "." : "";
        rupiah += separator + ribuan.join(".");
      }

      rupiah = split[1] != undefined ? rupiah + "," + split[1] : rupiah;
      return "IDR " + rupiah;
    };

    const updateChartOptions = () => {
      calculatePercentages();
      chartOptions.value = {
        chart: {
          type: "pie",
          options3d: {
            enabled: true,
            alpha: 45,
            beta: 0,
          },
          backgroundColor: "#2f364f00",
        },
        title: {
          text: "",
        },
        accessibility: {
          enabled: true,
          point: {
            valueSuffix: "%",
          },
        },
        tooltip: {
          pointFormatter: function () {
            const index = this.index;
            const formatted = currencyFormatter(this.y)
            return `<b>${formatted}</b> (${percentages.value[index]}%)`;
          },
        },
        plotOptions: {
          pie: {
            innerSize: 100,
            depth: 45,
            dataLabels: {
              enabled: true,
              formatter: function () {
                const index = this.point.index;
                return `${this.key} (${percentages.value[index]}%)`;
              },
              color: props.theme == "dark" ? "#FFFFFF" : "#000000",
            },
          },
        },
        series: [
          {
            name: "Total Nominal",
            data: [
              ["Delivery", parseInt(props.chartData.total_delivery)],
              ["End User", parseInt(props.chartData.total_end_user)],
              ["Service", parseInt(props.chartData.total_service)],
            ],
          },
        ],
      };
    };

    const chartOptions = ref({});
    updateChartOptions();

    watch(
      () => props.chartData,
      (newChartData) => {
        updateChartOptions();
      },
      { deep: true }
    );

    return {
      chartOptions,
    };
  },
});
</script>

<style>
.highcharts-figure,
.highcharts-data-table table {
  min-width: 320px;
  max-width: 800px;
  margin: 1em auto;
}

.highcharts-data-table table {
  font-family: Verdana, sans-serif;
  border-collapse: collapse;
  border: 1px solid #ebebeb;
  margin: 10px auto;
  text-align: center;
  width: 100%;
  max-width: 500px;
}

.highcharts-background {
  fill: #2f364f00;
}
</style>

<template>
  <div>
    <highcharts :options="chartOptions" class="chartjs"></highcharts>
  </div>
</template>

<script>
import { ref, defineComponent } from "vue";
import Highcharts from "highcharts";
import accessibility from "highcharts/modules/accessibility";
import Highcharts3D from "highcharts/highcharts-3d";

// Inisialisasi modul 3D
Highcharts3D(Highcharts);
accessibility(Highcharts);

export default defineComponent({
  name: "PieChart3D",
  props: {
    chartData: Object,
  },
  setup(props) {
    const total =
      parseInt(props.chartData.total_delivery) +
      parseInt(props.chartData.total_end_user) +
      parseInt(props.chartData.total_service);
    const percentages = [
      total ? ((props.chartData.total_delivery / total) * 100).toFixed(2) : 0,
      total ? ((props.chartData.total_end_user / total) * 100).toFixed(2) : 0,
      total ? ((props.chartData.total_service / total) * 100).toFixed(2) : 0,
    ];

    const chartOptions = ref({
      chart: {
        type: "pie",
        options3d: {
          enabled: true,
          alpha: 45,
          beta: 0,
        },
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
      plotOptions: {
        pie: {
          innerSize: 100,
          depth: 45,
          dataLabels: {
            enabled: true,
            formatter: function() {
              const index = this.point.index;
              return `${this.key} (${percentages[index]}%)`;
            },
            color: "#ffffff",
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
    });

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
</style>

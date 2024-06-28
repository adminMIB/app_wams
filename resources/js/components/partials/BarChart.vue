<template>
  <div>
    <highcharts :options="chartOptions" class="chartjs"></highcharts>
  </div>
</template>

<script>
import { ref, defineComponent, watch } from "vue";
import Highcharts from "highcharts";
import accessibility from "highcharts/modules/accessibility";
import Highcharts3D from "highcharts/highcharts-3d";

// Initialize modules
accessibility(Highcharts);
Highcharts3D(Highcharts);

export default defineComponent({
  name: "BarChart",
  props: {
    chartData: {
      type: Object,
      default: () => ({
        total_transfer: 0,
        total_cash: 0,
        total_po: 0,
      }),
    },
  },
  setup(props) {
    const percentages = ref([0, 0, 0]);

    const calculatePercentages = () => {
      const total =
        parseInt(props.chartData.total_cash) +
        parseInt(props.chartData.total_po) +
        parseInt(props.chartData.total_transfer);
      
      percentages.value = [
        total ? ((props.chartData.total_cash / total) * 100).toFixed(2) : 0,
        total ? ((props.chartData.total_po / total) * 100).toFixed(2) : 0,
        total ? ((props.chartData.total_transfer / total) * 100).toFixed(2) : 0,
      ];
    };

    const chartOptions = ref({
      chart: {
        type: "column",
        options3d: {
          enabled: true,
          alpha: 10,
          beta: 25,
          depth: 70,
        },
      },
      title: {
        text: "",
      },
      xAxis: {
        categories: ["Cash", "PO", "Transfer"],
        title: {
          text: null,
        },
      },
      yAxis: {
        min: 0,
        title: {
          text: "Total Nominal",
          align: "high",
        },
        labels: {
          overflow: "justify",
        },
      },
      plotOptions: {
        column: {
          depth: 25,
          dataLabels: {
            enabled: true,
            formatter: function () {
              const index = this.point.index;
              return `${this.series.name} (${percentages.value[index]}%)`;
            },
            color: "#ffffff",
          },
        },
      },
      series: [
        {
          name: "Cash",
          data: [parseInt(props.chartData.total_cash) || 0],
        },
        {
          name: "PO",
          data: [parseInt(props.chartData.total_po) || 0],
        },
        {
          name: "Transfer",
          data: [parseInt(props.chartData.total_transfer) || 0],
        },
      ],
    });

    const updateChartOptions = () => {
      calculatePercentages();

      chartOptions.value.series[0].data = [
        parseInt(props.chartData.total_cash) || 0,
      ];
      chartOptions.value.series[1].data = [
        parseInt(props.chartData.total_po) || 0,
      ];
      chartOptions.value.series[2].data = [
        parseInt(props.chartData.total_transfer) || 0,
      ];
    };

    watch(
      () => props.chartData,
      (newChartData) => {
        updateChartOptions();
      },
      { deep: true }
    );

    // Initial calculation
    calculatePercentages();

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

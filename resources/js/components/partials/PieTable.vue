<template>
  <easy-data-table :headers="headers" :items="formattedData">
    <template #expand="item">
      <div class="details-row">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th style="font-size: 10px;">Nama Penerima</th>
              <th style="font-size: 10px;">Komponen</th>
              <th style="font-size: 10px;">Nominal</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="(detail, idx) in item.details" :key="idx">
              <td>{{ detail.nama_tujuan }}</td>
              <td>{{ detail.category }}</td>
              <td>{{ detail.nominal }}</td>
            </tr>
          </tbody>
        </table>
      </div>
    </template>
  </easy-data-table>
</template>

<script>
import { defineComponent } from "vue";
import EasyDataTable from "vue3-easy-data-table";
import "vue3-easy-data-table/dist/style.css";

export default defineComponent({
  components: {
    EasyDataTable,
  },
  props: {
    data: {
      type: Array,
      required: true,
    },
  },
  computed: {
    headers() {
      return [
        { text: "Tanggal Transaksi", value: "tanggal_transaksi" },
        { text: "Total Nominal", value: "total_nominal" },
      ];
    },
    formattedData() {
      return this.data.map((item) => ({
        ...item,
        expandableContent: {
          details: item.details.map((detail) => ({
            category: detail.category,
            nominal: detail.nominal,
          })),
        },
      }));
    },
  },
});
</script>

<style scoped>
.details-row {
  padding: 10px;
  background-color: #f9f9f9;
}
</style>

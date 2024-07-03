<template>
  <easy-data-table
    :theme-color="theme == 'light' ? '' : '#1d90ff'"
    :table-class-name="theme == 'light' ? '' : 'customize-table'"
    :headers="headers"
    :items="formattedData"
  >
    <template #expand="item">
      <div class="table-responsive">
        <div class="details-row">
          <table class="table">
            <thead>
              <tr>
                <th style="font-size: 10px" :class="theme == 'light' ? 'color-theme-light' : 'color-theme-dark'">Tanggal Transaksi</th>
                <th style="font-size: 10px" :class="theme == 'light' ? 'color-theme-light' : 'color-theme-dark'">Project</th>
                <th style="font-size: 10px" :class="theme == 'light' ? 'color-theme-light' : 'color-theme-dark'">Komponen</th>
                <th style="font-size: 10px" :class="theme == 'light' ? 'color-theme-light' : 'color-theme-dark'">Nominal</th>
              </tr>
            </thead>
            <tbody class="table-border-bottom-0">
              <tr
                v-for="(detail, idx) in item.expandableContent.details"
                :key="idx"
              >
                <td :class="theme == 'light' ? 'color-theme-light' : 'color-theme-dark'">{{ detail.tanggal }}</td>
                <td :class="theme == 'light' ? 'color-theme-light' : 'color-theme-dark'">{{ detail.project }} - {{ detail.id_project }}</td>
                <td :class="theme == 'light' ? 'color-theme-light' : 'color-theme-dark'">{{ detail.category }}</td>
                <td :class="theme == 'light' ? 'color-theme-light' : 'color-theme-dark'">{{ detail.nominal }}</td>
              </tr>
            </tbody>
          </table>
        </div>
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
      default: () => [],
    },
    theme: {
      type: String,
      default: 'light'
    }
  },
  computed: {
    headers() {
      return [
        { text: "Jenis Transaksi", value: "jenis_trx" },
        { text: "Total Nominal", value: "total_nominal" },
      ];
    },
    formattedData() {
      return this.data.map((item) => ({
        ...item,
        expandableContent: {
          details: (item.details || []).map((detail) => ({
            project: detail.project,
            category: detail.category,
            nominal: detail.nominal,
            tanggal: detail.tanggal,
            id_project: detail.id_project,
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
}

.color-theme-dark {
  color: #fff;
}

.color-theme-light {
  color : #445269
}

.customize-table {
  --easy-table-border: 1px solid #445269;
  --easy-table-row-border: 1px solid #445269;

  --easy-table-header-font-size: 14px;
  --easy-table-header-height: 50px;
  --easy-table-header-font-color: #c1cad4;
  --easy-table-header-background-color: #2d3a4f;

  --easy-table-header-item-padding: 10px 15px;

  --easy-table-body-even-row-font-color: #fff;
  --easy-table-body-even-row-background-color: #4c5d7a;

  --easy-table-body-row-font-color: #c0c7d2;
  --easy-table-body-row-background-color: #2d3a4f;
  --easy-table-body-row-height: 50px;
  --easy-table-body-row-font-size: 14px;

  --easy-table-body-row-hover-font-color: none;
  --easy-table-body-row-hover-background-color: none;

  --easy-table-body-item-padding: 10px 15px;

  --easy-table-footer-background-color: #2d3a4f;
  --easy-table-footer-font-color: #c0c7d2;
  --easy-table-footer-font-size: 14px;
  --easy-table-footer-padding: 0px 10px;
  --easy-table-footer-height: 50px;

  --easy-table-rows-per-page-selector-width: 70px;
  --easy-table-rows-per-page-selector-option-padding: 10px;
  --easy-table-rows-per-page-selector-z-index: 1;

  --easy-table-scrollbar-track-color: #2d3a4f;
  --easy-table-scrollbar-color: #2d3a4f;
  --easy-table-scrollbar-thumb-color: #4c5d7a;
  --easy-table-scrollbar-corner-color: #2d3a4f;

  --easy-table-loading-mask-background-color: #2d3a4f;
}

.hover-row:hover {
    background-color: transparent;
}
</style>

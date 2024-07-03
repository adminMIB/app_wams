<template>
  <div class="row">
    <div
      class="col-xl-3 col-md-6 mb-4"
      v-for="(title, index) in cardTitles"
      :key="index"
    >
      <div class="card" style="height: 450px">
        <div class="card-header d-flex justify-content-between">
          <div class="card-title mb-0">
            <h5 class="mb-0">{{ title }}</h5>
            <small class="text-muted"
              >Total Nominal Transaction Project Maker</small
            >
          </div>
        </div>
        <div
          class="card-body custom-scroll"
        >
          <ul class="p-0 m-0" v-if="hasData(index)">
            <li
              class="mb-4 pb-1 d-flex justify-content-between align-items-center"
              v-for="(item, idx) in getData(index)"
              :key="idx"
            >
              <div class="badge bg-label-primary rounded p-2">
                <i :class="item.icon"></i>
              </div>
              <div class="d-flex justify-content-between w-100 flex-wrap">
                <h6 class="mb-0 ms-3">{{ item.title }}</h6>
                <div class="d-flex">
                  <p class="mb-0 fw-medium">
                    IDR {{ $currencyFormatter(item.total) }}
                  </p>
                </div>
              </div>
            </li>
          </ul>
          <p v-else class="no-data">Belum ada data</p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { defineComponent } from "vue";

export default defineComponent({
  props: {
    data: {
      type: Object,
      required: true,
      default: () => ({
        nama_penerima: [],
        component: [],
        jenis_transaction: [],
        projects: [],
      }),
    },
  },
  computed: {
    cardTitles() {
      return [
        "Project Maker (Nama Penerima)",
        "Project Maker (Component)",
        "Project Maker (Jenis Transaksi)",
        "Project Maker (Project)",
      ];
    },
  },
  methods: {
    getData(index) {
      switch (index) {
        case 0:
          return this.data.nama_penerima;
        case 1:
          return this.data.component;
        case 2:
          return this.data.jenis_transaction;
        case 3:
          return this.data.projects;
        default:
          return [];
      }
    },
    hasData(index) {
      const data = this.getData(index);
      return Array.isArray(data) && data.length > 0;
    },
  },
});
</script>

<style>
.custom-scroll {
  max-height: 350px;
  overflow-y: auto;
}

.custom-scroll::-webkit-scrollbar {
  width: 4px;
}

.custom-scroll::-webkit-scrollbar-thumb {
  background-color: #888;
  border-radius: 4px;
}

.no-data {
  text-align: center;
  color: #999;
}
</style>

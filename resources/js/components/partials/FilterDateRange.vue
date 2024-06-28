<template>
  <div>
    <h6>Filter By Tanggal Transaksi</h6>
    <div :class="sizeInput">
      <div class="input-group">
        <span class="input-group-text">
          <i class="ti ti-calendar"></i>
        </span>
        <input type="text" :id="inputId" class="form-control" readonly />
        <button @click="$emit('clear')" class="btn btn-secondary">Clear</button>
      </div>
    </div>
    <div v-if="isLoading" class="loading-spinner-container">
      <div class="spinner-border spinner-border-lg text-primary" role="status">
        <span class="visually-hidden">Loading...</span>
      </div>
    </div>
    <div v-else-if="noData" class="no-data-container text-secondary">
      Tidak ada data pada periode {{ startDate }} - {{ endDate }}
    </div>
  </div>
</template>

<script>
export default {
  name: "FilterDateRange",
  props: {
    isLoading: {
      type: Boolean,
      required: true,
    },
    noData: {
      type: Boolean,
      default: false,
    },
    startDate: {
      type: [String, null],
      required: true,
    },
    endDate: {
      type: [String, null],
      required: true,
    },
    inputId: {
      type: [String, null],
      required: true
    },
    sizeInput: {
      type: String,
      required: false,
      default: 'col-12 col-lg-6 mb-4'
    }
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

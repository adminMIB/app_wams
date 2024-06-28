<template>
  <div class="col-md-3 col-6">
    <div class="d-flex align-items-center">
      <div :class="'badge rounded-pill ' + badgeClass + ' me-3 p-2'">
        <i :class="iconClass"></i>
      </div>
      <div class="card-info">
        <h5 class="mb-0">{{ value }}</h5>
        <small>{{ label }}</small>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "StatCard",
  props: {
    badgeClass: {
      type: String,
      required: true,
    },
    iconClass: {
      type: String,
      required: true,
    },
    value: {
      type: String,
      required: true,
    },
    label: {
      type: String,
      required: true,
    },
  },
};
</script>

<style scoped>
.card-info {
  text-align: center;
}
</style>

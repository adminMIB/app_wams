<template>
  <div class="slider-container">
    <input
      type="range"
      v-model="internalValue"
      :min="minValue"
      :max="maxValue"
      class="slider"
      @input="updateValue"
    />
    <div class="slider-labels">
      <span v-for="label in labels" :key="label.value" :style="label.style">
        {{ label.text }}
      </span>
    </div>
  </div>
</template>

<script>
import { defineComponent, ref, computed, watch } from 'vue';

export default defineComponent({
  name: 'QuarterlySlider',
  props: {
    modelValue: {
      type: Number,
      default: 0
    }
  },
  setup(props, { emit }) {
    const internalValue = ref(props.modelValue);
    const minValue = ref(1);
    const maxValue = ref(4);
    const labels = computed(() => [
      { value: 1, text: 'Q1', style: { left: '0%' } },
      { value: 2, text: 'Q2', style: { left: '33%' } },
      { value: 3, text: 'Q3', style: { left: '66%' } },
      { value: 4, text: 'Q4', style: { left: '100%' } },
    ]);

    watch(() => props.modelValue, (newVal) => {
      internalValue.value = newVal;
    });

    const updateValue = () => {
      emit('update:modelValue', internalValue.value);
    };

    return {
      internalValue,
      minValue,
      maxValue,
      labels,
      updateValue,
    };
  },
});
</script>

<style scoped>
.slider-container {
  position: relative;
  width: 100%;
  padding: 0 10px;
  box-sizing: border-box;
}

.slider {
  width: 100%;
  appearance: none;
  height: 6px;
  background: #d3d3d3;
  outline: none;
  opacity: 0.7;
  transition: opacity .15s ease-in-out;
  position: relative;
}

.slider:hover {
  opacity: 1;
}

.slider::before {
  content: '';
  height: 6px;
  background: #7367f0;
  position: absolute;
  top: 0;
  left: 0;
  width: calc((100% - 20px) * var(--value) / 3 + 10px);
  z-index: -1;
  pointer-events: none;
}

.slider::-webkit-slider-thumb {
  appearance: none;
  width: 20px;
  height: 20px;
  border-radius: 50%;
  background: #7367f0;
  cursor: pointer;
  transition: background .15s ease-in-out;
  position: relative;
}

.slider::-webkit-slider-thumb:hover {
  background: #5e54d8;
}

.slider::-moz-range-thumb {
  width: 20px;
  height: 20px;
  border-radius: 50%;
  background: #7367f0;
  cursor: pointer;
  transition: background .15s ease-in-out;
  position: relative;
}

.slider::-moz-range-thumb:hover {
  background: #5e54d8;
}

.slider-labels {
  display: flex;
  justify-content: space-between;
  position: absolute;
  top: -25px;
  width: 100%;
  padding: 0 10px;
  box-sizing: border-box;
}

.slider-labels span {
  position: absolute;
  transform: translateX(-50%);
}

@media only screen and (max-width: 600px) {
  .slider-container {
    margin-top: 50px !important;
    padding: 0 5px;
  }
  .slider-labels {
    top: -20px;
    padding: 0 5px;
  }
}
</style>

<template>
    <Pie :data="data" :options="options" id="my-chart-id" class="w-[350px]" />
</template>

<script setup>
const props = defineProps({
    mainChecklist: Number,
    subChecklist: Number,
});
import { Chart as ChartJS, ArcElement, Tooltip, Legend } from "chart.js";
import { Pie } from "vue-chartjs";

ChartJS.register(ArcElement, Tooltip, Legend);

const data = {
    labels: ["Total Number of Main Checklist", "Total Number of Sub Checklist"],
    datasets: [
        {
            backgroundColor: ["#41B883", "#E46651"],
            data: [props.mainChecklist, props.subChecklist],
        },
    ],
};

const options = {
    responsive: true,
};
</script>

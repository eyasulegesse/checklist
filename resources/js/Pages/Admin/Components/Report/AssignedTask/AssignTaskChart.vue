<template>
    <Pie :data="data" :options="options" id="my-chart-id" />
</template>

<script setup>
const props = defineProps({
    assignTask: Number,
    subChecklist: Number,
});
import { Chart as ChartJS, ArcElement, Tooltip, Legend } from "chart.js";
import { Pie } from "vue-chartjs";

ChartJS.register(ArcElement, Tooltip, Legend);

const data = {
    labels: ["Total Number of Assigned Tasks", "Total Number of Sub Checklist"],
    datasets: [
        {
            backgroundColor: ["#41B883", "#E46651"],
            data: [props.assignTask, props.subChecklist],
        },
    ],
};

const options = {
    responsive: true,
};
</script>

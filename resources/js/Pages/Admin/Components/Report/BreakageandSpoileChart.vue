<template>
    <Pie :data="data" :options="options" id="my-chart-id" />
</template>

<script setup>
const props = defineProps({ breakaTotal: Number, spoileTotal: Number });
import { Chart as ChartJS, ArcElement, Tooltip, Legend } from "chart.js";
import { Pie } from "vue-chartjs";

ChartJS.register(ArcElement, Tooltip, Legend);

const data = {
    labels: ["Total Number of Breakage", "Total Number of Spoilage"],
    datasets: [
        {
            backgroundColor: ["#41B883", "#E46651"],
            data: [props.breakaTotal, props.spoileTotal],
        },
    ],
};

const options = {
    responsive: true,
};
</script>

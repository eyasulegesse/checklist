<template>
    <Table :dataSource="breakageMaintenances" :columns="columns" />
</template>

<script setup>
const props = defineProps({
    breakageMaintenances: Array,
});
import Table from "@/Shared/Table.vue";
const columns = [
    { title: "Breakage Item", dataIndex: ["item", "name"] },
    { title: "Amount", dataIndex: "quantity" },
    { title: "Date", dataIndex: "date" },
    { title: "Prepared By", dataIndex: ["user", "name"] },
    { title: "Branch", dataIndex: ["branch", "name"] },
];

console.log(props.breakageMaintenances);
</script>

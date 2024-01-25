<template>
    <Table :dataSource="spoilages" :columns="columns" />
</template>

<script setup>
const props = defineProps(["spoilages"]);
console.log(props.spoilages);
import Table from "@/Shared/Table.vue";

const columns = [
    {
        title: "Item",
        dataIndex: ["item", "name"],
    },
    {
        title: "Quantity",
        dataIndex: "quantity",
    },
    {
        title: "Breakaged By",
        dataIndex: ["user", "name"],
    },
    {
        title: "Branch",
        dataIndex: ["branch", "name"],
    },
    {
        title: "Date",
        dataIndex: "date",
    },
];
</script>

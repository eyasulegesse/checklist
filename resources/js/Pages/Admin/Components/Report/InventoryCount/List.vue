<template>
    <Table :dataSource="inventoryCount" :columns="columns" />
</template>

<script setup>
const props = defineProps(["inventoryCount"]);
console.log(props.inventoryCount);
import Table from "@/Shared/Table.vue";
const columns = [
    {
        title: "Item Name",
        dataIndex: ["item", "name"],
    },
    {
        title: "Item Code",
        dataIndex: ["item", "code"],
    },
    {
        title: "Amount",
        dataIndex: "amount",
    },
    {
        title: "Counted By",
        dataIndex: ["user", "name"],
    },
    {
        title: "Date",
        dataIndex: "date",
    },
];
</script>

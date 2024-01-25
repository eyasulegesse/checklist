<template>
    <Table
        :dataSource="inventoryCounts"
        :columns="columns"
        :actions="actions"
    />
</template>

<script setup>
const props = defineProps(["inventoryCounts"]);
import Table from "@/Shared/Table.vue";
const actions = {
    delete: "delete",
    view: "view",
};
const columns = [
    {
        title: "Item",
        dataIndex: ["item", "name"],
    },
    {
        title: "Item Category",
        dataIndex: ["item", "category", "name"],
    },
    {
        title: "Amount",
        dataIndex: "amount",
    },
    {
        title: "Item Code",
        dataIndex: ["item", "code"],
    },
    {
        title: "Branch",
        dataIndex: ["branch", "name"],
    },

    {
        title: "Date",
        dataIndex: "date",
    },
    {
        title: "Actions",
        key: "action",
    },
];
console.log(props.inventoryCounts);
</script>

<template>
    <Table
        :dataSource="spoilageMaintenances"
        :columns="columns"
        :actions="actions"
    />
</template>

<script setup>
defineProps(["spoilageMaintenances"]);
import Table from "@/Shared/Table.vue";
const actions = {
    delete: "delete",
    edit: "edit",
};
const columns = [
    {
        title: "Spoilage Item",
        dataIndex: ["item", "name"],
    },
    {
        title: "Quantity",
        dataIndex: "quantity",
        key: "quantity",
    },
    {
        title: "Branch",
        dataIndex: ["branch", "name"],
    },

    {
        title: "Spoilaged By",
        dataIndex: ["user", "name"],
    },
    {
        title: "Date",
        dataIndex: "date",
        key: "date",
    },
    {
        title: "Actions",
        key: "action",
    },
];
</script>

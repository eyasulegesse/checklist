<template>
    <Table
        :dataSource="spoilageMaintenances"
        :columns="columns"
        :actions="actions"
        @viewHandler="$emit('viewHandler', $event, item)"
    />
</template>

<script setup>
defineProps(["spoilageMaintenances"]);
defineEmits(["viewHandler"]);
import Table from "@/Shared/Table.vue";
const actions = {
    delete: "delete",

    view: "view",
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
        title: "Department",
        dataIndex: ["department", "name"],
    },
    {
        title: "Prepard By",
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

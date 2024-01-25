<template>
    <Table :dataSource="sendReports" :columns="columns" :actions="actions" />
</template>

<script setup>
defineProps({ sendReports: Array });
import Table from "@/Shared/Table.vue";
const actions = {
    delete: "delete",
    view: "view",
};
const columns = [
    {
        title: "Report Type",
        dataIndex: "report_title",
    },
    {
        title: "Reported To",
        dataIndex: ["send_report_to", "user", "name"],
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
</script>

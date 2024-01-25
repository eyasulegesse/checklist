<template>
    <Table :dataSource="assignedtasks" :columns="columns" />
</template>

<script setup>
import Table from "@/Shared/Table.vue";
defineProps({ assignedtasks: Array });
const columns = [
    {
        title: "Assigned By",
        dataIndex: ["task_assigned_by", "user", "name"],
    },
    {
        title: "Date",
        dataIndex: "date",
    },
    {
        title: "Task Detail",
        dataIndex: "task",
    },
];
</script>

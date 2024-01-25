<template>
    <Table :columns="columns" :dataSource="assigned_task" />
</template>

<script setup>
defineProps(["assigned_task"]);

import Table from "@/Shared/Table.vue";
const columns = [
    {
        title: "Task Assigned By",
        dataIndex: ["task_assigned_by", "user", "name"],
    },
    {
        title: "Task Assigned To",
        dataIndex: ["task_assigned_to", "user", "name"],
    },
    {
        title: "Task Detail",
        dataIndex: "task",
    },
];
</script>

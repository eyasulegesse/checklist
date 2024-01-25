<template>
    <Table
        :dataSource="assignTasks"
        @viewHandler="$emit('viewHandler', $event, item)"
        :columns="columns"
        :actions="actions"
    />
</template>

<script setup>
const props = defineProps(["assignTasks"]);
defineEmits(["viewHandler"]);
import Table from "@/Shared/Table.vue";
const actions = {
    view: "view",
};
const columns = [
    {
        title: "Assigned To",
        dataIndex: ["task_assigned_to", "user", "name"],
    },
    {
        title: "Task Detail",
        dataIndex: "task",
    },
    {
        title: "Status",
        dataIndex: "status",
    },
    {
        title: "Actions",
        key: "action",
    },
];
</script>

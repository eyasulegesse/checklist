<template>
    <Table :dataSource="checklists" :columns="columns" />
</template>

<script setup>
const props = defineProps({ checklists: Object });
import Table from "@/Shared/Table.vue";
console.log(props.checklists);
const columns = [
    {
        title: "Main Checklist",
        dataIndex: ["main_check_list", "name"],
    },
    {
        title: "Sub Checklist",
        dataIndex: ["sub_checklist", "name"],
    },
    {
        title: "Task",
        dataIndex: ["checklist_task", "task"],
    },
    {
        title: "Performed By",
        dataIndex: ["user", "name"],
    },
    {
        title: "Branch",
        dataIndex: ["branch", "name"],
    },
    {
        title: "Department",
        dataIndex: ["department", "name"],
    },
];
</script>

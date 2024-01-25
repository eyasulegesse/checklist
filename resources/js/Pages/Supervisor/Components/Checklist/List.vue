<template>
    <Table :dataSource="checklists" :columns="columns" />
</template>

<script setup>
const props = defineProps(["checklists"]);
console.log(props.checklists);
import Table from "@/Shared/Table.vue";
const columns = [
    {
        title: "Branch Name",
        dataIndex: ["branch", "name"],
    },
    {
        title: "Department Name",
        dataIndex: ["department", "name"],
    },
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
        title: "Date",
        dataIndex: "date",
    },
    {
        title: "Prepared By",
        dataIndex: ["user", "name"],
    },
];
</script>

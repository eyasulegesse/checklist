<template>
    <Table :dataSource="reporttypes" :columns="columns" :actions="actions" />
</template>

<script setup>
const props = defineProps({
    reporttypes: Array,
});
console.log(props.reporttypes);
import Table from "@/Shared/Table.vue";
const actions = {
    delete: "delete",
    edit: "edit",
};

const columns = [
    {
        title: "Report Type",
        dataIndex: "name",
    },
    {
        title: "Department",
        dataIndex: ["department", "name"],
    },

    {
        action: "Actions",
        key: "action",
    },
];
</script>

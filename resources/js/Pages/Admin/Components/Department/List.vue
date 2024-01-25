<template>
    <Table
        :dataSource="departments"
        :columns="columns"
        :actions="actions"
        @deleteHandler="$emit('deleteHandler', $event, id)"
    />
</template>

<script setup>
defineEmits(["deleteHandler"]);
defineProps(["departments"]);
import Table from "@/Shared/Table.vue";
const actions = {
    delete: "delete",
};
const columns = [
    {
        title: "Department Name",
        dataIndex: "name",
        key: "name",
    },
    {
        title: "Branch",
        dataIndex: ["branch", "name"],
    },
    {
        title: "Actions",

        key: "action",
    },
];
</script>

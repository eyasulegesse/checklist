<template>
    <Table
        :dataSource="mainchecklists"
        :columns="columns"
        @deleteHandler="$emit('deleteHandler', $event, id)"
        :actions="actions"
    />
</template>

<script setup>
defineProps({
    mainchecklists: Array,
});
defineEmits(["deleteHandler"]);
import Table from "@/Shared/Table.vue";
const actions = {
    delete: "delete",
    edit: "edit",
};
const columns = [
    {
        title: "Main Checklist Name",
        dataIndex: "name",
    },
    {
        action: "Actions",
        key: "action",
    },
];
</script>

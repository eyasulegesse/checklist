<template>
    <Table
        :dataSource="branches"
        :columns="columns"
        @deleteHandler="$emit('deleteHandler', $event, id)"
        :actions="actions"
    />
</template>

<script setup>
import Table from "@/Shared/Table.vue";
const emit = defineEmits(["deleteHandler"]);
defineProps({
    branches: Array,
});
const actions = {
    delete: "delete",
    edit: "edit",
};
const columns = [
    {
        title: "Branch Name",
        dataIndex: "name",
        key: "name",
    },
    {
        title: "Actions",
        key: "action",
    },
];
</script>

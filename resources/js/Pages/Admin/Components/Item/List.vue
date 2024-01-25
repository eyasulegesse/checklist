<template>
    <Table
        :dataSource="items"
        :columns="columns"
        @deleteHandler="$emit('deleteHandler', $event, id)"
        :actions="actions"
    />
</template>

<script setup>
const props = defineProps(["items"]);
defineEmits(["deleteHandler"]);
import Table from "@/Shared/Table.vue";
const actions = {
    delete: "delete",
    edit: "edit",
};
const columns = [
    {
        title: "Item Code",
        dataIndex: "code",
        key: "code",
    },
    {
        title: "Item Name",
        dataIndex: "name",
        key: "name",
    },

    {
        title: "Category",
        dataIndex: ["category", "name"],
    },
    {
        title: "Actions",
        key: "action",
    },
];
</script>

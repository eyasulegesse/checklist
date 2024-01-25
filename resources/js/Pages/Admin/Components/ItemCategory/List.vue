<template>
    <Table
        :dataSource="itemCategorys"
        :columns="columns"
        @deleteHandler="$emit('deleteHandler', $event, id)"
        :actions="actions"
    />
</template>

<script setup>
defineProps(["itemCategorys"]);
defineEmits(["deleteHandler"]);
import Table from "@/Shared/Table.vue";
const actions = {
    delete: "delete",
};
const columns = [
    { title: "Category Name", dataIndex: "name", key: "name" },
    { title: "Actions", key: "action" },
];
</script>

<template>
    <Table
        :dataSource="subchecklists"
        :columns="columns"
        @deleteHandler="$emit('deleteHandler', $event, id)"
        :actions="actions"
    />
</template>

<script setup>
const props = defineProps({
    subchecklists: Array,
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
        dataIndex: ["main_check_list", "name"],
    },
    {
        title: "Sub Checklist Name",
        dataIndex: "name",
    },
    {
        action: "Actions",
        key: "action",
    },
];
</script>

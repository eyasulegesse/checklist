<template>
    <Table
        :dataSource="checklistTask"
        :columns="columns"
        @deleteHandler="$emit('deleteHandler', $event, id)"
        :actions="actions"
    />
</template>

<script setup>
const props = defineProps({
    checklistTask: Array,
});
defineEmits(["deleteHandler"]);
console.log(props.checklistTask);
import Table from "@/Shared/Table.vue";
const actions = {
    delete: "delete",
    edit: "edit",
};

const columns = [
    {
        title: "Task",
        dataIndex: "task",
    },
    {
        title: "Main Checklist",
        dataIndex: ["sub_checklist", "mainchecklist", "name"],
    },
    {
        title: "Sub Checklist",
        dataIndex: ["sub_checklist", "name"],
    },
    {
        action: "Actions",
        key: "action",
    },
];
</script>

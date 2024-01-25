<template>
    <Table
        :dataSource="userList"
        :columns="columns"
        :actions="actions"
        @deleteHandler="$emit('deleteHandler', $event, id)"
    />
</template>

<script setup>
import Table from "@/Shared/Table.vue";
const props = defineProps({ userList: Array });
const emit = defineEmits(["deleteHandler"]);

const actions = {
    delete: "delete",
};
const columns = [
    {
        title: "Name",
        dataIndex: "name",
        key: "name",
    },
    {
        title: "Email",
        dataIndex: "email",
        key: "email",
    },
    {
        title: "Role",
        key: "Role",
    },
    {
        title: "Department",
        dataIndex: ["department", "name"],
    },
    {
        title: "Branch",
        dataIndex: ["branch", "name"],
    },
    {
        title: "Main Checklist",
        dataIndex: ["sub_checklist", "main_check_list", "name"],
    },
    {
        title: "Sub Checklist",
        dataIndex: ["sub_checklist", "main_check_list", "name"],
    },
    {
        title: "Actions",
        key: "action",
    },
];
</script>

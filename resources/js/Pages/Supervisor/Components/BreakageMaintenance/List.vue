<template>
    <Table
        :dataSource="breakageMaintenances"
        @viewHandler="$emit('viewHandler', $event, item)"
        :columns="columns"
        :actions="actions"
    />
</template>

<script setup>
const props = defineProps({
    breakageMaintenances: Array,
});
console.log(props.breakageMaintenances);
defineEmits(["viewHandler"]);
import Table from "@/Shared/Table.vue";
const actions = {
    view: "view",
};
const columns = [
    { title: "Breakage Item", dataIndex: ["item", "name"] },
    { title: "Amount", dataIndex: "quantity" },
    { title: "Date", dataIndex: "date" },
    { title: "Prepared By", dataIndex: ["user", "name"] },
    { title: "Branch", dataIndex: ["branch", "name"] },
    { title: "Department", dataIndex: ["department", "name"] },
    {
        title: "Actions",
        key: "action",
    },
];

console.log(props.breakageMaintenances);
</script>

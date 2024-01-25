<template>
    <SupervisorLayout>
        <AppHeader title="Incoming Report" />
        <Table
            :dataSource="sendReports"
            :columns="columns"
            :actions="actions"
            @viewHandler="viewHandler"
        />
        <a-modal
            v-model:open="viewItem"
            footer=""
            title="View Report Detail"
            width="800px"
        >
            <View :viewItem="viewItem" />
        </a-modal>
    </SupervisorLayout>
</template>

<script setup>
const props = defineProps(["sendReports"]);
import SupervisorLayout from "@/Layouts/SupervisorLayout/SupervisorLayout.vue";
import Table from "@/Shared/Table.vue";
import AppHeader from "@/Shared/AppHeader.vue";
import View from "./View.vue";
import { ref } from "vue";
const viewItem = ref(null);
console.log(props.sendReports);
const actions = {
    delete: "delete",
    view: "view",
};
const columns = [
    {
        title: "Report Title",
        dataIndex: "report_title",
    },
    {
        title: "Send Report By",
        dataIndex: ["send_report_by", "user", "name"],
    },
    {
        title: "Send Report To",
        dataIndex: ["send_report_to", "user", "name"],
    },
    {
        title: "Date",
        dataIndex: "date",
    },
    {
        title: "Actions",
        key: "action",
    },
];
const viewHandler = (record) => {
    viewItem.value = record;
    console.log(record);
};
</script>

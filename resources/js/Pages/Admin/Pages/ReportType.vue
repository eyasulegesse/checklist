<template>
    <AdminLayout>
        <AppHeader title="Report Type Management" />
        <AddNewButton title="Add New Report Type" />
        <a-modal
            v-model:open="uistore.isModalOpen"
            footer=""
            title="Add New Report Type"
        >
            <Create :departments="departments" @saveHandler="saveHandler" />
        </a-modal>
        <List :reporttypes="reporttypes" />
    </AdminLayout>
</template>

<script setup>
const props = defineProps(["departments", "reporttypes"]);

import AdminLayout from "@/Layouts/AdminLayout/AdminLayout.vue";
import AppHeader from "@/Shared/AppHeader.vue";
import AddNewButton from "@/Shared/AddNewButton.vue";
import Create from "../Components/ReportType/Create.vue";
import List from "../Components/ReportType/List.vue";
import { Modal } from "ant-design-vue";
import { UIStore } from "@/Stores/UIStore";
const uistore = UIStore();
import { router } from "@inertiajs/vue3";

const saveHandler = (formData) => {
    console.log("errrr", formData);
    router.post(route("report.type.store"), formData, {
        onSuccess: () => {
            uistore.closeModal();
            Modal.success({
                title: "Report Type",
                content: "Successfully Saved",
                okType: "default",
            });
        },
        onError: (err) => {
            Modal.error({
                title: "Report Type",
                content: "Successfully Saved",
                okType: "default",
            });
        },
    });
};
</script>

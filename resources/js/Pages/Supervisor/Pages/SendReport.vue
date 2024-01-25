<template>
    <SupervisorLayout>
        <AppHeader title="Send Report" />
        <AddNewButton title="Send Report" />
        <a-modal
            v-model:open="uistore.isModalOpen"
            footer=""
            title="Send Report"
            width="600px"
        >
            <Create
                @saveHandler="saveHandler"
                :reportTypes="reportTypes"
                :userLists="userLists"
            />
        </a-modal>

        <a-modal v-model:open="viewItem" footer="" title="View Report Detail">
            <View :viewItem="viewItem" />
        </a-modal>
        <List :sendReports="sendReports" @viewHandler="viewHandler" />
    </SupervisorLayout>
</template>

<script setup>
const props = defineProps(["reportTypes", "userLists", "sendReports"]);
import SupervisorLayout from "@/Layouts/SupervisorLayout/SupervisorLayout.vue";
import AppHeader from "@/Shared/AppHeader.vue";
import AddNewButton from "@/Shared/AddNewButton.vue";
import Create from "../Components/SendReport/Create.vue";
import View from "../Components/SendReport/View.vue";
import List from "../Components/SendReport/List.vue";
import { UIStore } from "@/Stores/UIStore";
import { router } from "@inertiajs/vue3";
import { Modal } from "ant-design-vue";
import { ref } from "vue";
const uistore = UIStore();
const viewItem = ref(null);
console.log(props.sendReports);
const saveHandler = (formData) => {
    router.post(route("send.report.store"), formData, {
        onSuccess: () => {
            uistore.closeModal();
            Modal.success({
                title: "Report",
                content: "Sent Successfully",
                okType: "default",
            });
        },
        onError: (err) => {
            console.log(err);
        },
    });
    console.log(formData);
};

const viewHandler = (record) => {
    viewItem.value = record;
};
</script>

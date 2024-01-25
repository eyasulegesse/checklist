<template>
    <AdminLayout>
        <AppHeader title="Breakage Maintenance Management" />
        <AddNewButton title="Add New Breakage" />

        <a-modal
            v-model:open="uistore.isModalOpen"
            footer=""
            title="Add New Breakage Maintenance"
        >
            <Create
                :items="items"
                :user_id="user_id"
                @saveHandler="saveHandler"
            />
        </a-modal>
        <List :breakageMaintenances="breakageMaintenances" />
    </AdminLayout>
</template>

<script setup>
const props = defineProps(["items", "breakageMaintenances", "user_id"]);
import AdminLayout from "@/Layouts/AdminLayout/AdminLayout.vue";
import AppHeader from "@/Shared/AppHeader.vue";
import AddNewButton from "@/Shared/AddNewButton.vue";
import Create from "../Components/BreakageMaintenance/Create.vue";
import List from "../Components/BreakageMaintenance/List.vue";
import { UIStore } from "@/Stores/UIStore";
import { router } from "@inertiajs/vue3";
import { Modal } from "ant-design-vue";
const uistore = UIStore();

const saveHandler = (formData) => {
    router.post(route("breakage.store"), formData, {
        onSuccess: () => {
            uistore.closeModal();
            Modal.success({
                title: "Breakage",
                content: "Successfully Saved",
                okType: "default",
            });
        },
        onError: (error) => {
            Modal.error({
                title: "Error",
                content: error,
                okType: "default",
            });
        },
    });
    console.log(formData);
};
</script>

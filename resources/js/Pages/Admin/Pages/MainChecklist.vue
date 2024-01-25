<template>
    <AdminLayout>
        <AppHeader title="Main Checklist Management" />
        <AddNewButton title="Add New Main checklist" />
        <a-modal
            v-model:open="uistore.isModalOpen"
            footer=""
            title="Add New Mainchecklist"
        >
            <Create @saveHandler="saveHandler" />
        </a-modal>
        <List :mainchecklists="mainchecklists" @deleteHandler="deleteHandler" />
    </AdminLayout>
</template>

<script setup>
defineProps({
    mainchecklists: Array,
});
import AdminLayout from "@/Layouts/AdminLayout/AdminLayout.vue";
import AppHeader from "@/Shared/AppHeader.vue";
import AddNewButton from "@/Shared/AddNewButton.vue";
import Create from "../../Admin/Components/MainChecklist/Create.vue";
import List from "../../Admin/Components/MainChecklist/List.vue";
import { UIStore } from "@/Stores/UIStore";
import { Modal } from "ant-design-vue";
import { router } from "@inertiajs/vue3";

const uistore = UIStore();
const saveHandler = (formData) => {
    router.post(route("mainchecklist.store"), formData, {
        onSuccess: () => {
            uistore.closeModal();
            Modal.success({
                title: "Main Checklist",
                content: "Successfully Saved",
                okType: "default",
            });
        },
    });
};
const deleteHandler = (id) => {
    router.delete(`/main_checklist/${id}`, {
        onSuccess: () => {
            Modal.success({
                title: "Main Checklist",
                content: "Successfully Saved",
                okType: "danger",
            });
        },
    });
};
</script>

<template>
    <AdminLayout>
        <AppHeader title="Checklist Task Management" />
        <AddNewButton title="Add New Checklist Task" />
        <a-modal
            v-model:open="uistore.isModalOpen"
            footer=""
            title="Add New Checklist Task"
        >
            <Create @saveHandler="saveHandler" :subChecklists="subChecklists" />
        </a-modal>
        <List :checklistTask="checklistTask" @deleteHandler="deleteHandler" />
    </AdminLayout>
</template>

<script setup>
defineProps({
    subChecklists: Array,
    checklistTask: Array,
});
import AdminLayout from "@/Layouts/AdminLayout/AdminLayout.vue";
import AppHeader from "@/Shared/AppHeader.vue";
import AddNewButton from "@/Shared/AddNewButton.vue";
import Create from "../../Admin/Components/checklistTask/Create.vue";
import List from "../../Admin/Components/checklistTask/List.vue";
import { UIStore } from "@/Stores/UIStore";
const uistore = UIStore();
import { Modal } from "ant-design-vue";
import { router } from "@inertiajs/vue3";

const saveHandler = (formData) => {
    router.post(route("checklist.task.store"), formData, {
        onSuccess: () => {
            uistore.closeModal();
            Modal.success({
                title: "Sub checklist",
                content: "Successfully Saved",
                okType: "default",
            });
        },
        onError: (err) => {
            console.log(err);
        },
    });
};

const deleteHandler = (id) => {
    router.delete(`/checklist_task/${id}`, {
        onSuccess: () => {
            Modal.success({
                title: "Checklist Task",
                content: "Successfully  Deleted",
                okType: "danger",
            });
        },
    });
};
</script>

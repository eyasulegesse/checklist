<template>
    <AdminLayout>
        <AppHeader title="Assign Task" />
        <AddNewButton title="Assign New Task" />
        <a-modal
            v-model:open="uistore.isModalOpen"
            footer=""
            title="Assign Task"
        >
            <Create
                @saveHandler="saveHandler"
                :users="users"
                :userId="user_id"
            />
        </a-modal>
        <List :assigned_task="assigned_task" />
    </AdminLayout>
</template>

<script setup>
const props = defineProps({
    users: Array,
    user_id: Array,
    assigned_task: Array,
});
import AdminLayout from "@/Layouts/AdminLayout/AdminLayout.vue";
import AppHeader from "@/Shared/AppHeader.vue";
import AddNewButton from "@/Shared/AddNewButton.vue";
import Create from "../Components/AssignTask/Create.vue";
import List from "../Components/AssignTask/List.vue";
import { UIStore } from "@/Stores/UIStore";
import { router } from "@inertiajs/vue3";
import { Modal } from "ant-design-vue";
const uistore = UIStore();

const saveHandler = (formData) => {
    router.post("/task", formData, {
        onSuccess: () => {
            uistore.closeModal();
            Modal.success({
                title: "Task",
                content: "Successfully Assigned",
                okType: "default",
            });
        },
        onError: (error) => {
            Modal.error({
                title: "Error",
                content: error,
                okType: "danger",
            });
        },
    });
};
</script>

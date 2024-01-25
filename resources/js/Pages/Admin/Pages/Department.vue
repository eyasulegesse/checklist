<template>
    <AdminLayout>
        <AppHeader title="Department Management" />
        <AddNewButton title="Add New Department" />
        <a-modal
            v-model:open="uistore.isModalOpen"
            footer=""
            title="Add New Department"
        >
            <Create @saveHandler="saveHandler" :branches="branches" />
        </a-modal>
        <List :departments="departments" @deleteHandler="deleteHandler" />
    </AdminLayout>
</template>

<script setup>
const props = defineProps(["departments", "branches"]);
import AppHeader from "@/Shared/AppHeader.vue";
import AddNewButton from "@/Shared/AddNewButton.vue";
import AdminLayout from "@/Layouts/AdminLayout/AdminLayout.vue";
console.log(props.departments);
import { UIStore } from "@/Stores/UIStore";
const uistore = UIStore();
import Create from "../Components/Department/Create.vue";
import List from "../Components/Department/List.vue";
import { Modal } from "ant-design-vue";
import { router } from "@inertiajs/vue3";
const saveHandler = (formData) => {
    router.post("/department", formData, {
        onSuccess: () => {
            uistore.closeModal();
            Modal.success({
                title: "Department",
                content: "Successfully Saved",
                okType: "default",
            });
        },
        onError(err) {
            Modal.error({
                title: err,
                okType: "danger",
            });
        },
    });
};
const deleteHandler = (id) => {
    router.delete(`/department/${id}`, {
        onSuccess: () => {
            Modal.success({
                title: "Department",
                content: "Successfuly Saved",
                okType: "default",
            });
        },
    });
};
</script>

<template>
    <AdminLayout>
        <AppHeader title="Item Category Management" />
        <AddNewButton title="Add New Item Category" />

        <a-modal
            v-model:open="uistore.isModalOpen"
            title="Add New Item Category"
            footer=""
        >
            <Create @saveHandler="saveHandler" />
        </a-modal>
        <List :itemCategorys="itemCategorys" @deleteHandler="deleteHandler" />
    </AdminLayout>
</template>

<script setup>
defineProps(["itemCategorys"]);
import AdminLayout from "@/Layouts/AdminLayout/AdminLayout.vue";
import AppHeader from "@/Shared/AppHeader.vue";
import AddNewButton from "@/Shared/AddNewButton.vue";
import Create from "../Components/ItemCategory/Create.vue";
import List from "../Components/ItemCategory/List.vue";

import { UIStore } from "@/Stores/UIStore";
import { Modal } from "ant-design-vue";
import { router } from "@inertiajs/vue3";
const uistore = UIStore();
const saveHandler = (formData) => {
    router.post("item-category", formData, {
        onSuccess: () => {
            uistore.closeModal();
            Modal.success({
                title: "Item Category",
                content: "Successfully Saved",
                okType: "default",
            });
        },
        onError(err) {
            Modal.error({
                title: "Error",
                content: err,
            });
        },
    });
};
const deleteHandler = (id) => {
    router.delete(`item-category/${id}`, {
        onSuccess: () => {
            Modal.success({
                title: "Item Category",
                content: "Successfully Deleted",
                okType: "danger",
            });
        },
    });
};
</script>

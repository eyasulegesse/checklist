<template>
    <AdminLayout>
        <AppHeader title="Item Management" />
        <AddNewButton title="Add New Item" />
        <a-modal
            v-model:open="uistore.isModalOpen"
            title="Add New Item"
            footer=""
        >
            <Create @saveHandler="saveHandler" :categories="categories" />
        </a-modal>
        <List :items="items" @deleteHandler="deleteHandler" />
    </AdminLayout>
</template>

<script setup>
defineProps(["categories", "items"]);
import AdminLayout from "@/Layouts/AdminLayout/AdminLayout.vue";
import AppHeader from "@/Shared/AppHeader.vue";
import AddNewButton from "@/Shared/AddNewButton.vue";

import Create from "../Components/Item/Create.vue";
import List from "../Components/Item/List.vue";
import { UIStore } from "@/Stores/UIStore";
import { Modal } from "ant-design-vue";
import { router } from "@inertiajs/vue3";
const uistore = UIStore();
const saveHandler = (formData) => {
    formData.category_id = formData.category_id.toString();
    router.post("item", formData, {
        onSuccess: () => {
            uistore.closeModal();
            Modal.success({
                title: "Item",
                content: "Saved Successfully",
                okType: "default",
            });
        },
        onError(err) {
            Modal.error({
                title: "Error",
                okType: "danger",
            });
        },
    });
};

const deleteHandler = (id) => {
    router.delete(`item/${id}`, {
        onSuccess: () => {
            Modal.success({
                title: "Item",
                content: "Successfully Deleted",
                okType: "danger",
            });
        },
    });
};
</script>

<template>
    <AdminLayout>
        <AppHeader title="Branch Management" />
        <AddNewButton title="Add New Branch" />
        <a-modal
            v-model:open="uistore.isModalOpen"
            footer=""
            title="Add New Branch"
        >
            <Create @saveHandler="saveHandler" />
        </a-modal>
        <List :branches="branches" @deleteHandler="deleteHandler" />
    </AdminLayout>
</template>

<script setup>
defineProps({
    branches: Array,
});
import AppHeader from "@/Shared/AppHeader.vue";
import AdminLayout from "@/Layouts/AdminLayout/AdminLayout.vue";
import AddNewButton from "@/Shared/AddNewButton.vue";

import Create from "../Components/Branch/Create.vue";
import List from "../Components/Branch/List.vue";
import { UIStore } from "@/Stores/UIStore";
import { Modal } from "ant-design-vue";
import { router } from "@inertiajs/vue3";
const uistore = UIStore();
const saveHandler = (formData) => {
    router.post("/branch", formData, {
        onSuccess: () => {
            uistore.closeModal();
            Modal.success({
                title: "Branch",
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
    console.log(id);
    router.delete(`branch/${id}`, {
        onSuccess: () => {
            Modal.success({
                title: "Branch",
                content: "Successfully Saved",
                okType: "default",
            });
        },
    });
};
</script>

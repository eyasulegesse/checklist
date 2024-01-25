<template>
    <AdminLayout
        ><AppHeader title="Spoilage Maintenance Management" />
        <AddNewButton title="Add New Spoilage Maintenance" />
        <a-modal
            v-model:open="uistore.isModalOpen"
            footer=""
            title="Add New Spoilage Maintenance"
        >
            <Create
                :items="items"
                :user_id="user_id"
                :branchs="branchs"
                @saveHandler="saveHandler"
            />
        </a-modal>
        <List :spoilageMaintenances="spoilageMaintenances" />
    </AdminLayout>
</template>

<script setup>
const props = defineProps([
    "items",
    "spoilageMaintenances",
    "user_id",
    "branchs",
]);

import AdminLayout from "@/Layouts/AdminLayout/AdminLayout.vue";
import AppHeader from "@/Shared/AppHeader.vue";
import AddNewButton from "@/Shared/AddNewButton.vue";
import Create from "../Components/SpoilageMaintenance/Create.vue";
import List from "../Components/SpoilageMaintenance/List.vue";

import { UIStore } from "@/Stores/UIStore";
import { Modal } from "ant-design-vue";
import { router } from "@inertiajs/vue3";
console.log(props.spoilageMaintenances);
const uistore = UIStore();
const saveHandler = (formData) => {
    router.post(route("spoilage.store"), formData, {
        onSuccess: () => {
            uistore.closeModal();
            Modal.success({
                title: "Spoilage Maintenance",
                content: "Successfully Saved",
                okType: "default",
            });
        },
    });
};
</script>

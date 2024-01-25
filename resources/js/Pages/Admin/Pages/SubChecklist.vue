<template>
    <AdminLayout>
        <AppHeader title="Sub Checklist Management" />
        <AddNewButton title="Add New Sub checklist" />
        <a-modal
            v-model:open="uistore.isModalOpen"
            footer=""
            title="Add New Sub checklist"
        >
            <Create @saveHandler="saveHandler" :mainCheckList="mainCheckList" />
        </a-modal>
        <List :subchecklists="subchecklists" @deleteHandler="deleteHandler" />
    </AdminLayout>
</template>

<script setup>
const props = defineProps({
    subchecklists: Array,
    mainCheckList: Array,
});
console.log(props.subchecklists);
import AdminLayout from "@/Layouts/AdminLayout/AdminLayout.vue";
import AppHeader from "@/Shared/AppHeader.vue";
import AddNewButton from "@/Shared/AddNewButton.vue";
import Create from "../../Admin/Components/SubChecklist/Create.vue";
import List from "../../Admin/Components/SubChecklist/List.vue";
import { UIStore } from "@/Stores/UIStore";
const uistore = UIStore();
import { Modal } from "ant-design-vue";
import { router } from "@inertiajs/vue3";

const saveHandler = (formData) => {
    console.log(formData);
    router.post(route("subchecklist.store"), formData, {
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
    router.delete(`sub_checklist/${id}`, {
        onSuccess: () => {
            Modal.success({
                title: "Sub Checklist",
                content: "Successfuly Saved",
                okType: "danger",
            });
        },
    });
};
</script>

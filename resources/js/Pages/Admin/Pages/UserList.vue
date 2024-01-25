<template>
    <AdminLayout>
        <AppHeader title="Employee Management" />
        <AddNewButton title="Add New Employee" />
        <a-modal
            v-model:open="uistore.isModalOpen"
            footer=""
            title="Add New User"
            style="width: 500px"
        >
            <Create
                @saveHandler="saveHandler"
                :branches="branches"
                :departments="departments"
                :subChecklists="subChecklists"
            />
        </a-modal>
        <List :userList="userList" @deleteHandler="deleteHandler" />
    </AdminLayout>
</template>

<script setup>
const props = defineProps({
    userList: Array,
    branches: Array,
    departments: Array,
    subChecklists: Object,
});
console.log(props.userList);
import AdminLayout from "@/Layouts/AdminLayout/AdminLayout.vue";
import AppHeader from "@/Shared/AppHeader.vue";
import AddNewButton from "@/Shared/AddNewButton.vue";
import Create from "../Components/User/Create.vue";
import List from "../Components/User/List.vue";
import { UIStore } from "@/Stores/UIStore";
import { router } from "@inertiajs/vue3";
import { Modal } from "ant-design-vue";
const uistore = UIStore();
const saveHandler = (formData) => {
    router.post(route("add.user"), formData, {
        onSuccess: () => {
            uistore.closeModal(),
                Modal.success({
                    title: "User",
                    content: "Successfully Saved",
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
    console.log(formData);
};
const deleteHandler = (id) => {
    console.log(id);
    router.delete(`/user_list/${id}`, {
        onSuccess: () => {
            Modal.success({
                title: "User",
                content: "User Successfully Deleted",
                okType: "default",
            });
        },
    });
};
</script>

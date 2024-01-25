<template>
    <SupervisorLayout>
        <AppHeader title="Breakage Maintenance Management" />
        <AddNewButton title="Add New Breakage" />

        <a-modal
            v-model:open="uistore.isModalOpen"
            footer=""
            title="Add New Breakage Maintenance"
        >
            <Create
                :items="items"
                :user_id="user_id"
                :branchs="branchs"
                :departments="departments"
                @saveHandler="saveHandler"
            />
        </a-modal>

        <a-modal
            v-model:open="viewImage"
            footer=""
            title="View Breakage Detail"
        >
            <div class="flex justify-between mb-appSmallSize">
                <h3>Breakage Item</h3>
                {{ breakageDetail.item.name }}
            </div>
            <div class="flex justify-between mb-appSmallSize">
                <h3>Quantity</h3>
                {{ breakageDetail.quantity }}
            </div>
            <div class="flex justify-between mb-appSmallSize">
                <h3>Branch</h3>
                {{ breakageDetail.branch.name }}
            </div>
            <div class="flex justify-between mb-appSmallSize">
                <h3>Department</h3>
                {{ breakageDetail.department.name }}
            </div>
            <div class="flex justify-between mb-appSmallSize">
                <h3>Breakaged By</h3>
                {{ breakageDetail.user.name }}
            </div>
            <div class="flex justify-between mb-appSmallSize">
                <h3>Date</h3>

                <h3
                    class="bg-appfirstColor-0 rounded-xl text-appWhiteColor-0 px-appSmallSize"
                >
                    {{ breakageDetail.date }}
                </h3>
            </div>

            <img :src="'/images/' + breakageDetail.image" alt="pic" />
        </a-modal>

        <List
            :breakageMaintenances="breakageMaintenances"
            @viewHandler="viewHandler"
        />
    </SupervisorLayout>
</template>

<script setup>
const props = defineProps([
    "items",
    "breakageMaintenances",
    "user_id",
    "branchs",
    "departments",
]);

import SupervisorLayout from "@/Layouts/SupervisorLayout/SupervisorLayout.vue";
import AppHeader from "@/Shared/AppHeader.vue";
import AddNewButton from "@/Shared/AddNewButton.vue";
import Create from "../Components/BreakageMaintenance/Create.vue";
import List from "../Components/BreakageMaintenance/List.vue";
import { UIStore } from "@/Stores/UIStore";
import { router } from "@inertiajs/vue3";
import { Modal } from "ant-design-vue";
import { ref } from "vue";
const uistore = UIStore();
const viewImage = ref(false);
const breakageDetail = ref(null);
const saveHandler = (formData) => {
    router.post(route("breakage.supervisor.store"), formData, {
        onSuccess: () => {
            uistore.closeModal();
            Modal.success({
                title: "Breakage",
                content: "Successfully Saved",
                okType: "default",
            });
        },
        onError: (error) => {
            Modal.error({
                title: "Error",
                content: error,
                okType: "default",
            });
        },
    });
    console.log(formData);
};

const viewHandler = (item) => {
    viewImage.value = true;
    breakageDetail.value = item;
};
</script>

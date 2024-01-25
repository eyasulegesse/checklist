<template>
    <SupervisorLayout
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
                :departments="departments"
                @saveHandler="saveHandler"
            />
        </a-modal>
        <a-modal
            v-model:open="viewImage"
            footer=""
            title="View Spoilage Detail"
        >
            <div class="flex justify-between mb-appSmallSize">
                <h3>Spoilaged Item</h3>
                {{ spoilageDetail.item.name }}
            </div>
            <div class="flex justify-between mb-appSmallSize">
                <h3>Quantity</h3>
                {{ spoilageDetail.quantity }}
            </div>
            <div class="flex justify-between mb-appSmallSize">
                <h3>Branch</h3>
                {{ spoilageDetail.branch.name }}
            </div>
            <div class="flex justify-between mb-appSmallSize">
                <h3>Department</h3>
                {{ spoilageDetail.department.name }}
            </div>
            <div class="flex justify-between mb-appSmallSize">
                <h3>Spoilaged By</h3>
                {{ spoilageDetail.user.name }}
            </div>
            <div class="flex justify-between mb-appSmallSize">
                <h3>Date</h3>

                <h3
                    class="bg-appfirstColor-0 rounded-xl text-appWhiteColor-0 px-appSmallSize"
                >
                    {{ spoilageDetail.date }}
                </h3>
            </div>

            <img :src="'/images/' + spoilageDetail.image" alt="pic" />
        </a-modal>
        <List
            :spoilageMaintenances="spoilageMaintenances"
            @viewHandler="viewHandler"
        />
    </SupervisorLayout>
</template>

<script setup>
const props = defineProps({
    items: Array,
    spoilageMaintenances: Array,
    user_id: Array,
    branchs: Array,
    departments: Array,
});

import SupervisorLayout from "@/Layouts/SupervisorLayout/SupervisorLayout.vue";
import AppHeader from "@/Shared/AppHeader.vue";
import AddNewButton from "@/Shared/AddNewButton.vue";
import Create from "../Components/SpoilageMaintenance/Create.vue";
import List from "../Components/SpoilageMaintenance/List.vue";

import { UIStore } from "@/Stores/UIStore";
import { Modal } from "ant-design-vue";
import { router } from "@inertiajs/vue3";
import { ref } from "vue";
const viewImage = ref(false);
const spoilageDetail = ref(null);
const uistore = UIStore();
const saveHandler = (formData) => {
    router.post(route("spoilage.supervisor.store"), formData, {
        onSuccess: () => {
            uistore.closeModal();
            Modal.success({
                title: "Spoilage Maintenance",
                content: "Successfully Saved",
                okType: "default",
            });
        },
        onError: (error) => {
            Modal.error({
                title: "Error",

                okType: "danger",
            });
        },
    });
};

const viewHandler = (item) => {
    viewImage.value = true;
    spoilageDetail.value = item;
};
</script>

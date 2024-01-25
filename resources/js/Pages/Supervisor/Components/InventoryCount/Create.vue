<template>
    <SupervisorLayout
        ><AppHeader title="Inventory Count" />
        <a-form
            :model="formState"
            class="mt-appBigSpace"
            layout="vertical"
            @finish="onFinish"
        >
            <div class="grid grid-cols-5 gap-appSmallSize mb-appBigSpace">
                <a-form-item label="Select Item">
                    <a-select
                        show-search
                        placeholder="Select Item"
                        v-model:value="item.item_id"
                    >
                        <a-select-option
                            v-for="item in items"
                            :key="item.id"
                            :value="item.id"
                            >{{ item.name }}({{ item.code }})
                        </a-select-option>
                    </a-select>
                </a-form-item>
                <a-form-item label="Amount">
                    <a-input
                        placeholder="Enter Amount"
                        v-model:value="item.amount"
                    />
                </a-form-item>
                <a-form-item label="Select Branch">
                    <a-select
                        placeholder="Select Branch"
                        @change="branchChangeHandler"
                        v-model:value="item.branch_id"
                    >
                        <a-select-option
                            v-for="branch in branches"
                            :key="branch.id"
                            :value="branch.id"
                            >{{ branch.name }}</a-select-option
                        >
                    </a-select>
                </a-form-item>

                <a-form-item label="Select Department">
                    <a-select
                        placeholder="Select Department"
                        v-model:value="item.department_id"
                    >
                        <a-select-option
                            v-for="department in selectedDepartments"
                            :key="department.id"
                            :value="department.id"
                            >{{ department.name }}</a-select-option
                        >
                    </a-select>
                    <!-- //     d -->
                </a-form-item>
                <a-button
                    @click="addHandler"
                    class="bg-appfirstColor-0 w-[100px] mt-appMiddeumSpace text-appWhiteColor-0"
                    >Add</a-button
                >
            </div>
            <table class="ml-appMiddeumSpace mr-appMiddeumSpace mb-appBigSpace">
                <tr class="text-[14px]">
                    <th>Item Name</th>
                    <th>Amount</th>
                    <th>Branch</th>
                    <th>Action</th>
                </tr>

                <tr
                    v-for="(body, index) in formState.inventoryCount"
                    :key="index"
                    class="text-[12px]"
                >
                    <td>{{ body.item_name }}</td>
                    <td>{{ body.amount }}</td>
                    <td>{{ body.branch_id }}</td>
                    <td>
                        <Icon
                            v-show="actions.delete"
                            icon="ep:delete-filled"
                            color="red"
                            width="16"
                            class="mr-appExtraSmallMargin"
                            @click="deleteHandler(body.item_id)"
                        />
                    </td>
                </tr>
            </table>

            <ActionButton />
        </a-form>
    </SupervisorLayout>
</template>

<script setup>
const props = defineProps({
    items: Array,
    branches: Array,
    departments: Array,
});
const emit = defineEmits(["saveHandler"]);
import SupervisorLayout from "@/Layouts/SupervisorLayout/SupervisorLayout.vue";
import AppHeader from "@/Shared/AppHeader.vue";
import ActionButton from "@/Shared/ActionButton.vue";
import Table from "@/Shared/Table.vue";
import { reactive, ref } from "vue";
import { router } from "@inertiajs/vue3";

import { Modal } from "ant-design-vue";
const selectedDepartments = ref(null);
const itemTwo = ref([
    {
        item_id: null,
        branch_id: null,
        department_id: null,
        amount: null,
    },
]);
const item = ref([
    {
        item_id: null,
        branch_id: null,
        amount: null,
    },
]);

const formState = reactive({
    date: null,
    branch_id: null,
    inventoryCount: [],
});
const actions = {
    delete: "delete",
};

const filterOption = (input, option) => {
    console.log(input);
    return value.value.toLowerCase().indexOf(input.toLowerCase()) >= 0;
};
const branchChangeHandler = (value) => {
    selectedDepartments.value = props.departments.filter(
        (dep) => dep.branch_id == value
    );
};
const addHandler = () => {
    itemTwo.value = props.items.filter((ite) => ite.id == item.value.item_id);

    if (itemTwo.value.length > 0) {
        console.log(item.value.length);

        item.value.forEach((element) => {
            const l = element.item_id;
            console.log(element);
            // formState.inventoryCount.push({
            //     item_id: item.value["item_id"],
            // });
        });
        // itemTwo.value = item.value.map((item_id, item) => {
        //     ({ item_id: item });
        //     // formState.inventoryCount.push({
        //     //     item_id: item.value[key],
        //     // });
        // });
        console.log(formState.inventoryCount);
        // console.log(item.value["item_id"]);

        //  console.log(formState.inventoryCount);
    } else {
        formState.inventoryCount.filter(
            (items) => items.item_id === item.value.item_id
        )[0].amount =
            Number(
                formState.inventoryCount.filter(
                    (items) => props.items.id === item.value.item_id
                )[0].amount
            ) + Number(item.value.amount);
    }
    item.value = [];
};

const onFinish = () => {
    var date = new Date().toJSON().slice(0, 10).replace(/-/g, "/");
    formState.date = date;

    router.post(route("inventory.count.store"), formState, {
        onSuccess: () => {
            Modal.success({
                title: "Inventory Count",
                content: "Saved Successfully",
                okType: "default",
            });
        },
        onError: () => {
            Modal.error({
                title: "Inventory Count",
                content: "Saved Successfully",
                okType: "default",
            });
        },
    });

    emit("saveHandler", formState);
};

const deleteHandler = (id) => {
    formState.inventoryCount = formState.inventoryCount.filter((item) => {
        return item.item_id !== id;
    });
};
</script>

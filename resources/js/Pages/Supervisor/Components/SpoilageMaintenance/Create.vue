<template>
    <a-form :model="formState" layout="vertical" @finish="onFinish">
        <div class="mb-appSmallSize">
            <a-form-item
                label="Item Name"
                name="item_id"
                :rules="[{ required: true, message: 'Item Field is required' }]"
            >
                <a-select
                    show-search
                    placeholder="Select Item"
                    @change="itemChangeHandler"
                >
                    <a-select-option
                        v-for="item in items"
                        :key="item.id"
                        :value="item.name"
                        >{{ item.name }}({{ item.code }})</a-select-option
                    >
                </a-select>
                <InputError
                    :message="$page.props.errors.item_id"
                    class="text-[red]"
                />
            </a-form-item>
        </div>

        <div class="mb-appSmallSize">
            <a-form-item
                label="Branch"
                name="branch_id"
                :rules="[
                    { required: true, message: 'Branch Field is required' },
                ]"
            >
                <a-select
                    placeholder="Select Branch"
                    v-model:value="formState.branch_id"
                    @change="branchChangeHandler"
                >
                    <a-select-option
                        v-for="branch in branchs"
                        :key="branch.id"
                        :value="branch.id"
                        >{{ branch.name }}</a-select-option
                    >
                </a-select>
                <InputError
                    :message="$page.props.errors.branch_id"
                    class="text-[red]"
                />
            </a-form-item>
        </div>

        <div class="mb-appSmallSize">
            <a-form-item
                label="Department"
                name="department_id"
                :rules="[
                    { required: true, message: 'Department Field is required' },
                ]"
            >
                <a-select
                    placeholder="Select Department"
                    v-model:value="formState.department_id"
                >
                    <a-select-option
                        v-for="department in selectedDepartment"
                        :key="department.id"
                        :value="department.id"
                        >{{ department.name }}</a-select-option
                    >
                </a-select>
                <InputError
                    :message="$page.props.errors.department_id"
                    class="text-[red]"
                />
            </a-form-item>
        </div>

        <div class="mb-appSmallSize">
            <a-form-item
                label="Quantity"
                name="quantity"
                :rules="[
                    { required: true, message: 'Quantity Field is required' },
                ]"
            >
                <a-input-number
                    class="w-full"
                    placeholder="Select Quantity"
                    v-model:value="formState.quantity"
                />
                <InputError
                    :message="$page.props.errors.quantity"
                    class="text-[red]"
                />
            </a-form-item>
        </div>
        <div>
            <a-form-item
                label="Remark"
                name="remark"
                :rules="[
                    { required: true, message: 'Remark Field is required' },
                ]"
            >
                <a-textarea :rows="4" v-model:value="formState.remark" />
                <InputError
                    :message="$page.props.errors.remark"
                    class="text-[red]"
                />
            </a-form-item>
            <div class="my-appBigSpace">
                <label for="small-file-input" class="sr-only"
                    >Choose Photo</label
                >
                <input
                    type="file"
                    @change="handleFileUpload"
                    name="small-file-input"
                    id="small-file-input"
                    class="block w-full border border-gray-200 shadow-sm rounded-lg text-sm focus:z-10 focus:border-blue-500 focus:ring-blue-500 disabled:opacity-50 disabled:pointer-events-none dark:bg-slate-900 dark:border-gray-700 dark:text-gray-400 dark:focus:outline-none dark:focus:ring-1 dark:focus:ring-gray-600 file:bg-gray-50 file:border-0 file:bg-gray-100 file:me-4 file:py-2 file:px-4 dark:file:bg-gray-700 dark:file:text-gray-400"
                />
            </div>
        </div>

        <ActionButton />
    </a-form>
</template>

<script setup>
const emit = defineEmits(["saveHandler"]);
const props = defineProps({
    items: Array,
    user_id: Array,
    branchs: Array,
    departments: Array,
});

import { reactive, ref } from "vue";
import ActionButton from "@/Shared/ActionButton.vue";
import InputError from "@/Components/InputError.vue";
const selectedDepartment = ref(null);
const formState = reactive({
    date: null,
    quantity: null,
    remark: null,
    item_id: null,
    branch_id: null,
    department_id: null,
    user_id: props.user_id,
    image: null,
});
const branchChangeHandler = (branch_id) => {
    selectedDepartment.value = props.departments.filter(
        (dep) => dep.branch_id == branch_id
    );
};

const itemChangeHandler = (value) => {
    const selecteditem = props.items.filter((item) => item.name == value);
    selecteditem.forEach((element) => {
        formState.item_id = element["id"];
    });
};

const onFinish = () => {
    var date = new Date().toJSON().slice(0, 10).replace(/-/g, "/");
    formState.date = date;

    emit("saveHandler", formState);
};
const handleFileUpload = (event) => {
    formState.image = event.target.files[0];
};
</script>

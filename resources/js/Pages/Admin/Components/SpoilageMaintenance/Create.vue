<template>
    <a-form :model="formState" layout="vertical" @finish="onFinish">
        <div class="mb-appSmallSize">
            <a-form-item
                label="Item Name"
                name="item_id"
                :rules="[{ required: true, message: 'Item Field is required' }]"
            >
                <a-select
                    placeholder="Select Item"
                    v-model:value="formState.item_id"
                >
                    <a-select-option
                        v-for="item in items"
                        :key="item.id"
                        :value="item.id"
                        >{{ item.name }}</a-select-option
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
        </div>
        <ActionButton />
    </a-form>
</template>

<script setup>
const emit = defineEmits(["saveHandler"]);
const props = defineProps(["items", "user_id", "branchs"]);
import { reactive } from "vue";
import ActionButton from "@/Shared/ActionButton.vue";
import InputError from "@/Components/InputError.vue";
const formState = reactive({
    date: null,
    quantity: null,
    remark: null,
    item_id: null,
    user_id: props.user_id,
});

const onFinish = () => {
    var date = new Date().toJSON().slice(0, 10).replace(/-/g, "/");
    formState.date = date;

    emit("saveHandler", formState);
};
</script>

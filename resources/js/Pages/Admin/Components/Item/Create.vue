<template>
    <a-form :model="formState" layout="vertical" @finish="onFinish">
        <div class="mb-appSmallSize">
            <a-form-item
                label="Item Code"
                name="code"
                :rules="[
                    { required: true, message: 'Item Code Field is required' },
                ]"
            >
                <a-input
                    placeholder="Enter Item code"
                    v-model:value="formState.code"
                />
                <InputError :message="$page.props.errors.code" />
            </a-form-item>
        </div>
        <div class="mb-appSmallSize">
            <a-form-item
                label="Item Name"
                name="name"
                :rules="[
                    { required: true, message: 'Item Name Field is required' },
                ]"
            >
                <a-input
                    placeholder="Enter Item Name"
                    v-model:value="formState.name"
                />
                <InputError :message="$page.props.errors.name" />
            </a-form-item>
        </div>

        <div class="mb-appSmallSize">
            <a-form-item
                label="Category"
                name="category_id"
                :rules="[
                    {
                        required: true,
                        message: 'Item Category Field is required',
                    },
                ]"
            >
                <a-select
                    v-model:value="formState.category_id"
                    placeholder="Select Category"
                >
                    <a-select-option
                        v-for="categorie in categories"
                        :key="categorie.id"
                        :value="categorie.id"
                        >{{ categorie.name }}</a-select-option
                    >
                </a-select>
                <InputError :message="$page.props.errors.catergoryId" />
            </a-form-item>
        </div>

        <ActionButton />
    </a-form>
</template>

<script setup>
defineProps(["categories"]);
import { reactive } from "vue";
import ActionButton from "@/Shared/ActionButton.vue";
import InputError from "@/Components/InputError.vue";
const emit = defineEmits(["saveHandler"]);
const formState = reactive({
    name: null,
    code: null,
    category_id: null,
});

const onFinish = () => {
    emit("saveHandler", formState);
};
</script>

<template>
    <a-table :dataSource="dataSource" :columns="columns">
        <template #headerCell="{ column }">
            <template v-if="column.key === 'action'">
                <span class="flex">
                    <Icon
                        icon="uil:edit"
                        color="#082f49"
                        width="16"
                        class="mr-3"
                    />
                    Action
                </span>
            </template>
        </template>

        <template #bodyCell="{ column, record }">
            <template v-if="column.key === 'Role'">
                <h3 v-if="record.role === 1">Admin</h3>
                <h3 v-if="record.role === 0">Supervisor</h3>
            </template>

            <template v-if="column.key === 'action'">
                <span>
                    <div class="flex">
                        <Icon
                            v-if="actions.view"
                            icon="carbon:view-filled"
                            color="#082f49"
                            width="16"
                            class="mr-appExtraSmallMargin"
                            @click="$emit('viewHandler', record)"
                        />
                        <Icon
                            v-show="actions.delete"
                            icon="ep:delete-filled"
                            color="red"
                            width="16"
                            class="mr-appExtraSmallMargin"
                            @click="$emit('deleteHandler', record.id)"
                        />
                        <Icon
                            v-show="actions.edit"
                            icon="bx:edit"
                            color="#082f49"
                            width="16"
                            class="mr-appExtraSmallMargin"
                        />
                        <Icon
                            v-show="actions.assign"
                            icon="uil:edit"
                            color="#082f49"
                            width="16"
                            class="mr-appExtraSmallMargin"
                        />
                    </div>
                </span>
            </template>
        </template>
    </a-table>
</template>

<script setup>
defineProps(["dataSource", "columns", "actions"]);
let emit = defineEmits(["deleteHandler", "viewHandler"]);
</script>

<style scoped></style>

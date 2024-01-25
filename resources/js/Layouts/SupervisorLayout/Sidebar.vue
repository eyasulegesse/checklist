<template>
    <div
        class="bg-[#164863] h-screen"
        :style="{ width: uistore.collapsed ? '100px' : '316px' }"
    >
        <div
            class="flex justify-between items-center bg-appSecondColor-0 h-[70px] pl-appSmallSize"
        >
            <h1
                class="text-[#fff] font-bold"
                :style="{ fontSize: uistore.collapsed ? '10px' : '20px' }"
            >
                <span class="text-[#F3EEEA]">Leofam management group </span>
            </h1>
            <Icon
                @click="uistore.toggleCollapsed"
                icon="mi:menu"
                color="white"
                width="16"
                :type="uistore.collapsed ? 'menu-unfold' : 'menu-fold'"
            />
        </div>

        <a-menu
            :defaultSelectedKeys="['1']"
            :defaultOpenKeys="['sub1']"
            mode="inline"
            class="bg-[#164863] pt-appBigSpace h-screen"
            :inlineCollapsed="uistore.collapsed"
            @click="handleClick"
        >
            <a-menu-item key="/">
                <template #icon
                    ><Icon icon="ri:dashboard-fill" color="white" width="16" />
                </template>
                Dashboard
            </a-menu-item>
            <a-menu-item key="/supervisor_checklist">
                <template #icon
                    ><Icon icon="ci:list-checklist" color="white" width="16" />
                </template>
                Checklist
            </a-menu-item>
            <a-sub-menu key="itm">
                <template #icon>
                    <Icon icon="basil:user-solid" color="white" width="16" />
                </template>
                <template #title>Task Management</template>
                <a-menu-item-group key="g1">
                    <template #icon>
                        <Icon
                            icon="basil:user-solid"
                            color="white"
                            width="16"
                        />
                    </template>

                    <a-menu-item key="assigned_task">
                        <template #icon
                            ><Icon
                                icon="basil:user-solid"
                                color="white"
                                width="16"
                            />
                        </template>
                        Assigned Task
                    </a-menu-item>
                    <a-menu-item key="assign_task">
                        <template #icon
                            ><Icon
                                icon="eos-icons:cluster-role-binding"
                                color="white"
                                width="16"
                            />
                        </template>
                        Assign Task
                    </a-menu-item>
                </a-menu-item-group>
            </a-sub-menu>

            <a-sub-menu key="inventory">
                <template #icon>
                    <Icon
                        icon="fluent-mdl2:product-variant"
                        color="white"
                        width="16"
                    />
                </template>
                <template #title>Inventory Management</template>
                <a-menu-item-group key="im">
                    <template #icon>
                        <Icon
                            icon="basil:user-solid"
                            color="white"
                            width="16"
                        />
                    </template>

                    <a-menu-item key="inventory_count">
                        <template #icon
                            ><Icon
                                icon="material-symbols:inventory-2"
                                color="white"
                                width="16"
                            />
                        </template>
                        Inventory Count
                    </a-menu-item>

                    <a-menu-item key="/breakage-supervisor">
                        <template #icon
                            ><Icon icon="mdi:dirty" color="white" width="16" />
                        </template>
                        Breakage Maintenance
                    </a-menu-item>
                    <a-menu-item key="/spoilage-supervisor-index">
                        <template #icon
                            ><Icon icon="mdi:dirty" color="white" width="16" />
                        </template>
                        Spoilage Maintenance
                    </a-menu-item>
                </a-menu-item-group>
            </a-sub-menu>

            <a-sub-menu key="rm">
                <template #icon>
                    <Icon icon="mdi:report-bar" color="white" width="16" />
                </template>
                <template #title>Report Management</template>
                <a-menu-item-group key="g1">
                    <template #icon>
                        <Icon icon="mdi:report-box" color="white" width="16" />
                    </template>

                    <a-menu-item key="send_report">
                        <template #icon
                            ><Icon
                                icon="mdi:report-box"
                                color="white"
                                width="16"
                            />
                        </template>
                        Send Report
                    </a-menu-item>
                    <a-menu-item key="incoming_report">
                        <template #icon
                            ><Icon
                                icon="icon-park-outline:incoming"
                                color="white"
                                width="16"
                            />
                        </template>
                        Incoming Report
                    </a-menu-item>
                </a-menu-item-group>
            </a-sub-menu>
        </a-menu>
    </div>
</template>

<script setup>
import { ref } from "vue";
import { UIStore } from "@/Stores/UIStore";
import { router } from "@inertiajs/vue3";
const uistore = UIStore();
const collapsed = ref(false);

const toggleCollapsed = () => {
    collapsed.value = !collapsed.value;
};
const handleClick = (e) => {
    router.get(e.key);
};
</script>
<style>
.ant-menu-title-content {
    color: white !important;
    padding-left: 10px !important;
    font-size: 12px;
}
.ant-menu-title {
    color: white !important;
}
.ant-menu-item {
    padding-left: 25px !important;
    color: white !important;
}

.ant-menu-item-active {
    background: #427d9d !important;
}
.ant-menu-submenu-arrow {
    color: white !important;
}
.ant-menu-item-selected {
    background: #427d9d !important;
    color: white !important;
}
.ant-menu-submenu {
    padding-left: 0px !important;
}
.ant-menu-submenu-selected {
    background: #427d9d !important;
}
.ant-menu-title-content {
    color: white !important;
}

.ant-menu-submenu {
    padding: 0px !important;
}
.ant-menu-item-group-title {
    padding: 0 !important;
}
.ant-menu-item-group {
    padding-left: 38px;
}
</style>

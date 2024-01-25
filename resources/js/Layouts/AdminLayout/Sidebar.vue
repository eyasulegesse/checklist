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
                :style="{ fontSize: uistore.collapsed ? '10px' : '18px' }"
            >
                <span class="text-[#F3EEEA]">Leofam management group </span>
            </h1>
            <Icon
                @click="uistore.toggleCollapsed"
                icon="mi:menu"
                color="white"
                width="14"
                :type="uistore.collapsed ? 'menu-unfold' : 'menu-fold'"
            />
        </div>

        <a-menu
            :defaultSelectedKeys="['1']"
            :defaultOpenKeys="['sub1']"
            mode="inline"
            class="bg-[#144863] pt-appBigSpace"
            :inlineCollapsed="uistore.collapsed"
            @click="handleClick"
        >
            <a-menu-item key="/">
                <template #icon
                    ><Icon icon="ri:dashboard-fill" color="white" width="14" />
                </template>
                Dashboard
            </a-menu-item>

            <a-menu-item key="/branch">
                <template #icon
                    ><Icon
                        icon="fluent:branch-24-filled"
                        color="white"
                        width="14"
                    />
                </template>
                Branch Management
            </a-menu-item>
            <a-menu-item key="department">
                <template #icon
                    ><Icon
                        icon="mingcute:department-fill"
                        color="white"
                        width="14"
                    />
                </template>
                Department Management
            </a-menu-item>
            <a-menu-item key="task">
                <template #icon
                    ><Icon
                        icon="mingcute:announcement-line"
                        color="white"
                        width="14"
                    />
                </template>
                Task Management
            </a-menu-item>
            <a-sub-menu key="checklist">
                <template #icon>
                    <Icon icon="mdi:report-bar" color="white" width="14" />
                </template>
                <template #title>CheckList Management</template>
                <a-menu-item-group key="g1">
                    <template #icon>
                        <Icon icon="mdi:report-arc" color="white" width="14" />
                    </template>

                    <a-menu-item key="/main_checklist">
                        <template #icon
                            ><Icon
                                icon="mdi:report-arc"
                                color="white"
                                width="14"
                            />
                        </template>
                        Main CheckList
                    </a-menu-item>
                    <a-menu-item key="/sub_checklist">
                        <template #icon
                            ><Icon
                                icon="eos-icons:cluster-role-binding"
                                color="white"
                                width="14"
                            />
                        </template>
                        Sub CheckList
                    </a-menu-item>

                    <a-menu-item key="checklist_task">
                        <template #icon
                            ><Icon
                                icon="eos-icons:cluster-role-binding"
                                color="white"
                                width="14"
                            />
                        </template>
                        Tasks
                    </a-menu-item>
                </a-menu-item-group>
            </a-sub-menu>
            <a-sub-menu key="inventory">
                <template #icon>
                    <Icon icon="basil:user-solid" color="white" width="14" />
                </template>
                <template #title>Inventory Management</template>
                <a-menu-item-group key="i1">
                    <template #icon>
                        <Icon
                            icon="basil:user-solid"
                            color="white"
                            width="14"
                        />
                    </template>
                    <a-menu-item key="count">
                        <template #icon
                            ><Icon
                                icon="jam:page-break"
                                color="white"
                                width="14"
                            />
                        </template>
                        Inventory Count
                    </a-menu-item>
                    <a-menu-item key="breakage">
                        <template #icon
                            ><Icon
                                icon="jam:page-break"
                                color="white"
                                width="14"
                            />
                        </template>
                        Breakage Maintenance
                    </a-menu-item>
                    <a-menu-item key="spoilage">
                        <template #icon
                            ><Icon icon="mdi:dirty" color="white" width="14" />
                        </template>
                        Spoilage Maintenance
                    </a-menu-item>
                </a-menu-item-group>
            </a-sub-menu>

            <a-sub-menu key="itm">
                <template #icon>
                    <Icon
                        icon="fluent-mdl2:product-variant"
                        color="white"
                        width="14"
                    />
                </template>
                <template #title>Item Management</template>
                <a-menu-item-group key="g1">
                    <template #icon>
                        <Icon
                            icon="basil:user-solid"
                            color="white"
                            width="14"
                        />
                    </template>

                    <a-menu-item key="/item">
                        <template #icon
                            ><Icon
                                icon="basil:user-solid"
                                color="white"
                                width="14"
                            />
                        </template>
                        Item
                    </a-menu-item>
                    <a-menu-item key="/item-category">
                        <template #icon
                            ><Icon
                                icon="eos-icons:cluster-role-binding"
                                color="white"
                                width="14"
                            />
                        </template>
                        Category
                    </a-menu-item>
                </a-menu-item-group>
            </a-sub-menu>

            <a-menu-item key="/user-list">
                <template #icon
                    ><Icon icon="basil:user-solid" color="white" width="14" />
                </template>
                Employee Management
            </a-menu-item>

            <a-sub-menu key="report">
                <template #icon>
                    <Icon icon="mdi:report-bar" color="white" width="14" />
                </template>
                <template #title>Report Management </template>
                <a-menu-item-group key="g1">
                    <template #icon>
                        <Icon icon="mdi:report-arc" color="white" width="14" />
                    </template>

                    <a-menu-item key="/report_type">
                        <template #icon
                            ><Icon
                                icon="mdi:report-arc"
                                color="white"
                                width="14"
                            />
                        </template>
                        Report Type
                    </a-menu-item>
                    <a-menu-item key="op1">
                        <template #icon
                            ><Icon
                                icon="eos-icons:cluster-role-binding"
                                color="white"
                                width="14"
                            />
                        </template>
                        Daily Report
                    </a-menu-item>
                </a-menu-item-group>
            </a-sub-menu>

            <a-sub-menu key="leafom">
                <template #icon>
                    <Icon icon="mdi:report-bar" color="white" width="14" />
                </template>
                <template #title>Leofam Management Group Report</template>
                <a-menu-item-group key="g1">
                    <template #icon>
                        <Icon icon="mdi:report-arc" color="white" width="14" />
                    </template>
                    <a-menu-item key="/checklist_report">
                        <template #icon
                            ><Icon
                                icon="mdi:report-arc"
                                color="white"
                                width="14"
                            />
                        </template>
                        Checklist Report
                    </a-menu-item>
                    <a-menu-item key="/breakage_report">
                        <template #icon
                            ><Icon
                                icon="mdi:report-arc"
                                color="white"
                                width="14"
                            />
                        </template>
                        Breakage Report
                    </a-menu-item>
                    <a-menu-item key="/spoilage_report">
                        <template #icon
                            ><Icon
                                icon="eos-icons:cluster-role-binding"
                                color="white"
                                width="14"
                            />
                        </template>
                        Spoilage Report
                    </a-menu-item>
                    <a-menu-item key="/inventory_count_report">
                        <template #icon
                            ><Icon
                                icon="eos-icons:cluster-role-binding"
                                color="white"
                                width="14"
                            />
                        </template>
                        Inventory Count Report
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

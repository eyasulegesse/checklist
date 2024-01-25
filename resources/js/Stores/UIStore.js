import { defineStore } from "pinia";

export const UIStore = defineStore({
    id: "uistore",
    state: () => ({
        isModalOpen: false,
        collapsed: false,
    }),

    actions: {
        openModal() {
            this.isModalOpen = true;
        },
        closeModal() {
            this.isModalOpen = false;
        },
        toggleCollapsed() {
            this.collapsed = !this.collapsed;
        },
    },
});

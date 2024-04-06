import { validateRole } from "@/Components/Example";
import moment from "moment/moment";

export const MenuDashboardValidate = (user) => {
    const MenuAdminDashboard = [
        {
            name: "Dashboard",
            url: `/${validateRole(user?.role_id)}`,
            icon: "fas fa-th-large",
        },
        {
            name: "Stok Barang",
            url: `/${validateRole(user?.role_id)}/stok-barang`,
            icon: "fas fa-store",
        },
        {
            name: "Barang Masuk",
            url: `/${validateRole(user?.role_id)}/barang-masuk`,
            icon: "fas fa-box",
            main: true,
        },
        {
            name: "Barang Keluar",
            url: `/${validateRole(user?.role_id)}/barang-keluar`,
            icon: "fas fa-box",
            main: true,
        },
        {
            name: "Data Mekanik",
            url: `/${validateRole(user?.role_id)}/data-mekanik`,
            icon: "fas fa-user",
        },
        {
            name: "Data Owner",
            url: `/${validateRole(user?.role_id)}/data-owner`,
            icon: "fas fa-user",
        },
        {
            name: "Laporan Rekap",
            url: `/${validateRole(user?.role_id)}/laporan-rekap`,
            icon: "fas fa-file-alt",
        },
    ];

    const MenuOwnerDashboard = [
        {
            name: "Dashboard",
            url: `/${validateRole(user?.role_id)}`,
            icon: "fas fa-th-large",
        },
        {
            name: "Stok Barang",
            url: `/${validateRole(user?.role_id)}/stok-barang`,
            icon: "fas fa-box",
        },
        {
            name: "Laporan Rekap",
            url: `/${validateRole(user?.role_id)}/laporan-rekap`,
            icon: "fas fa-file-alt",
        },
    ];
    const MenuMekanikDashboard = [
        {
            name: "Dashboard",
            url: "/",
            icon: "fas fa-th-large",
        },
        {
            name: "Barang Keluar",
            url: `/barang-keluar`,
            icon: "fas fa-box",
            main: true,
        },
        {
            name: "Laporan Rekap",
            url: "/laporan-rekap",
            icon: "fas fa-file-alt",
        },
    ];

    switch (user?.role_id) {
        case 1:
            return MenuAdminDashboard;
        case 2:
            return MenuOwnerDashboard;
        case 3:
            return MenuMekanikDashboard;
    }
};

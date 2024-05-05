import { formatRupiah } from "@/Components/Example";
import moment from "moment/moment";
import "moment/locale/id";
moment.locale("id");
import React from "react";
import { useEffect } from "react";
import { useState } from "react";
import { usePage } from "@inertiajs/react";

export default function Dashboard() {
    const { data } = usePage().props;
    const [dataBarangKeluar, setDataBarangKeluar] = useState(data.BarangKeluar);
    const [dataBarangMasuk, setDataBarangMasuk] = useState(data.BarangMasuk);
    const [dataPengeluaran, setDataPengeluaran] = useState(data.pengeluaran);
    const [dataPendapatan, setDataPendapatan] = useState(data.pendapatan);
    const [date, setDate] = useState(new Date());

    useEffect(() => {
        const filteredDataBarangKeluar = data.BarangKeluar?.filter((item) => {
            return (
                moment(item.tanggal_keluar).format("YYYY-MM-DD") ===
                moment(date).format("YYYY-MM-DD")
            );
        });
        setDataBarangKeluar(filteredDataBarangKeluar);

        const filteredDataBarangMasuk = data.BarangMasuk?.filter((item) => {
            return (
                moment(item.tanggal_masuk).format("YYYY-MM-DD") ===
                moment(date).format("YYYY-MM-DD")
            );
        });
        setDataBarangMasuk(filteredDataBarangMasuk);

        const filteredDataPendapatan = data.pendapatan?.filter((item) => {
            return (
                moment(item.tanggal_keluar).format("YYYY-MM-DD") ===
                moment(date).format("YYYY-MM-DD")
            );
        });
        setDataPendapatan(filteredDataPendapatan);

        const filteredDataPengeluaran = data.pengeluaran?.filter((item) => {
            return (
                moment(item.tanggal_masuk).format("YYYY-MM-DD") ===
                moment(date).format("YYYY-MM-DD")
            );
        });
        setDataPengeluaran(filteredDataPengeluaran);
    }, [data, date]);

    const handleDate = (e) => {
        setDate(e.target.value);
    };

    const getTodayDate = () => {
        const today = new Date();
        const year = today.getFullYear();
        let month = today.getMonth() + 1;
        let day = today.getDate();

        // Pad single digit month and day with leading zero if needed
        if (month < 10) {
            month = "0" + month;
        }
        if (day < 10) {
            day = "0" + day;
        }

        return `${year}-${month}-${day}`;
    };

    const RptoInt = (str) => {
        return parseInt(str.replace(/[^0-9]/g, ""));
    };

    const barangKeluar = dataBarangKeluar.map((item) => {
        return {
            kuantitas: parseInt(item.kuantitas),
        };
    });

    const barangMasuk = dataBarangMasuk.map((item) => {
        return {
            kuantitas: parseInt(item.kuantitas),
        };
    });

    const sumKuantitas = (data) => {
        let total = 0;
        data.forEach((item) => {
            total += item.kuantitas;
        });
        return total;
    };

    const pendapatan = dataPendapatan.map((item) => {
        return {
            kuantitas: item.barang.kuantitas,
            harga: RptoInt(item.barang.harga),
        };
    });

    const pengeluaran = dataPengeluaran.map((item) => {
        return {
            kuantitas: item.barang.kuantitas,
            harga: RptoInt(item.barang.harga),
        };
    });

    const keseluruhan_pendapatan = data.pendapatan.map((item) => {
        return {
            kuantitas: item.barang.kuantitas,
            harga: RptoInt(item.barang.harga),
        };
    });

    const keseluruhan_pengeluaran = data.pengeluaran.map((item) => {
        return {
            kuantitas: item.barang.kuantitas,
            harga: RptoInt(item.barang.harga),
        };
    });

    const sumTotalBarangHarga = (data) => {
        let total = 0;
        data.forEach((item) => {
            total += item.harga * item.kuantitas;
        });
        return total;
    };

    const sumTotal = (pendapatan, pengeluaran) => {
        return (
            sumTotalBarangHarga(pendapatan) - sumTotalBarangHarga(pengeluaran)
        );
    };

    return (
        <div className="flex flex-col w-full gap-4">
            <div className="flex justify-between">
                <h1 className="text-2xl font-extrabold text-gray-800 flex flex-row gap-4 items-center">
                    Rekapitulasi{" "}
                    <p className="text-lg text-gray-400 underline">
                        {moment(date).format("LL") || getTodayDate()}
                    </p>
                </h1>
                <input
                    type="date"
                    value={moment(date).format("YYYY-MM-DD") || getTodayDate()}
                    onChange={handleDate}
                    className="input input-bordered"
                />
            </div>
            <div className="w-full flex flex-row justify-between">
                <div className="w-full p-3 bg-white border flex flex-col gap-5">
                    <h1 className="text-md text-gray-400 font-extrabold">
                        Barang Masuk
                    </h1>
                    <h2 className="text-xl text-gray-800 font-extrabold">
                        {sumKuantitas(barangMasuk)}
                    </h2>
                    <p className="text-xs text-gray-400">
                        Total kuantitas barang yang masuk
                    </p>
                </div>
                <div className="w-full p-3 bg-white border flex flex-col gap-5">
                    <h1 className="text-md text-gray-400 font-extrabold">
                        Pengeluaran
                    </h1>
                    <h2 className="text-xl text-gray-800 font-extrabold">
                        {formatRupiah(
                            `${sumTotalBarangHarga(pengeluaran)}`,
                            "Rp"
                        )}
                    </h2>
                    <p className="text-xs text-gray-400">
                        Total pengeluaran yang dikeluarkan
                    </p>
                </div>
                <div className="w-full p-3 bg-white border flex flex-col gap-5">
                    <h1 className="text-md text-gray-400 font-extrabold">
                        Barang Keluar
                    </h1>
                    <h2 className="text-xl text-gray-800 font-extrabold">
                        {sumKuantitas(barangKeluar)}
                    </h2>
                    <p className="text-xs text-gray-400">
                        Total kuantitas barang yang keluar
                    </p>
                </div>
                <div className="w-full p-3 bg-white border flex flex-col gap-5">
                    <h1 className="text-md text-gray-400 font-extrabold">
                        Pendapatan
                    </h1>
                    <h2 className="text-xl text-gray-800 font-extrabold">
                        {formatRupiah(
                            `${sumTotalBarangHarga(pendapatan)}`,
                            "Rp"
                        )}
                    </h2>
                    <p className="text-xs text-gray-400">
                        Total pendapatan yang didapat
                    </p>
                </div>
                <div className="w-full p-3 bg-white border flex flex-col gap-5">
                    <h1 className="text-md text-gray-400 font-extrabold">
                        Total Pendapatan bersih
                    </h1>
                    <h2 className="text-xl text-gray-800 font-extrabold">
                        {formatRupiah(
                            `${sumTotal(pendapatan, pengeluaran)}`,
                            "Rp"
                        )}
                    </h2>
                    <p className="text-xs text-gray-400">
                        Total pendapatan bersih yang didapat
                    </p>
                </div>
            </div>
            <div className="w-full flex justify-end">
                <div className="w-1/5 p-3 bg-white border flex flex-col gap-5">
                    <h1 className="text-md text-gray-400 font-extrabold">
                        Total Keseluruhan Pengeluaran
                    </h1>
                    <h2 className="text-xl text-gray-800 font-extrabold">
                        {formatRupiah(
                            `${sumTotalBarangHarga(keseluruhan_pengeluaran)}`,
                            "Rp"
                        )}
                    </h2>
                    <p className="text-xs text-gray-400">
                        Total keseluruhan Pengeluaran
                    </p>
                </div>
                <div className="w-1/5 p-3 bg-white border flex flex-col gap-5">
                    <h1 className="text-md text-gray-400 font-extrabold">
                        Total Keseluruhan pendapatan
                    </h1>
                    <h2 className="text-xl text-gray-800 font-extrabold">
                        {formatRupiah(
                            `${sumTotalBarangHarga(keseluruhan_pendapatan)}`,
                            "Rp"
                        )}
                    </h2>
                    <p className="text-xs text-gray-400">
                        Total keseluruhan pendapatan
                    </p>
                </div>
                <div className="w-1/5 p-3 bg-white border flex flex-col gap-5">
                    <h1 className="text-md text-gray-400 font-extrabold">
                       Hasil Dari Pendapatan dan Pengeluaran
                    </h1>
                    <h2 className="text-xl text-gray-800 font-extrabold">
                        {formatRupiah(
                            `${sumTotal(
                                keseluruhan_pendapatan,
                                keseluruhan_pengeluaran
                            )}`,
                            "Rp"
                        )}
                    </h2>
                    <p className="text-xs text-gray-400">
                        Total Hasil Dari Pendapatan dan Pengeluaran
                    </p>
                </div>
            </div>
        </div>
    );
}

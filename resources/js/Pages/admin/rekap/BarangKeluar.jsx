import Layout from "@/Layouts/Layout";
import { Link } from "@inertiajs/react";
import moment from "moment";
import React, { useEffect, useState } from "react";
import ReactPaginate from "react-paginate";

export default function BarangKeluar({ data_barang_keluar: data }) {
    const [data_barang_keluar, setDataBarangKeluar] = useState(data);
    const [date, setDate] = useState(new Date());
    const [itemOffset, setItemOffset] = useState(0);
    const [currentItems, setCurrentItems] = useState([]);
    const [pageCount, setPageCount] = useState(0);
    const [Loading, setLoading] = useState(false);
    const [page, setPage] = useState(5);
    const [search, setSearch] = useState("");
    const [dataModal, setDataModal] = useState([]);


    useEffect(() => {
        setLoading(true);

        const endOffset = parseInt(itemOffset) + parseInt(page);
        const sortData = data_barang_keluar
            ?.sort((a, b) => {
                return a.id - b.id;
            })
            .slice(itemOffset, endOffset);
        setCurrentItems(sortData);
        setPageCount(Math.ceil(data_barang_keluar?.length / page));
        setLoading(false);
    }, [itemOffset, data_barang_keluar, page, date]);

    const handlePageClick = (event) => {
        window.scrollTo({
            top: 60,
            behavior: "smooth",
        });

        const newOffset = (event.selected * page) % data_barang_keluar?.length;

        setItemOffset(newOffset);
    };

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

    const handleSearch = () => {
        const result = data_barang_keluar?.filter((item) => {
            return (
                item.nama_barang.toLowerCase().includes(search.toLowerCase()) ||
                item.kategori.nama_kategori
                    .toLowerCase()
                    .includes(search.toLowerCase()) ||
                item.barang.harga
                    .toLowerCase()
                    .includes(search.toLowerCase()) ||
                item.kuantitas.toLowerCase().includes(search.toLowerCase())
            );
        });

        setDataBarangKeluar(result);
    };

    return (
        <Layout>
            <div className="flex flex-col gap-4">
                <div className="flex justify-between px-3 py-2 bg-white rounded-md shadow-md">
                    <div className="flex  px-5 py-3 gap-10">
                        <div className="flex flex-row items-center justify-center gap-2">
                            <select
                                className="select "
                                value={page}
                                onChange={(e) => setPage(e.target.value)}
                            >
                                {[5, 10, 15, 20].map((item, index) => (
                                    <option key={index} value={item}>
                                        {item}
                                    </option>
                                ))}
                            </select>{" "}
                        </div>
                        <div className="flex flex-row items-center justify-center gap-2">
                            <input
                                type="text"
                                className="input input-bordered "
                                placeholder="Search"
                                value={search}
                                onChange={(e) => setSearch(e.target.value)}
                            />
                            <button className="btn" onClick={handleSearch}>
                                <i className="fas fa-search"></i>{" "}
                            </button>
                        </div>
                    </div>
                    <div className="flex items-center gap-2 px-5 py-3">
                        <p className="text-gray-600 rounded-md text-xl font-extrabold">
                            {moment(
                                data[0].laporan_rekapitulasi.tanggal_rekap
                            ).format("LL")}
                        </p>
                    </div>
                    <div className="flex items-center gap-2 px-5 py-3">
                        <Link
                            href="/admin/laporan-rekap"
                            className="btn bg-red-400/90 text-white rounded-md"
                        >
                            Back
                        </Link>
                    </div>
                </div>{" "}
                <div className="bg-white flex flex-col gap-10 rounded-xl  shadow-md">
                    <div className="overflow-x-auto">
                        <div className="flex justify-normal items-center py-5">
                            <ReactPaginate
                                className="flex flex-row gap-1 w-full justify-end items-center select-none pr-10"
                                nextLabel=">"
                                onPageChange={handlePageClick}
                                pageRangeDisplayed={2}
                                marginPagesDisplayed={1}
                                pageCount={pageCount}
                                previousLabel="<"
                                pageClassName=" text-sm border  p-2 rounded-md "
                                pageLinkClassName=" rounded-md  px-2 py-2 font-semibold font-roboto"
                                previousClassName=" p-2 rounded-md text-blue-800 hover:scale-125 hover:scale text-xl"
                                previousLinkClassName="text-xl p-2  font-semibold font-roboto"
                                nextClassName=" p-2 rounded-md text-blue-800 hover:scale-125 hover:scale text-xl"
                                nextLinkClassName="text-xl p-2  font-semibold font-roboto "
                                breakLabel="..."
                                breakClassName=" p-2 rounded-md text-blue-800"
                                breakLinkClassName="text-sm font-semibold font-roboto "
                                containerClassName="pagination"
                                activeClassName="bg-transparan border border-blue-800 text-blue-800"
                            />
                        </div>
                        <table className="table">
                            <thead>
                                <tr className="font-bold text-lg text-black">
                                    <th>id</th>
                                    <th>nama barang</th>
                                    <th>foto</th>
                                    <th>kategori</th>
                                    <th>harga</th>
                                    <th>barang keluar</th>
                                </tr>
                            </thead>
                            {currentItems?.map((item, index) => (
                                <tbody key={index}>
                                    <tr>
                                        <td className="font-bold">{item.id}</td>
                                        <td className="font-bold max-w-[12rem]">
                                            {item.nama_barang}
                                        </td>
                                        <td className="font-bold">
                                            <img
                                                src={item.barang.url_gambar}
                                                alt=""
                                                className="max-w-[5rem]"
                                            />
                                        </td>
                                        <td className="font-bold">
                                            {item.kategori.nama_kategori}
                                        </td>
                                        <td className="font-bold">
                                            {item.barang.harga}
                                        </td>
                                        <td className="font-bold">
                                            {item.kuantitas}
                                        </td>
                                    </tr>
                                </tbody>
                            ))}
                        </table>
                    </div>
                </div>
            </div>
        </Layout>
    );
}

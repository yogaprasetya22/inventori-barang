import Add from "@/Components/modal/stok/Add";
import Delete from "@/Components/modal/stok/Delete";
import Update from "@/Components/modal/stok/Update";
import Layout from "@/Layouts/Layout";
import React, { useEffect, useState } from "react";
import ReactPaginate from "react-paginate";

export default function StokBarang({ data_barang: data }) {
    const [data_barang, setDataBarang] = useState(data);
    const [itemOffset, setItemOffset] = useState(0);
    const [currentItems, setCurrentItems] = useState([]);
    const [pageCount, setPageCount] = useState(0);
    const [Loading, setLoading] = useState(false);
    const [page, setPage] = useState(5);
    const [dataModal, setDataModal] = useState([]);

    const [search, setSearch] = useState("");

    const handleFilter = () => {
        const kuantitasDibawah10 = data_barang.filter(
            (item) => item.kuantitas < 10
        );
        setDataBarang(kuantitasDibawah10);
    };

    useEffect(() => {
        setLoading(true);
        const endOffset = parseInt(itemOffset) + parseInt(page);
        const sortData = data_barang
            ?.sort((a, b) => {
                return a.id - b.id;
            })
            .slice(itemOffset, endOffset);
        setCurrentItems(sortData);
        setPageCount(Math.ceil(data_barang?.length / page));
        setLoading(false);
    }, [itemOffset, data_barang, page]);

    const handlePageClick = (event) => {
        window.scrollTo({
            top: 60,
            behavior: "smooth",
        });

        const newOffset = (event.selected * page) % data_barang?.length;

        setItemOffset(newOffset);
    };

    const handleSearch = () => {
        const result = data.filter((item) => {
            return (
                item.nama_barang.toLowerCase().includes(search.toLowerCase()) ||
                item.kategori.nama_kategori
                    .toLowerCase()
                    .includes(search.toLowerCase()) ||
                item.harga.toString().includes(search) ||
                item.kuantitas.toString().includes(search) ||
                item.keterangan.toLowerCase().includes(search.toLowerCase())
            );
        });
        setDataBarang(result);
    };

    return (
        <Layout>
            <Add />
            {dataModal && <Update data={dataModal} />}
            {dataModal && <Delete id={dataModal.id} />}
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
                            <button
                                className="btn text-white bg-red-400"
                                onClick={handleFilter}
                            >
                                filter kuantitas dibawah 10
                            </button>
                            <button
                                className="btn text-white bg-blue-400"
                                onClick={() => setDataBarang(data)}
                            >
                                reset data
                            </button>
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
                        <button
                            onClick={() => window.my_modal_1.show()}
                            className="btn bg-indigo-400/90 text-white rounded-md"
                        >
                            Create New
                        </button>
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
                        <table className="table border ">
                            <thead>
                                <tr className="font-bold text-lg text-black">
                                    <th className="text-gray-500 text-center text-md border-x-2">
                                        Id
                                    </th>
                                    <th className="text-gray-500 text-center text-md border-x-2">
                                        nama barang
                                    </th>
                                    <th className="text-gray-500 text-center text-md border-x-2">
                                        Foto
                                    </th>
                                    <th className="text-gray-500 text-center text-md border-x-2">
                                        kategori
                                    </th>
                                    <th className="text-gray-500 text-center text-md border-x-2">
                                        Harga
                                    </th>
                                    <th className="text-gray-500 text-center text-md border-x-2">
                                        Kuantitas
                                    </th>
                                    <th className="text-gray-500 text-center text-md border-x-2">
                                        keterangan
                                    </th>
                                    <th className="text-gray-500 text-center text-md border-x-2">
                                        aksi
                                    </th>
                                </tr>
                            </thead>
                            {currentItems?.map((item, index) => (
                                <tbody key={index}>
                                    <tr>
                                        <td className="font-bold border-x-2">
                                            {item.id}
                                        </td>
                                        <td className="font-bold border-x-2 max-w-[12rem]">
                                            {item.nama_barang}
                                        </td>
                                        <td className="font-bold border-x-2">
                                            <img
                                                src={item.url_gambar}
                                                alt=""
                                                className="max-w-[5rem]"
                                            />
                                        </td>
                                        <td className="font-bold border-x-2">
                                            {item.kategori.nama_kategori}
                                        </td>
                                        <td className="font-bold border-x-2">
                                            {item.harga}
                                        </td>
                                        <td className="font-bold border-x-2">
                                            {item.kuantitas}
                                        </td>
                                        <td className="font-bold border-x-2 max-w-[15rem]">
                                            {item.keterangan}
                                        </td>
                                        <td className="flex flex-row gap-2">
                                            <button
                                                onClick={() => {
                                                    window.my_modal_2.show();
                                                    setDataModal(item);
                                                }}
                                                className="btn bg-yellow-400"
                                            >
                                                <i className="fas fa-edit text-white"></i>
                                            </button>
                                            <button
                                                onClick={() => {
                                                    window.my_modal_3.show();
                                                    setDataModal(item);
                                                }}
                                                className="btn bg-red-400"
                                            >
                                                <i className="fas fa-trash text-white"></i>
                                            </button>
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

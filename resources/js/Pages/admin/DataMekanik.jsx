import Add from "@/Components/modal/mekanik/Add";
import Delete from "@/Components/modal/mekanik/Delete";
import Update from "@/Components/modal/mekanik/Update";
import Layout from "@/Layouts/Layout";
import moment from "moment";
import React, { useEffect, useState } from "react";
import ReactPaginate from "react-paginate";

export default function DataMekanik({ data_mekanik: data }) {
    const [data_mekanik, setDataMekanik] = useState(data);
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
        const sortData = data_mekanik
            .sort((a, b) => {
                return a.id - b.id;
            })
            .slice(itemOffset, endOffset);
        setCurrentItems(sortData);
        setPageCount(Math.ceil(data_mekanik.length / page));
        setLoading(false);
    }, [itemOffset, data_mekanik, page]);

    const handlePageClick = (event) => {
        window.scrollTo({
            top: 60,
            behavior: "smooth",
        });

        const newOffset = (event.selected * page) % data_mekanik.length;

        setItemOffset(newOffset);
    };

    const handleSearch = () => {
        const result = data.filter((item) => {
            return (
                item.name.toLowerCase().includes(search.toLowerCase()) ||
                item.email.toLowerCase().includes(search.toLowerCase())
            );
        });

        setDataMekanik(result);
    }

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
                        </div>
                        <div className="flex flex-row items-center justify-center gap-2">
                            <input
                                type="text"
                                className="input input-bordered"
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
                        <table className="table border">
                            <thead>
                                <tr className="font-bold  text-lg text-black">
                                    <th className="text-gray-500 text-center text-md border-x-2">
                                        id
                                    </th>
                                    <th className="text-gray-500 text-center text-md border-x-2">
                                        nama
                                    </th>
                                    <th className="text-gray-500 text-center text-md border-x-2">
                                        email
                                    </th>
                                    <th className="text-gray-500 text-center text-md border-x-2">
                                        role
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
                                        <td className="font-bold border-x-2">
                                            {item.name}
                                        </td>
                                        <td className="font-bold border-x-2">
                                            {item.email}
                                        </td>
                                        <td className="font-bold border-x-2">
                                            {item.role.name_role}
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

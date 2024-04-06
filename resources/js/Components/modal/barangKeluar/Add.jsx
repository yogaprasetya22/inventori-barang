import InputError from "@/Components/ui/InputError";
import InputLabel from "@/Components/ui/InputLabel";
import TextInput from "@/Components/ui/TextInput";
import React from "react";
import { useForm, usePage } from "@inertiajs/react";
import { useEffect } from "react";

export default function Add() {
    const { barang } = usePage().props;
    const [dataSrc, setDataSrc] = React.useState(null);
    const { data, setData, post, processing, errors, reset } = useForm({
        barang_id: "",
        kategori_id: "",
        kuantitas: "",
        keterangan: "",
    });

    // render image
    useEffect(() => {
        if (data.barang_id) {
            const filterBarang = barang.filter(
                (item) => item.id === data.barang_id
            );
            setDataSrc(filterBarang[0]);
        }
    }, [data.barang_id]);

    const handleAddowner = (e) => {
        e.preventDefault();

        post(route("admin.barang-keluar.store"), {
            preserveScroll: true,
            onSuccess: () => {
                window.my_modal_1.close();
                reset();
            },
            onError: (errors) => {
                // Tangani kesalahan jika diperlukan
                console.log(errors);
            },
        });
    };

    return (
        <dialog
            id="my_modal_1"
            className="modal backdrop-blur-sm backdrop-brightness-75"
        >
            <div className="modal-box w-full max-w-4xl overflow">
                <div className=" absolute top-0 right-0">
                    <button
                        onClick={() => window.my_modal_1.close()}
                        className="btn-close text-2xl btn bg-transparent border-none"
                        aria-label="close modal"
                    >
                        X
                    </button>
                </div>
                <div className=" w-full flex flex-col gap-5">
                    <div className="w-full flex flex-row justify-center items-center">
                        <h1 className="text-2xl font-bold text-gray-500">
                            Create Barang Baru
                        </h1>
                    </div>
                    <form
                        className="flex flex-col gap-5"
                        onSubmit={handleAddowner}
                    >
                        <div className="flex flex-col gap-2">
                            {/* buatkan label input yang mana isinya ada url_gambar nama_barang kuantitas harga keterangan kategori_id*/}
                            <div className="flex flex-col gap-2 w-full">
                                <InputLabel htmlFor="barang" value="Barang" />
                                <select
                                    id="barang"
                                    name="barang"
                                    value={
                                        data.barang_id
                                            ? JSON.stringify({
                                                  id: data.barang_id,
                                                  kategori_id: data.kategori_id,
                                              })
                                            : ""
                                    }
                                    className="mt-1 block w-full  select select-primary rounded-md"
                                    onChange={(e) => {
                                        const value = JSON.parse(
                                            e.target.value
                                        );
                                        setData({
                                            ...data,
                                            barang_id: value.id,
                                            kategori_id: value.kategori_id,
                                        });
                                    }}
                                >
                                    <option value="">Pilih Barang</option>
                                    {barang.map((item) => (
                                        <option
                                            key={item.id}
                                            value={JSON.stringify({
                                                id: item.id,
                                                kategori_id: item.kategori_id,
                                            })}
                                        >
                                            {item.nama_barang}
                                        </option>
                                    ))}
                                </select>

                                <InputError
                                    error={errors.barang_id}
                                    className="mt-1"
                                />
                            </div>
                            {dataSrc && (
                                <div className="w-full flex justify-between gap-2">
                                    <div className="flex flex-col gap-2 w-full">
                                        <table className="w-full mt-4">
                                            <tbody>
                                                <tr className="border-b">
                                                    <td className="py-2 w-[7rem] text-indigo-600/80">
                                                        Nama Barang
                                                    </td>
                                                    <td className="px-4">:</td>
                                                    <td className="py-2">
                                                        {dataSrc.nama_barang}
                                                    </td>
                                                </tr>
                                                <tr className="border-b">
                                                    <td className="py-2 w-[7rem] text-indigo-600/80">
                                                        Kuantitas
                                                    </td>
                                                    <td className="px-4">:</td>
                                                    <td className="py-2">
                                                        {dataSrc.kuantitas}
                                                    </td>
                                                </tr>
                                                <tr className="border-b">
                                                    <td className="py-2 w-[7rem] text-indigo-600/80">
                                                        Harga
                                                    </td>
                                                    <td className="px-4">:</td>
                                                    <td className="py-2">
                                                        {dataSrc.harga}
                                                    </td>
                                                </tr>
                                                <tr className="border-b">
                                                    <td className="py-2 w-[7rem] text-indigo-600/80">
                                                        Keterangan
                                                    </td>
                                                    <td className="px-4">:</td>
                                                    <td className="py-2">
                                                        {dataSrc.keterangan}
                                                    </td>
                                                </tr>
                                                <tr className="border-b">
                                                    <td className="py-2 w-[7rem] text-indigo-600/80">
                                                        Kategori
                                                    </td>
                                                    <td className="px-4">:</td>
                                                    <td className="py-2">
                                                        {
                                                            dataSrc.kategori
                                                                .nama_kategori
                                                        }
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    {/* render image */}

                                    <div className="flex justify-center items-center w-full">
                                        <img
                                            src={dataSrc.url_gambar}
                                            alt=""
                                            className="w-[15rem] h-[15rem] object-cover"
                                        />
                                    </div>
                                </div>
                            )}
                            <div className="flex flex-row gap-5 w-full pt-2">
                                {" "}
                                {/* kuantitas */}
                                <div className="flex flex-col gap-2 w-full">
                                    <InputLabel
                                        htmlFor="kuantitas"
                                        value="Kuantitas"
                                    />
                                    <TextInput
                                        id="kuantitas"
                                        type="number"
                                        name="kuantitas"
                                        value={data.kuantitas}
                                        className="mt-1 block w-full"
                                        autoComplete="kuantitas"
                                        isFocused={true}
                                        onChange={(e) =>
                                            setData("kuantitas", e.target.value)
                                        }
                                    />
                                    <InputError
                                        error={errors.kuantitas}
                                        className="mt-1"
                                    />
                                </div>
                                {/* keterangan */}
                                <div className="flex flex-col gap-2 w-full">
                                    <InputLabel
                                        htmlFor="keterangan"
                                        value="Keterangan"
                                    />
                                    <TextInput
                                        id="keterangan"
                                        type="text"
                                        name="keterangan"
                                        value={data.keterangan}
                                        className="mt-1 block w-full"
                                        autoComplete="keterangan"
                                        isFocused={true}
                                        onChange={(e) =>
                                            setData(
                                                "keterangan",
                                                e.target.value
                                            )
                                        }
                                    />
                                    <InputError
                                        error={errors.keterangan}
                                        className="mt-1"
                                    />
                                </div>
                            </div>
                        </div>
                        <div className="flex justify-end">
                            <button
                                type="submit"
                                className="btn bg-indigo-600/90 text-white"
                            >
                                {processing ? "Loading..." : "Create"}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </dialog>
    );
}

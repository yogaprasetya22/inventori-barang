import InputError from "@/Components/ui/InputError";
import InputLabel from "@/Components/ui/InputLabel";
import TextInput from "@/Components/ui/TextInput";
import React from "react";
import { useForm, usePage } from "@inertiajs/react";
import { useEffect } from "react";
import { formatRupiah, validateRole } from "@/Components/Example";

export default function Add() {
    const { kategori, auth } = usePage().props;
    const [srcImg, setSrcImg] = React.useState(null);
    const { data, setData, post, processing, errors, reset } = useForm({
        file: "",
        nama_barang: "",
        kuantitas: "",
        harga: "",
        keterangan: "",
        kategori_id: "",
    });

    const renderImg = (e) => {
        const file = e.target.files[0];
        const reader = new FileReader();
        reader.onload = () => {
            if (reader.readyState === 2) {
                setSrcImg(reader.result);
            }
        };
        reader.readAsDataURL(file);
        setData("file", file);
    };

    const handleAddowner = (e) => {
        e.preventDefault();

        const formData = new FormData();
        formData.append("file", data.file);
        formData.append("nama_barang", data.nama_barang);
        formData.append("kuantitas", data.kuantitas);
        formData.append("harga", data.harga);
        formData.append("keterangan", data.keterangan);
        formData.append("kategori_id", data.kategori_id);

        post(route(`${validateRole(auth.user.id)}.barang.store`), formData, {
            // Tambahkan opsi untuk mengatur header Content-Type
            headers: {
                "Content-Type": "multipart/form-data",
            },
            // Tambahkan properti untuk mengatur response menjadi json
            responseType: "json",
            preserveScroll: true,
            onSuccess: () => {
                window.my_modal_1.close();
                window.location.reload();
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
                            <div className="flex w-full flex-row gap-5">
                                <div className="flex flex-col gap-2 w-full">
                                    <InputLabel
                                        htmlFor="nama_barang"
                                        value="Nama Barang"
                                    />
                                    <TextInput
                                        id="nama_barang"
                                        type="text"
                                        name="nama_barang"
                                        value={data.nama_barang}
                                        className="mt-1 block w-full"
                                        autoComplete="nama_barang"
                                        onChange={(e) =>
                                            setData(
                                                "nama_barang",
                                                e.target.value
                                            )
                                        }
                                    />
                                    <InputError
                                        message={errors.nama_barang}
                                        className="mt-2"
                                    />
                                </div>
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
                                        onChange={(e) =>
                                            setData("kuantitas", e.target.value)
                                        }
                                    />
                                    <InputError
                                        message={errors.kuantitas}
                                        className="mt-2"
                                    />
                                </div>
                            </div>
                            <div className="flex w-full flex-row gap-5">
                                <div className="flex flex-col gap-2 w-full">
                                    <InputLabel htmlFor="harga" value="Harga" />
                                    <TextInput
                                        id="harga"
                                        type="text"
                                        name="harga"
                                        value={data.harga}
                                        className="mt-1 block w-full"
                                        autoComplete="harga"
                                        onChange={(e) =>
                                            setData(
                                                "harga",
                                                formatRupiah(
                                                    e.target.value,
                                                    "Rp"
                                                )
                                            )
                                        }
                                    />
                                    <InputError
                                        message={errors.harga}
                                        className="mt-2"
                                    />
                                </div>
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
                                        onChange={(e) =>
                                            setData(
                                                "keterangan",
                                                e.target.value
                                            )
                                        }
                                    />
                                    <InputError
                                        message={errors.keterangan}
                                        className="mt-2"
                                    />
                                </div>
                            </div>{" "}
                            <div className="flex flex-col gap-2 w-full">
                                <InputLabel
                                    htmlFor="kategori_id"
                                    value="Kategori ID"
                                />
                                <select
                                    id="kategori_id"
                                    name="kategori_id"
                                    value={data.kategori_id}
                                    className="mt-1 block w-full select select-primary rounded-md"
                                    onChange={(e) =>
                                        setData("kategori_id", e.target.value)
                                    }
                                >
                                    <option value="" disabled>
                                        Pilih Kategori
                                    </option>
                                    {kategori.map((item) => (
                                        <option key={item.id} value={item.id}>
                                            {item.nama_kategori}
                                        </option>
                                    ))}
                                </select>
                                <InputError
                                    message={errors.kategori_id}
                                    className="mt-2"
                                />
                            </div>
                            {/* render image and input */}
                            <div className="flex flex-col gap-2 w-full">
                                <InputLabel htmlFor="file" value="Gambar" />
                                <input
                                    id="file"
                                    name="file"
                                    type="file"
                                    accept="image/*"
                                    className="mt-1 block w-full"
                                    onChange={(e) => renderImg(e)}
                                />
                                <InputError
                                    message={errors.file}
                                    className="mt-2"
                                />
                                {srcImg && (
                                    <img
                                        src={srcImg}
                                        alt="gambar"
                                        className="mt-2 w-1/4"
                                    />
                                )}
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

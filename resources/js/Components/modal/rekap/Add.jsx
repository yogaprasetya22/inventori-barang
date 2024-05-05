import InputError from "@/Components/ui/InputError";
import InputLabel from "@/Components/ui/InputLabel";
import TextInput from "@/Components/ui/TextInput";
import React from "react";
import { useForm, usePage } from "@inertiajs/react";
import { validateRole } from "@/Components/Example";

export default function Add() {
    const { barang, barang_masuk, barang_keluar, auth } = usePage().props;
    const { data, setData, post, processing, errors, reset } = useForm({
        judul_rekap: "",
        keterangan: "",
    });
    const handleAddowner = (e) => {
        e.preventDefault();

        post(route(`${validateRole(auth.user.id)}.laporan-rekap.store`), {
            preserveScroll: true,
            onSuccess: () => {
                window.my_modal_1.close();
                reset();
                window.location.reload();
            },
            onError: (errors) => {
                alert(errors[0]);
            },
        });
    };
    return (
        <dialog
            id="my_modal_1"
            className="modal backdrop-blur-sm backdrop-brightness-75"
        >
            <div className="modal-box w-full max-w-1xl overflow">
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
                            Create Laporan Rekap
                        </h1>
                    </div>
                    <form
                        className="flex flex-col gap-5"
                        onSubmit={handleAddowner}
                    >
                        <div className="flex flex-col gap-2">
                            <div className="flex-row gap-3 flex w-full">
                                <div className="flex flex-col gap-2 w-full">
                                    <InputLabel
                                        htmlFor="judul_rekap"
                                        value="Judul Rekap"
                                    />
                                    <TextInput
                                        id="judul_rekap"
                                        type="text"
                                        name="judul_rekap"
                                        value={data.judul_rekap}
                                        className="mt-1 block w-full"
                                        autoComplete="judul_rekap"
                                        isFocused={true}
                                        onChange={(e) =>
                                            setData(
                                                "judul_rekap",
                                                e.target.value
                                            )
                                        }
                                    />
                                    <InputError
                                        message={errors.judul_rekap}
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
                            </div>
                            <div className="w-full flex justify-between gap-2">
                                <div className="flex flex-col gap-2 w-full">
                                    <table className="w-full mt-4">
                                        <tbody>
                                            <tr className="border-b">
                                                <td className="py-2 w-[7rem] text-indigo-600/80">
                                                    Barang
                                                </td>
                                                <td className="px-4">:</td>
                                                <td className="py-2">
                                                    {barang.length}
                                                </td>
                                            </tr>
                                            <tr className="border-b">
                                                <td className="py-2 w-[7rem] text-indigo-600/80">
                                                    Barang Masuk
                                                </td>
                                                <td className="px-4">:</td>
                                                <td className="py-2">
                                                    {barang_masuk.length}
                                                </td>
                                            </tr>
                                            <tr className="border-b">
                                                <td className="py-2 w-[7rem] text-indigo-600/80">
                                                    Barang Keluar
                                                </td>
                                                <td className="px-4">:</td>
                                                <td className="py-2">
                                                    {barang_keluar.length}
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
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

import InputError from "@/Components/ui/InputError";
import InputLabel from "@/Components/ui/InputLabel";
import TextInput from "@/Components/ui/TextInput";
import React from "react";
import { useForm, usePage } from "@inertiajs/react";
import { useEffect } from "react";
import { validateRole } from "@/Components/Example";

export default function Update({ data: data_owner }) {
    const { auth } = usePage().props;
    const { data, setData, put, processing, errors, reset } = useForm({
        id: data_owner.id,
        judul_rekap: "",
        keterangan: "",
    });
    useEffect(() => {
        setData({
            id: data_owner.id,
            judul_rekap: data_owner.judul_rekap,
            keterangan: data_owner.keterangan,
        });
    }, [data_owner]);

    const handleAddowner = (e) => {
        e.preventDefault();

        put(route(`${validateRole(auth.user.id)}.laporan-rekap.update`), {
            preserveScroll: true,
            onSuccess: () => {
                window.my_modal_2.close();
                reset();
            },
        });
    };
    return (
        <dialog
            id="my_modal_2"
            className="modal backdrop-blur-sm backdrop-brightness-75"
        >
            <div className="modal-box w-full max-w-1xl overflow">
                <div className=" absolute top-0 right-0">
                    <button
                        onClick={() => window.my_modal_2.close()}
                        className="btn-close text-2xl btn bg-transparent border-none"
                        aria-label="close modal"
                    >
                        X
                    </button>
                </div>
                <div className=" w-full flex flex-col gap-5">
                    <div className="w-full flex flex-row justify-center items-center">
                        <h1 className="text-2xl font-bold text-gray-500">
                            Update Laporan Rekap
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
                                                    {
                                                        data_owner
                                                            ?.rekap_stok_barang
                                                            ?.length
                                                    }
                                                </td>
                                            </tr>
                                            <tr className="border-b">
                                                <td className="py-2 w-[7rem] text-indigo-600/80">
                                                    Barang Masuk
                                                </td>
                                                <td className="px-4">:</td>
                                                <td className="py-2">
                                                    {
                                                        data_owner
                                                            ?.rekap_barang_masuk
                                                            ?.length
                                                    }
                                                </td>
                                            </tr>
                                            <tr className="border-b">
                                                <td className="py-2 w-[7rem] text-indigo-600/80">
                                                    Barang Keluar
                                                </td>
                                                <td className="px-4">:</td>
                                                <td className="py-2">
                                                    {
                                                        data_owner
                                                            ?.rekap_barang_keluar
                                                            ?.length
                                                    }
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
